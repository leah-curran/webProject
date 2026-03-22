<!--
Name:      Damon Kelly
StudentID: C00307057
Date:      23/02/2026
Purpose:   Add page to open a deposit account for an already existing customer
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
<h1>Open a Deposit Account</h1>
<br>

<!-- Step 1: Look up the customer -->
<h3>Step 1: Find Customer</h3>
<br>

<label>Enter Customer ID
<input type="number" id="cust_id_lookup" name="cust_id_lookup" title="Please enter a valid customer ID" placeholder="1" />
</label>
<button type="button" onclick="lookupById()">Search</button>

<br><br>

<!-- Customer name dropdown populated from the database -->
<label>Or Select Customer by Name
<?php
include 'db.inc.php';
// sql query to get customers not flagged for deletion
$sql = "SELECT CustId, Firstname, Surname, Phone, Address, Email, eircode, dob FROM customer WHERE DeleteCust = 0";
// run the query and if it fails print the error message
if (!$result = mysqli_query($con, $sql))
    {
        die('Error in querying the database: ' . mysqli_error($con));
    }
// dropdown list of customers, when one is selected run the javascript
echo "<select id='cust_select' onchange='lookupBySelect()'>";
// set the default option
echo "<option value=''>-- Select a Customer --</option>";
// loop through the results of the query
while ($row = mysqli_fetch_array($result))
    {
        // set the values in the current row to variables
        $id = $row['CustId'];
        $fname = $row['Firstname'];
        $sname = $row['Surname'];
        $phone = $row['Phone'];
        $email = $row['Email'];
        $eircode = $row['eircode'];
        $dob = $row['dob'];
        $address = $row['Address'];
        // Pack all the data into the value so JS can split it out
        $allText = "$id,$fname,$sname,$phone,$email,$eircode,$dob,$address";
        // echo out the customers first and surname
        echo "<option value='$allText'>$fname $sname</option>";
    }
echo "</select>";
?>
</label>

<br><br>

<!-- Customer details shown here after lookup -->
<div id="customerDetails" style="display:none;">
<hr>
<h3>Step 2: Confirm Customer Details</h3>
<br>
<!-- output the selected customers information, strong to make text bold, span to set the value using javascript -->
<p><strong>Customer ID:</strong> <span id="disp_id"></span></p>
<p><strong>Name:</strong> <span id="disp_name"></span></p>
<p><strong>Phone:</strong> <span id="disp_phone"></span></p>
<p><strong>Email:</strong> <span id="disp_email"></span></p>
<p><strong>Eircode:</strong> <span id="disp_eircode"></span></p>
<p><strong>Date of Birth:</strong> <span id="disp_dob"></span></p>
<p><strong>Address:</strong> <span id="disp_address"></span></p>
<br>
<p>If the details above are correct, please fill in the account details below.</p>
<hr>
<br>

<!-- Step 3: Account details form -->
<h3>Step 3: Account Details</h3>
<br>
<!-- set the php and validation to run after submittion -->
<form action="open_deposit.php" method="post" onsubmit="return validation()">

<!-- Hidden field to pass the customer ID into the form so $_POST can be used -->
<input type="hidden" name="cust_id" id="cust_id" />

<!-- Date field, pattern yyyy-mm-dd, required -->
<label>Date Opened
<input type="date" name="opened_date" id="opened_date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required placeholder="YYYY-MM-DD" title="Please enter a date in the format YYYY-MM-DD" />
</label>
<br><br>

<!-- Rate dropdown populated from the database, filtered to deposit rates only -->
<label>Interest Rate
<?php
include 'db.inc.php';
// sql query to get deposit accout rates from the rate table
$sql = "SELECT RateId, DateFrom, DateTo, Value FROM rate WHERE AccType = D AND DeleteRate = 0";
if (!$result = mysqli_query($con, $sql))
    {
        die('Error in querying the database: ' . mysqli_error($con));
    }
// dropdown list of the rates, required
echo "<select name='rate_id' required>";
// set the default option
echo "<option value=''>-- Select a Rate --</option>";
// loop through the results
while ($row = mysqli_fetch_array($result))
    {
        // set the values from the query to variables
        $rateId   = $row['RateId'];
        $value    = $row['Value'];
        $dateFrom = $row['DateFrom'];
        $dateTo   = $row['DateTo'];
        // echo out the information about the rate
        echo "<option value='$rateId'>$value% (From: $dateFrom To: $dateTo)</option>";
    }
echo "</select>";
mysqli_close($con);
?>
</label>
<br><br>

<!-- allow the customer to make an initial deposit -->
<label>Initial Deposit ($)
<input type="number" name="initial_deposit" id="initial_deposit" step="0.01" min="0" required placeholder="0.00" title="Please enter a valid deposit amount" />
</label>
<br><br>

<button type="submit">Open Account</button>
<button type="reset">Reset Form</button>
</form>
</div>

<br><br>
<p><a href="MainMenu.html">Return to Main Menu</a></p>
</div>
</main>

<script src="opendeposit.js"></script>
</body>
</html>