<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      02/03/2026
Purpose:   View page to view a deposit account for an already existing customer
-->

<?php session_start(); ?>
<!doctype html>
<head>
    <title>View Deposit Account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="draft.css" />
</head>
<body>
<div class="nav">
    <img src="pics/logo.jpg" width="100" height="100">
    <div class="links">
    <ul>
        <li><a href="MainMenu.html">Home</a></li>
        <li><a href="withdrawals.html">Withdrawals</a></li>
        <li><a href="Lodgements.html">Lodgements</a></li>
        <li><a href="CustomerMaintenance.html">Customer Maintenance</a></li>
        <li><a href="AccountMaintenance.html">Account Maintenance</a></li>
        <li><a href="Management.html">Management</a></li>
        <li><a href="Reports.html">Reports</a></li>
        <li><a href="Quotes.html">Quotes</a></li>
        <li><a href="ChangePassword.html">Change Password</a></li>
    </ul>
    </div>
</div>
<div class="submenu">
    <ul>
        <p><a href="DepositAccMenu.html">Back to Deposit Account Menu</a></p>
        <p><a href="OpenDepositAccount.html.php">Open Deposit Account</a></p>
        <p><a href="CloseDepositAccount.html.php">Close Deposit Account</a></p>
    </ul>
</div>

<main>
<div class="depositBody">
<h1>View Deposit Account</h1>
<br>

<!-- Step 1: Find the customer -->
<h3>Step 1: Find Customer</h3>
<br>

<label>Enter Customer ID
    <input type="number" id="cust_id_lookup" name="cust_id_lookup" placeholder="1" 
        title="Please enter a valid customer ID" />
</label>
<button type="button" onclick="lookupById()">Search</button>

<br><br>

<label>Or Select Customer by Name
    <?php
    include 'db.inc.php';
    $sql = "SELECT CustId, Firstname, Surname, Phone, CustAddress, Email, eircode, dob 
            FROM customer WHERE DeletedFlag = 0";
    if (!$result = mysqli_query($con, $sql))
        {
            die('Error in querying the database' . mysqli_error($con));
        }
    echo "<select id='cust_select' onchange='lookupBySelect()'>";
    echo "<option value=''>-- Select a Customer --</option>";
    while ($row = mysqli_fetch_array($result))
        {
            $id      = $row['CustId'];
            $fname   = $row['Firstname'];
            $sname   = $row['Surname'];
            $phone   = $row['Phone'];
            $email   = $row['Email'];
            $eircode = $row['eircode'];
            $dob     = $row['dob'];
            $address = $row['CustAddress'];
            $allText = "$id,$fname,$sname,$phone,$email,$eircode,$dob,$address";
            echo "<option value='$allText'>$fname $sname</option>";
        }
    echo "</select>";
    mysqli_close($con);
    ?>
</label>

<br><br>

<!-- Step 2: Customer confirmation, shown by JS same as open deposit page -->
<div id="customerDetails" style="display:none;">
<hr>
<h3>Step 2: Confirm Customer Details</h3>
<br>
<p><strong>Customer ID:</strong> <span id="disp_id"></span></p>
<p><strong>Name:</strong> <span id="disp_name"></span></p>
<p><strong>Phone:</strong> <span id="disp_phone"></span></p>
<p><strong>Email:</strong> <span id="disp_email"></span></p>
<p><strong>Eircode:</strong> <span id="disp_eircode"></span></p>
<p><strong>Date of Birth:</strong> <span id="disp_dob"></span></p>
<br>

<form action="view_deposit.php" method="POST">
    <input type="hidden" name="cust_id" id="cust_id" />
    <button type="submit">View Account</button>
</form>
</div>



<br><br>
<p><a href="MainMenu.html">Return to Main Menu</a></p>
</div>
</main>

<script src="viewdeposit.js"></script>
</body>
</html>