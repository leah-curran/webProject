//
//Name:      Damon Kelly
//StudentID: C00307057
//Date:      02/03/2026
//Purpose:   javascript for the view page to view a deposit account for an already existing customer
//

function lookupById()
{
    var id = document.getElementById("cust_id_lookup").value;
    var select = document.getElementById("cust_select");
    var found = false;
    if (!id)
        {
            alert("Please enter a customer ID to look up.");
            return;
        }
    for (var i = 0; i < select.options.length; i++)
        {
            var optionValue = select.options[i].value;
            var optionId = optionValue.split(",")[0];
            if (optionId == id)
                {
                    select.selectedIndex = i;
                    lookupBySelect();
                    found = true;
                    break;
                }
        }
    if (!found)
        {
            alert("Customer ID not found. Please check the ID and try again.");
        }
}

function lookupBySelect()
{
    var selected = document.getElementById("cust_select").value;
    if (selected)
        {
            var parts = selected.split(",");
            var id      = parts[0];
            var fname   = parts[1];
            var sname   = parts[2];
            var phone   = parts[3];
            var email   = parts[4];
            var eircode = parts[5];
            var dob     = parts[6];
            var address = parts[7];

            document.getElementById("disp_id").innerHTML      = id;
            document.getElementById("disp_name").innerHTML    = fname + " " + sname;
            document.getElementById("disp_phone").innerHTML   = phone;
            document.getElementById("disp_email").innerHTML   = email;
            document.getElementById("disp_eircode").innerHTML = eircode;
            document.getElementById("disp_dob").innerHTML     = dob;
            document.getElementById("disp_address").innerHTML = address;
            document.getElementById("cust_id").value = id;
            document.getElementById("customerDetails").style.display = "block";

            var accSelect = document.getElementById("acc_select");
            var accData = document.getElementById("acc_data");
            accSelect.innerHTML = "<option value=''>-- Select an Account --</option>";
            // Loop through hidden account data and add options matching this customer
            for (var i = 0; i < accData.options.length; i++)
                {
                    var optionValue = accData.options[i].value;
                    var optCustId = optionValue.split(",")[0];
                    var optAccId = optionValue.split(",")[1];
                    var optBalance = optionValue.split(",")[2];
                    if (optCustId == id)
                        {
                            accSelect.innerHTML = accSelect.innerHTML + "<option value='" + optAccId + "," + optBalance + "'>Account " + optAccId + " - Balance: &euro;" + optBalance + "</option>";
                        }
                }
        }
}

// Function to look up a customer by an account number they typed in
// Searches through the hidden account data to find a matching account
function lookupByAccountNumber()
{
    var accId = document.getElementById("acc_id_lookup").value;
    var accData = document.getElementById("acc_data");
    var found = false;
    if (!accId)
        {
            alert("Please enter an account number to look up.");
            return;
        }
    // Loop through the hidden account data to find a matching account ID
    for (var i = 0; i < accData.options.length; i++)
        {
            var optionValue = accData.options[i].value;
            // The second item in the packed value is the account ID
            var optionAccId = optionValue.split(",")[1];
            if (optionAccId == accId)
                {
                    // Get the customer ID from the packed value and sync the customer dropdown
                    var custId = optionValue.split(",")[0];
                    var custSelect = document.getElementById("cust_select");
                    for (var j = 0; j < custSelect.options.length; j++)
                        {
                            if (custSelect.options[j].value.split(",")[0] == custId)
                                {
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
    var accSelect = document.getElementById("acc_select");
    for (var i = 0; i < accSelect.options.length; i++)
        {
            if (accSelect.options[i].value.split(",")[0] == accId)
                {
                    accSelect.selectedIndex = i;
                    selectAccount();
                    break;
                }
        }
}

// Function to populate account details when an account is chosen from the dropdown
function selectAccount()
{
    var selected = document.getElementById("acc_select").value;
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
            document.getElementById("account_id").value = accId;
            // Show the account details section
            document.getElementById("accountDetails").style.display = "block";
        }
    else
        {
            // Hide the account details section if no account is selected
            document.getElementById("accountDetails").style.display = "none";
        }
}