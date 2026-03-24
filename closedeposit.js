//
//Name:      Damon Kelly
//StudentID: C00307057
//Date:      16/03/2026
//Purpose:   javascript for the close page to close a deposit account for an already existing customer
//

// Function to look up a customer by the ID they typed in
// Searches through the dropdown options to find a matching customer ID
function lookupById()
{
    // Gets the ID entered in the search
    var id = document.getElementById("cust_id_lookup").value;
    //  get the dropdown element and a flag to track if we found a match
    var select = document.getElementById("cust_select");
    var found = false;

    if (!id)
        {
            alert("Please enter a customer ID to look up.");
            return;
        }

    // Loop through each option in the dropdown to find a match
    for (var i = 0; i < select.options.length; i++)
        {
            // set optionvalue as the current option from the dropdown
            var optionValue = select.options[i].value;
            // The first item in the packed value is the customer ID
            var optionId = optionValue.split(",")[0];
            // check if searched id is the same as the id in the current option
            if (optionId == id)
                {
                    // if it is equal select that option in the dropdown and display the customer
                    select.selectedIndex = i;
                    // call the lookupbyselect() function
                    lookupBySelect();
                    found = true;
                    break;
                }
        }
    // check if after looping through each option if it isn't found, let user know
    if (!found)
        {
            alert("Customer ID not found. Please check the ID and try again.");
        }
}

// Function to look up a customer from the dropdown
function lookupBySelect()
{
    // set the option selected as a variable
    var selected = document.getElementById("cust_select").value;
    // if something is selected
    if (selected)
        {
            // Split the packed value back into individual pieces
            var parts = selected.split(",");
            var id = parts[0];
            var fname = parts[1];
            var sname = parts[2];
            var phone = parts[3];
            var email = parts[4];
            var eircode = parts[5];
            var dob = parts[6];
            var address = parts[7];

            // Fill in the confirmation fields by span id
            document.getElementById("disp_id").innerHTML = id;
            document.getElementById("disp_name").innerHTML = fname + " " + sname;
            document.getElementById("disp_phone").innerHTML = phone;
            document.getElementById("disp_email").innerHTML = email;
            document.getElementById("disp_eircode").innerHTML = eircode;
            document.getElementById("disp_dob").innerHTML = dob;
            document.getElementById("disp_address").innerHTML = address;

            // set the hidden form field as the selected customer id and
            document.getElementById("cust_id").value = id;
            // sets the customer details to display, changes none to block
            document.getElementById("customerDetails").style.display = "block";

            // sets the account dropdown id as a variable
            var accSelect = document.getElementById("acc_select");
            // sets acc data from html as a variable
            var accData = document.getElementById("acc_data");

            // sets the dropdown to default option
            accSelect.innerHTML = "<option value=''>-- Select an Account --</option>";
            // Loop through hidden account data and add deposit accounts with matching customer id
            for (var i = 0; i < accData.options.length; i++)
                {
                    // sets optionvalue as the current selection from the dropdown
                    var optionValue = accData.options[i].value;
                    // sets the values split by commas as variables
                    var optCustId = optionValue.split(",")[0];
                    var optAccId = optionValue.split(",")[1];
                    var optBalance = optionValue.split(",")[2];
                    // check if the account cust id from dropdown matches the selected customer id
                    if (optCustId == id)
                        {
                            // if it matches, set the customers accounts as options in the dropdown 
                            accSelect.innerHTML = accSelect.innerHTML + "<option value='" + optAccId + "," + optBalance + "'>Account " + optAccId + " - Balance: &euro;" + optBalance + "</option>";
                        }
                }
        }
}

