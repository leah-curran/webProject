<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      21/03/2026
Purpose:   History page to view a deposit account history for an already existing customer
-->

<!doctype html>
<head>
    <title>Deposit Account History</title>
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
        <p><a href="OpenDepositAccount.html.php">Open a Deposit Account</a></p>
        <p><a href="ViewDepositAccount.html.php">View a Deposit Account</a></p>
        <p><a href="CloseDepositAccount.html.php">Close Deposit Account</a></p>
    </ul>
</div>

<main>
<div class="depositBody">
<h1>Deposit Account History</h1>
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

<!-- Call a javascript function to look up the customer by account number -->
<label>Enter Account Number
<input type="number" id="acc_id_lookup" name="acc_id_lookup" title="Please enter a valid account number" placeholder="1" />
</label>
<button type="button" onclick="lookupByAccountNumber()">Search</button>

<br><br>

<label>Or Select Customer by Name
    <?php
    include 'db.inc.php';
    $sql = "SELECT CustId, Firstname, Surname, Phone, Address, Email, eircode, dob 
            FROM customer WHERE DeleteCust = 0";
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
            $address = $row['Address'];
            $allText = "$id,$fname,$sname,$phone,$email,$eircode,$dob,$address";
            echo "<option value='$allText'>$fname $sname</option>";
        }
    echo "</select>";

    // Hidden select packed with all open deposit account data for JS to loop through
    // This is needed to link the customer to their accounts for the account selection step as customers can have multiple accounts
    $sql2 = "SELECT DepositAccountId, CustId, Balance FROM depositacc WHERE DeleteDeposit = 0";
    if (!$result2 = mysqli_query($con, $sql2))
        {
            die('Error in querying the database' . mysqli_error($con));
        }
    echo "<select id='acc_data' style='display:none'>";
    while ($row2 = mysqli_fetch_array($result2))
        {
            $accId = $row2['DepositAccountId'];
            $custId = $row2['CustId'];
            $balance = $row2['Balance'];
            // Put the customer ID, account ID and balance in the value so JS can link customers to accounts and validate balance when closing
            echo "<option value='$custId,$accId,$balance'></option>";
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
<p><strong>Address:</strong> <span id="disp_address"></span></p>
<br>
<p>If the details above are correct, please select the account to close below.</p>
<hr>
<br>

<!-- Step 3: Select Account -->
<h3>Step 3: Select Account</h3>
<br>
<label>Deposit Account
<!-- This dropdown is populated with Account IDs linked to the customer after the lookup step. It is populated by JS by looping through the hidden acc_data select and matching the customer ID -->
<select id="acc_select" onchange="selectAccount()">
    <option value="">-- Select an Account --</option>
</select>
</label>

<br><br>

<!-- Account details shown after account is picked -->
<div id="accountDetails" style="display:none;">
<hr>
<h3>Step 4: Confirm Account Details</h3>
<br>
<p><strong>Account Number:</strong> <span id="disp_acc_id"></span></p>
<p><strong>Balance:</strong> &euro;<span id="disp_balance"></span></p>
<br>
<p>Please confirm the details above before closing the account.</p>
<hr>
<br>

<form action="view_deposit.php" method="post">
    <input type="hidden" name="cust_id" id="cust_id" />
    <input type="hidden" name="account_id" id="account_id"/>
    <button type="submit">View Account</button>
</form>
</div>



<br><br>
<p><a href="MainMenu.html">Return to Main Menu</a></p>
</div>
</main>

<script src="deposithistory.js"></script>
</body>
</html>