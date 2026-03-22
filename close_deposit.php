<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      16/03/2026
Purpose:   Close page to close a deposit account for an already existing customer
-->

<?php
session_start();
include 'db.inc.php';
$sql = "UPDATE depositacc SET DeleteDeposit = 1 WHERE DepositAccountId = " . $_POST['delid'];
if (!mysqli_query($con, $sql))
    {
        echo "Error " . mysqli_error($con);
        exit();
    }
$_SESSION["depositid"] = $_POST['delid'];
$_SESSION["balance"] = $_POST['balance'];
mysqli_close($con);
?>
<!doctype html>
<head>
<title>Account Closed</title>
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
        <P><a href=OpenDepositAccount.html.php>Add a Deposit Account</a></P>
        <P><a href=ViewDepositAccount.html.php>View Deposit Account</a></P>
    </ul>
</div>
<main>
<div class="depositBody">
<h1>Account Closed</h1>
<br>
<p>Deposit Account <strong><?php echo $_SESSION["depositid"]; ?></strong> has been successfully closed.</p>
<br>
<p><a href="DepositAccMenu.html">Return to Deposit Account Menu</a></p>
<p><a href="MainMenu.html">Return to Main Menu</a></p>
</div>
</main>
</body>
</html>