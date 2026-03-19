<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      02/03/2026
Purpose:   php for the view page to view a deposit account for an already existing customer
-->

<!doctype html>
<head>
<title>View a Deposit Account</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="draft.css" />
</head>
<body>
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
     <div class="submenu">
       <ul>
        <P><a href=DepositAccMenu.html>Back to Deposit Account Menu</a></P>
        <P><a href=OpenDepositAccount.html.php>Open a Deposit Account</a></P>
        <P><a href=CloseDepositAccount.html.php>Close Deposit Account</a></P>
       </ul>
    </div>
<main>
<div class = "depositBody">

<?php
include 'db.inc.php';

$custid = $_POST['cust_id'];
$accountid = $_POST['account_id'];

$sql = "SELECT Firstname, Surname, CustId, DepositAccountId, Balance, OpenedDate FROM customer 
inner join depositacc ON customer.CustId = depositacc.CustId AND customer.DeletedFlag = 0 AND depositacc.DeletedFlag = 0";

if (!$result = mysqli_query($con, $sql))
    {
        die("An Error in the SQL Query: " . mysqli_error($con));
    }

$rowcount = mysqli_affected_rows($con);

?>