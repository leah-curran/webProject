<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="draft.css">
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
        <P><a href=openCurrentAcc.html.php>Open CurrentAcc Menu</a></P>
        <P><a href=AmendView_CurrentAcc.html.php>AmendView CurrentAcc Menu</a></P>
       </ul> 
    </div>
    <script>
        function confirmCheck()
        {
            var response;
            response = confirm('Are you sure you want to save these changes?');
            if(response)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    </script>
    <!-- this will move to the open current acc php file but will also run the confirm check function on submit -->
<main>
<div class = "currentAccBody">
<h1>IF you arent registered yet you can go to this link</h1>
<A HREF="addCustomer.html">Click Here</A>
<br>
<h1>Open a current Account</h1>
<br>
<h3>Search Customer</h3>
<br>
<label>1.Enter Customer ID
<input type="number" id="cust_id_lookup" name="cust_id_lookup" />
</label>
<button type="button" onclick="lookupById()">Search</button>

<br><br>

<!-- Customer name dropdown populated from the database -->
<label>2.Select Customer by Name
<?php
include 'db.inc.php';
$sql = "SELECT CustId, Firstname, Surname, Phone, Email, eircode, dob FROM customer Where deleteFlag=0";
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
        // Pack all the data into the value so JS can split it out
        $allText = "$id,$fname,$sname,$phone,$email,$eircode,$dob";
        echo "<option value='$allText'>$fname $sname</option>";
    }
echo "</select>";
mysqli_close($con);
?>
</label>

<br><br>

<!-- Customer details shown here after lookup -->
<div id="customerDetails" style="display:none;">
<hr>
<h3>Are the Details Correct?</h3>
<br>
<p><strong>Customer ID:</strong> <span id="disp_id"></span></p>
<p><strong>Name:</strong> <span id="disp_name"></span></p>
<p><strong>Phone:</strong> <span id="disp_phone"></span></p>
<p><strong>Email:</strong> <span id="disp_email"></span></p>
<p><strong>Eircode:</strong> <span id="disp_eircode"></span></p>
<p><strong>Date of Birth:</strong> <span id="disp_dob"></span></p>
<p><strong>What your Current Acc ID will be:</strong> <span id="disp_curID"></span></p>	
<br>
<p>If the details above are correct, please fill in the account details below.</p>
<hr>
<br>

<!--Account details form -->
<h3> Account Details</h3>
<br>
<form action="openCurrentAcc.php" method="post" onsubmit="return confirmCheck()">

<!-- Hidden field to pass the customer ID into the form -->
<input type="hidden" name="cust_id" id="cust_id" />
<label>How much overdraft will you allow?
    <input type="text" name="overdraft" id="overdraft" pattern="[0-9]+" required/>
</label>
<br><br>

<button type="submit">Open Current Account</button>
<script src="openCurrentAcc.js"></script>
</form>
</main>

</body>
</html>

