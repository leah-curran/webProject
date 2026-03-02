<html>
	<head>  <link rel="stylesheet" href="draft.css"></head>
	<body>
<?php
    include 'db.inc.php';
    date_default_timezone_set("UTC");

    echo " New Customer Added: <br>";
    echo " First Name is : " . $_POST['firstname'] . "<br>";
    echo " Surname is : " . $_POST['surname'] . "<br>";
    echo " Address is : " . $_POST['address'] . "<br>";
    echo " Eircode is : " . $_POST['eircode'] . "<br>";

    $date=date_create($_POST['dob']);

    echo " Date of Birth is : " . date_format($date, "d/m/Y") . "<br>";

    echo " Phone is : " . $_POST['telephone'] . "<br>";
    echo " Occupation is : " . $_POST['occupation'] . "<br>";
    echo " Salary is : " . $_POST['salary'] . "<br>";
    echo " Email is : " . $_POST['email'] . "<br>";
    echo " Guarantor is : " . $_POST['guarantor'] . "<br>";



    $sql = "Insert into customer (Firstname, Surname,Address, eircode, dob, Phone, occupation, salary, Email, guarantor)
    VALUES ('$_POST[firstname]' , '$_POST[surname]', ' $_POST[address]', ' $_POST[eircode]' , ' $_POST[dob]'
    , ' $_POST[telephone]' , ' $_POST[occupation]' , ' $_POST[salary]' , ' $_POST[email]' , ' $_POST[guarantor]')";

    if (!mysqli_query($con,$sql))
        {
            die ("An Error in the SQL Query: " . mysqli_error($con));

        }

$sql = "SELECT CustId From customer WHERE Phone = " . $_POST['telephone'];
 $result = mysqli_query($con,$sql);

$row = mysqli_fetch_array($result);
    echo "<br>  Customer ID is :<br>" . $row['CustId'] ;

  
    

    echo "<br>A record has been added for " . $_POST['firstname'] . " " . $_POST['surname'] . ".";
    mysqli_close($con);
    ?>
    <form action=" addCustomer.html" method= "POST">
        <br>
            <input type="submit" value = "Return to Add Customer Page"/>
    </form>
	</body>
</html>