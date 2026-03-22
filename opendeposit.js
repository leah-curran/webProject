//
//Name:      Damon Kelly
//StudentID: C00307057
//Date:      16/03/2026
//Purpose:   javascript for the add page to open a deposit account for an already existing customer
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

            // Copy the customer ID into the hidden form field so it can be sent to PHP
            document.getElementById("cust_id").value = id;

            // Show the customer details and account form
            document.getElementById("customerDetails").style.display = "block";
        }
}
function validation()
{
    // set custid to selected customer
    var custId = document.getElementById("cust_id").value;
    // if none is selected let user know
    if (!custId)
        {
            alert("Please select a customer before submitting the form.");
            return false; // Prevent form submission
        }

    // set opened date as variable
    var date = document.getElementById("opened_date").value;
    // Get today's date in YYYY-MM-DD format, gets todays date in long string that includes time
    // toISOString formats it into simpler string, split(T) splits the string starting at the T
    // the T indicates the end of yyyy-mm-dd and the start of time, [0] selects the first half
    var today = new Date().toISOString().split("T")[0]; 
    // check if date is set and if its before todays date, dont allow opened date to be in the past
    if (!date || date < today)
        {
            alert("Please enter a valid date for the account opening.");
            return false; // Prevent form submission
        }

    // set deposit variable as value from form
    var deposit = document.getElementById("initial_deposit").value;
    // check if its empty
    if (!deposit)
        {
            alert("Please enter a valid initial deposit amount.");
            return false; // Prevent form submission
        }

    // Requires users to confirm they want to submit the form
    var finalConfirmation = confirm("Are you sure you want to submit the form?");
    return finalConfirmation;
}
