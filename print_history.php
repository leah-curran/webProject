<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      23/03/2026
Purpose:   php for the print history page to print a deposit account history for an already existing customer
-->

<!doctype html>
<head>
<title>Print Deposit Account History</title>
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

$start = $_POST["start_date"];
$end = $_POST["end_date"];
$id = $_POST["account_id"];

if ($start && $end)
    {
        $sql2 = "SELECT * FROM `transaction` WHERE DepositAccountId = '$id' AND Date BETWEEN '$start' AND '$end' ORDER BY Date";
        echo $sql2;
    }

else
    {
        $sql2 = "SELECT * FROM `transaction` WHERE DepositAccountId = '$id' ORDER BY Date";
        echo $sql2;
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
        echo "<strong>This information is being printed...</strong><br><br>";
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