<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="draft.css" />
  <title>Customer Added</title>
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

  <?php
    include 'db.inc.php';
    date_default_timezone_set("UTC");
  ?>

  <div class="addbody">
  
      <?php
        echo "New Customer Added:<br>";
        echo "First Name is: " . htmlspecialchars($_POST['firstname']) . "<br>";
        echo "Surname is: " . htmlspecialchars($_POST['surname']) . "<br>";
        echo "Address is: " . htmlspecialchars($_POST['address']) . "<br>";
        echo "Eircode is: " . htmlspecialchars($_POST['eircode']) . "<br>";

        $date = date_create($_POST['dob']);
        echo "Date of Birth is: " . date_format($date, "d/m/Y") . "<br>";

        echo "Phone is : " . htmlspecialchars($_POST['telephone']) . "<br>";
        echo "Occupation is : " . htmlspecialchars($_POST['occupation']) . "<br>";
        echo "Salary is : " . htmlspecialchars($_POST['salary']) . "<br>";
        echo "Email is : " . htmlspecialchars($_POST['email']) . "<br>";
        echo "Guarantor is : " . htmlspecialchars($_POST['guarantor']) . "<br>";

        $sql = "INSERT INTO customer (Firstname, Surname, Address, eircode, dob, Phone, occupation, salary, Email, guarantor) 
VALUES ('{$_POST['firstname']}', '{$_POST['surname']}', '{$_POST['address']}', '{$_POST['eircode']}', '{$_POST['dob']}', '{$_POST['telephone']}', '{$_POST['occupation']}', '{$_POST['salary']}', '{$_POST['email']}', '{$_POST['guarantor']}')";

        if (!mysqli_query($con, $sql)) {
          die("An Error in the SQL Query: " . mysqli_error($con));
        }

        $sql = "SELECT CustId FROM customer WHERE Phone = '" . mysqli_real_escape_string($con, $_POST['telephone']) . "'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        echo "<br>Customer ID is:<br>" . htmlspecialchars($row['CustId']);
        echo "<br>A record has been added for " . htmlspecialchars($_POST['firstname']) . " " . htmlspecialchars($_POST['surname']) . ".";
        mysqli_close($con);
      ?>
  
<br><br><br><br>
    
      <form action="addCustomer.html" method="POST">
        <input type="submit" value="Return to Add Customer" />
      </form>
  
  </div>
</body>
</html>