// Function to look up a customer by an account number they typed in
// Searches through the hidden account data to find a matching account
function lookupByAccountNumber()
{
    // sets the entered account id as a variable
    var accId = document.getElementById("acc_id_lookup").value;
    // sets the account data from the html as a variable
    var accData = document.getElementById("acc_data");
    var found = false;
    // if account id isnt entered
    if (!accId)
        {
            alert("Please enter an account number to look up.");
            return;
        }
    // Loop through the hidden account data to find a matching account ID
    for (var i = 0; i < accData.options.length; i++)
        {
            // sets the current option as a variable
            var optionValue = accData.options[i].value;
            // The second item in the packed value is the account ID
            var optionAccId = optionValue.split(",")[1];
            // check if the entered account id is the same as the id of the current option
            if (optionAccId == accId)
                {
                    // Get the customer ID from the packed value and sync the customer dropdown
                    var custId = optionValue.split(",")[0];
                    // set selected customer as a variable
                    var custSelect = document.getElementById("cust_select");
                    // loop through the customers in the dropdown
                    for (var j = 0; j < custSelect.options.length; j++)
                        {
                            // check if the id from the dropdown equals the customer id from the selected account
                            if (custSelect.options[j].value.split(",")[0] == custId)
                                {
                                    // if the ids match set the value in the dropdown to the appropriate customer
                                    custSelect.selectedIndex = j;
                                    break;
                                }
                        }
                    // Show the customer details then auto-select this account
                    lookupBySelect();
                    selectAccountById(accId);
                    found = true;
                    break;
                }
        }
    if (!found)
        {
            alert("Account number not found. Please check the account number and try again.");
        }
}

// Function to auto-select a specific account in the account dropdown by account ID
// Used after lookupByAccountNumber() populates the dropdown
function selectAccountById(accId)
{
    // sets the selected account to a variable
    var accSelect = document.getElementById("acc_select");
    // loop through the accounts in the dropdown
    for (var i = 0; i < accSelect.options.length; i++)
        {
            //check if the id in the current option matches the id passed to the function
            if (accSelect.options[i].value.split(",")[0] == accId)
                {
                    // sets the account in the dropdown to selected account
                    accSelect.selectedIndex = i;
                    selectAccount();
                    break;
                }
        }
}

// Function to populate account details when an account is chosen from the dropdown
function selectAccount()
{
    // sets selected account to a variable
    var selected = document.getElementById("acc_select").value;
    // check if an account is chosen
    if (selected)
        {
            // Split the packed value back into account ID and balance
            var parts = selected.split(",");
            var accId = parts[0];
            var balance = parts[1];
            // Fill in the account confirmation fields
            document.getElementById("disp_acc_id").innerHTML = accId;
            document.getElementById("disp_balance").innerHTML = balance;
            // Copy the account ID and balance into the hidden form fields so they get sent to PHP
            document.getElementById("delid").value = accId;
            document.getElementById("balance").value = balance;
            // Show the account details section
            document.getElementById("accountDetails").style.display = "block";
        }
    else
        {
            // Hide the account details section if no account is selected
            document.getElementById("accountDetails").style.display = "none";
        }
}

// Function to reset the form back to its initial state
function resetForm()
{
    // hide confirmation details
    document.getElementById("customerDetails").style.display = "none";
    document.getElementById("accountDetails").style.display = "none";
    // set selected customer to the default
    document.getElementById("cust_select").selectedIndex = 0;
    // clear acc/cust lookup fields
    document.getElementById("cust_id_lookup").value = "";
    document.getElementById("acc_id_lookup").value = "";
}

// function for validating fields before closing an account
function validation()
{
    // make sure a customer is selected
    var custId = document.getElementById("cust_id").value;
    if (!custId)
        {
            alert("Please select a customer before submitting the form.");
            return false; // Prevent form submission
        }
    // make sure an account is selected to delete
    var delid = document.getElementById("delid").value;
    if (!delid)
        {
            alert("Please select an account to close.");
            return false; // Prevent form submission
        }
    // sets account balance as a variable, parseFloat converts the value from string to float
    var balance = parseFloat(document.getElementById("balance").value);
    // check if balance isnt set or balance isn't zero
    if (isNaN(balance) || balance != 0)
        {
            alert("You cannot close an account with a positive balance. Please withdraw the remaining funds first.");
            return false; // Prevent form submission
        }
    // Requires users to confirm they want to close the account
    var finalConfirmation = confirm("Are you sure you want to close Account " + delid + "?");
    return finalConfirmation;
}