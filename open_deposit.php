<?php
include 'db.inc.php'; // include the database connection
date_default_timezone_set("UTC"); // set the default timezone to UTC
echo "The details sent down are: <br>"; // display the details sent from the form

$date=date_create($_POST['opened_date']); // create a date object from the date of birth sent from the form

echo "Opened Date is :" . date_format($date,"d/m/Y") . "<br>"; // display the date of birth in the format of day/month/year
echo "Balance is :" . $_POST['initial_deposit'] . "<br>"; // display the surname sent from the form
echo "Status is :" . $_POST['status'] . "<br>"; // display the account type sent from the form
echo "Customer ID is :" . $_POST['cust_id'] . "<br>"; // display the account type sent from the form

$sql = "Insert into project (opened_date, balance, status, cust_id)
VALUES ('$_POST[opened_date]',$_POST[initial_deposit],'$_POST[status]',$_POST[cust_id])"; // create an SQL query to insert the details into the persons table

// execute the SQL query and check if it was successful
if (!mysqli_query($con,$sql))
    {
        die("An Error in the SQL Query: " . mysqli_error($con));
    }
// display a message confirming that a record has been added for the person
echo "<br>A record has been added for Customer ID " . $_POST['cust_id'] . ".";

// close the database connection
mysqli_close($con);

?>
<!-- create a form that when you press the return button you return to the OpenDepositAccount page -->
<form action = "OpenDepositAccount.html" method = "POST">
<br>
    <input type="submit" value = "Return to Insert Page"/>
</form>