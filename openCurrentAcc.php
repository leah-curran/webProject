<?php
   include 'db.inc.php';
   date_default_timezone_set("UTC");
   echo "Your Account Deatils Are: <br>";
   echo "Current Acc ID is: ".$_POST['cust_id']."<br>";
   echo "Balance is: ".$_POST['Balance']."<br>";
   $date=date("d-M-Y");
   echo "Date Opened is: ".date("d-M-Y");
   $status="User";
   $sql="INSERT INTO currentacc (CurrentAccountID,Balance,DateOpened,Status) 
   VALUES('$_POST[cust_id]','$_POST[Balance]','$date','$status')";
   echo  "<br>A record has been added for ".$_POST['cust_id']."".$_POST['Balance']."".$date."".$status."";
   // Execute the SQL query and check if it was successful
if (!mysqli_query($con, $sql))
    {
        die("An Error in the SQL Query: " . mysqli_error($con));
    }

// Get the new account ID that was automatically generated
$new_account_id = mysqli_insert_id($con);

// Display a message confirming the account was opened
echo "<br>A Current account has been opened for Customer ID " . $_POST['cust_id'] . ".";
echo "<br>The new Current Account Number is: " . $new_account_id;

// Close the database connection
mysqli_close($con);
?>

<!-- Button to return to the Open current Account page -->
<form action = "openCurrentAcc.html.php" method = "POST">
<br>
    <input type="submit" value = "Return to Insert Page"/>
</form> 