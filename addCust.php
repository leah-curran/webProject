<?php
    include 'db.inc.php';
    date_default_timezone_set("UTC");
    echo " New Customer Added: <br>";
    echo " First Name is : " . $_POST['firstname'] . "<br>";
    echo " Surname is : " . $_POST['surname'] . "<br>";
    echo " Surname is : " . $_POST['address'] . "<br>";
    echo " Surname is : " . $_POST['eircode'] . "<br>";
    

    $date=date_create($_POST['dob']);

    echo " Date of Birth is : " . date_format($date, "d/m/Y") . "<br>";

    echo " Surname is : " . $_POST['telephone'] . "<br>";
    echo " Surname is : " . $_POST['occupation'] . "<br>";
    echo " Surname is : " . $_POST['salary'] . "<br>";
    echo " Surname is : " . $_POST['email'] . "<br>";
    echo " Surname is : " . $_POST['guarantor'] . "<br>";



    $sql = "Insert into persons (firstname, lastname, DOB)
    VALUES ('$_POST[firstname]' , '$_POST[surname]', ' $_POST[address]', ' $_POST[eircode]' , ' $_POST[dob]'
    , ' $_POST[telephone]' , ' $_POST[occupation]' , ' $_POST[salary]' , ' $_POST[email]' , ' $_POST[guarantor]')";

    if (!mysqli_query($con,$sql))
        {
            die ("An Error in the SQL Query: " . mysqli_error($con));

        }

    echo "<br>A record has been added for " . $_POST['firstname'] . " " . $_POST['surname'] . ".";
    mysqli_close($con);
    ?>
    <form action=" addCustomer.html" method= "POST">
        <br>
            <input type="submit" value = "Return to Add Customer Page"/>
    </form>
