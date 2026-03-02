<?php
include 'db.inc.php'; // include the database connection
date_default_timezone_set("UTC"); // set the default timezone to UTC

echo "The details sent down are: <br>"; // display the details sent from the form
$date = date_create($_POST['opened_date']); // create a date object from the opened date
echo "Opened Date is :" . date_format($date,"d/m/Y") . "<br>"; // display the opened date in the format of day/month/year
echo "Balance is :" . $_POST['initial_deposit'] . "<br>"; // display the initial deposit
echo "Status is : open" . "<br>"; // display the status
echo "Customer ID is :" . $_POST['cust_id'] . "<br>"; // display the customer ID
echo "Rate ID is :" . $_POST['rate_id'] . "<br>"; // display the rate ID

// Create SQL to insert the new deposit account into the depositacc table
$sql = "INSERT INTO depositacc (OpenedDate, Balance, Status, CustId, RateId) \n"
     . "VALUES ('$_POST[opened_date]', $_POST[initial_deposit], 'open', $_POST[cust_id], $_POST[rate_id])";

// Execute the SQL query and check if it was successful
if (!mysqli_query($con, $sql))
    {
        die("An Error in the SQL Query: " . mysqli_error($con));
    }

// Get the new account ID that was automatically generated
$new_account_id = mysqli_insert_id($con);

// Display a message confirming the account was opened
echo "<br>A deposit account has been opened for Customer ID " . $_POST['cust_id'] . ".";
echo "<br>The new Deposit Account Number is: " . $new_account_id;

// Close the database connection
mysqli_close($con);
?>

<!-- Button to return to the Open Deposit Account page -->
<form action = "OpenDepositAccount.html" method = "POST">
<br>
    <input type="submit" value = "Return to Insert Page"/>
</form>
