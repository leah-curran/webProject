
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="draft.css">
    <title>Customer Maintenance</title>
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
        <P><a href=addCustomer.html>Add Customer </a></P><!--Change-->
        <P><a href=deleteCustomer.html>Delete Customer</a></P>
        <P><a href=amendViewCustomer.html.php>Amend/View Customer</a></P>
       </ul> 
    </div>
	
<div class="amendCust">	
	<!-- Page heading -->
    <h1> Amend/View a person</h1>
<?php

// Include the database connection file
include 'db.inc.php';

// Set the default timezone
date_default_timezone_set('UTC');

// Convert the date from the form into database format (YYYY-MM-DD)
$dbDate = date("Y-m-d", strtotime($_POST['amendDOB']));

// Create SQL query to update the selected person's details
$sql = "UPDATE customer SET 
Firstname = '{$_POST['amendfirstname']}',
Surname = '{$_POST['amendlastname']}',
Email = '{$_POST['amendEmail']}',
Phone = '{$_POST['amendphone']}',
Address = '{$_POST['amendAddress']}',
eircode = '{$_POST['amendEircode']}',
occupation = '{$_POST['amendOccupation']}',
salary = '{$_POST['amendSalary']}',
guarantor = '{$_POST['amendGuarantor']}',
dob = '$dbDate'
WHERE CustID = '{$_POST['amendid']}'";  

// Execute the SQL query
if (!mysqli_query($con, $sql))
{
    // Display error message if query fails
    echo "Error " . mysqli_error($con);
}
else
{
    // Check if any rows were actually updated
    if (mysqli_affected_rows($con) != 0)
    {
        // Display success message and number of records updated
        echo mysqli_affected_rows($con) . " record(s) updated <br>";

        // Display confirmation of updated person details
        echo "customer ID " . $_POST['amendid'] . ", " 
        . $_POST['amendfirstname'] . " " 
        . $_POST['amendlastname'] . " has been updated";
    }
    else
    {
        // If no rows were changed
        echo "No records were changed";
    }
}

// Close the database connection
mysqli_close($con);

?>

<!-- Form button to return to the previous screen -->
<form action="amendViewCustomer.html.php" method="post">
    <input type="submit" value="Return to Previous Screen">
</form>
</div>
	
</body>
</html>