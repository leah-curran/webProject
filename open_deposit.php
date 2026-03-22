<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      23/02/2026
Purpose:   php for the add page to open a deposit account for an already existing customer
-->

<!doctype html>
<head>
<title>Open a Deposit Account</title>
<!-- link to styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="draft.css" />
<script src="opendeposit.js"></script>
</head>
<body>
<!-- navigation bar links -->
<div class="nav">
     <img src="pics/logo.jpg" width="100" height="100">
     <div class="links">
    <ul><li><A HREF="MainMenu.html">Home</A></li>
<li><A HREF="withdrawals.html">Withdrawals</A></li>
<li><A HREF="Lodgements.html">Lodgements</A></li>
<li><A HREF="CustomerMaintenance.html">Customer Maintenance</A></li>
<li><A HREF="AccountMaintenance.html">Account Maintenance</A></li>
<li><A HREF="Management.html">Management</A></li>
<li><A HREF="Reports.html">Reports</A></li>
<li><A HREF="Quotes.html">Quotes</A></li>
<li><A HREF="ChangePassword.html">Change Password</A></li>
</ul></div>
    </div>
    <!-- submenu on the left of the screen -->
     <div class="submenu">
       <ul>
        <P><a href=DepositAccMenu.html>Back to Deposit Account Menu</a></P>
        <P><a href=ViewDepositAccount.html.php>View Deposit Account</a></P>    
        <P><a href=CloseDepositAccount.html.php>Close Deposit Account</a></P>
       </ul> 
    </div>

<main>
<div class = "depositBody">
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
$sql = "INSERT INTO depositacc (OpenedDate, Balance, CustId, RateId, DeleteDeposit) \n"
     . "VALUES ('$_POST[opened_date]', $_POST[initial_deposit], $_POST[cust_id], $_POST[rate_id], 0)";

// Execute the SQL query and check if it was successful
if (!mysqli_query($con, $sql))
    {
        die("An Error in the SQL Query: " . mysqli_error($con));
    }

// Get the new account ID that was auto incremented
$new_account_id = mysqli_insert_id($con);

// Display a message confirming the account was opened
echo "<br>A deposit account has been opened for Customer ID " . $_POST['cust_id'] . ".";
echo "<br>The new Deposit Account Number is: " . $new_account_id;

// Close the database connection
mysqli_close($con);
?>

<!-- Button to return to the Open Deposit Account page -->
<form action = "OpenDepositAccount.html.php" method = "POST">
<br>
    <input type="submit" value = "Return to Insert Page"/>
</form>
</div>
</body>