<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      02/03/2026
Purpose:   php for the view page to view a deposit account for an already existing customer
-->

<!doctype html>
<head>
<title>View a Deposit Account</title>
<!-- links to styling -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="draft.css" />
</head>
<body>
<!-- naviagation links -->
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
    <!-- submenu with links to other deposit pages -->
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
// include the database link
include 'db.inc.php';

// set values from form as variables
$custid = $_POST['cust_id'];
$accountid = $_POST['account_id'];

// sql query to select customer and their account information if they aren't deleted
$sql = "SELECT customer.Firstname, customer.Surname, customer.CustId, depositacc.DepositAccountId, depositacc.Balance, depositacc.OpenedDate 
FROM customer inner join depositacc ON customer.CustId = depositacc.CustId WHERE depositacc.DepositAccountId = " . $_POST['account_id'] . "
 AND customer.DeleteCust = 0 AND depositacc.DeleteDeposit = 0";

// run the query and display error if it fails
if (!$result = mysqli_query($con, $sql))
    {
        die("An Error in the SQL Query: " . mysqli_error($con));
    }

// set row as the result, no loop as the account id is unique
$row = mysqli_fetch_array($result);

// output the results of the query
echo "<h2>Account Details</h2>";
echo "<p><strong>Customer:</strong> " . $row['Firstname'] . " " . $row['Surname'] . "</p>";
echo "<p><strong>Customer ID:</strong> " . $row['CustId'] . "</p>";
echo "<p><strong>Account Number:</strong> " . $row['DepositAccountId'] . "</p>";
echo "<p><strong>Balance:</strong> &euro;" . $row['Balance'] . "</p>";
echo "<p><strong>Opened Date:</strong> " . $row['OpenedDate'] . "</p>";

// sql query to select the last 10 transactions for the selected account
$sql2 = "SELECT * FROM transaction WHERE DepositAccountId = " . $_POST['account_id'] . " ORDER BY Date LIMIT 10";

// run the query and output error if it fails
if (!$result2 = mysqli_query($con, $sql2))
    {
        die("An Error in the SQL Query". mysqli_error($con));
    }

// set a variable for the number of rows gotten from query
$transactionCount = mysqli_num_rows($result2);

// check if the count is 0
if ($transactionCount == 0)
    {
        echo "<p>No transactions were found for this account!</p>";
    }
// if theres more than 0 results output them in a table
else
    {
        echo "<table>";
        echo "<tr><th>Date</th><th>Type</th><th>Amount</th><th>Balance</th></tr>";
        // loop through result of query and seperate the rows
        while ($row = mysqli_fetch_array($result2))
            {
                // set the values in the current row as variables
                $date = $row["Date"];
                $type = $row["Type"];
                $amount = $row["Amount"];
                $balance = $row["Balance"];

                // output the row in the table
                echo "<tr><td>" . $date ."</td><td>". $type ."</td><td>". $amount ."</td><td>". $balance ."</td></tr>";
            }
        echo "</table>";
    }
?>