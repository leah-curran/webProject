<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      02/03/2026
Purpose:   php for the history page to view a deposit account history for an already existing customer
-->

<!doctype html>
<head>
<title>Deposit Account History</title>
<!-- default styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="draft.css" />
</head>
<body>
<!-- menu links -->
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
    <!-- submenu for links to other deposit pages -->
     <div class="submenu">
       <ul>
        <P><a href=OpenDepositAccount.html.php>Open a Deposit Account</a></P>
        <P><a href=ViewDepositAccount.html.php>View a Deposit Account</a></P>
        <P><a href=CloseDepositAccount.html.php>Close Deposit Account</a></P>
       </ul>
    </div>
<main>
<div class = "depositBody">

<?php
include 'db.inc.php';

// get the customer and account ids from the form
$custid = $_POST['cust_id'];
$accountid = $_POST['account_id'];

$sql = "SELECT customer.Firstname, customer.Surname, customer.CustId, depositacc.DepositAccountId, depositacc.Balance, depositacc.OpenedDate 
FROM customer inner join depositacc ON customer.CustId = depositacc.CustId WHERE depositacc.DepositAccountId = " . $_POST['account_id'] . "
 AND customer.DeleteCust = 0 AND depositacc.DeleteDeposit = 0";

if (!$result = mysqli_query($con, $sql))
    {
        die("An Error in the SQL Query: " . mysqli_error($con));
    }

$row = mysqli_fetch_array($result);
$id = $row["DepositAccountId"];
$name = $row["Firstname"] . " " . $row['Surname'];
echo "<h2>Account Details</h2>";
echo "<p><strong>Customer:</strong> " . $row['Firstname'] . " " . $row['Surname'] . "</p>";
echo "<p><strong>Customer ID:</strong> " . $row['CustId'] . "</p>";
echo "<p><strong>Account Number:</strong> " . $row['DepositAccountId'] . "</p>";
echo "<p><strong>Balance:</strong> &euro;" . $row['Balance'] . "</p>";
echo "<p><strong>Opened Date:</strong> " . $row['OpenedDate'] . "</p>";

$start = $_POST["start_date"];
$end = $_POST["end_date"];

if ($start && $end)
    {
        $sql2 = "SELECT * FROM `transaction` WHERE DepositAccountId = " . $_POST['account_id'] . " AND Date BETWEEN '" . $start . "' AND '" . $end . "' ORDER BY Date";
    }

else
    {
        $sql2 = "SELECT * FROM `transaction` WHERE DepositAccountId = " . $_POST['account_id'] . " ORDER BY Date";
    }

if (!$result2 = mysqli_query($con, $sql2))
    {
        die("An Error in the SQL Query". mysqli_error($con));
    }

$transactionCount = mysqli_num_rows($result2);

if ($transactionCount == 0)
    {
        echo "<p>No transactions were found for this account!</p>";
    }
else
    {
        echo "<u>Deposit Account History</u><br><br>";
        echo "Account Number: " . $id . "         Customer Name: " . $name . "<br><br>";
        echo "<table>";
        echo "<tr><th>Date</th><th>Transaction Type</th><th>Transaction Amount</th><th>Balance</th></tr>";
        while ($row = mysqli_fetch_array($result2))
            {
                $date = $row["Date"];
                $type = $row["Type"];
                $amount = $row["Amount"];
                $balance = $row["Balance"];

                echo "<tr><td>" . $date ."</td><td>". $type ."</td><td>". $amount ."</td><td>". $balance ."</td></tr>";
            }
        echo "</table>";
    }
?>