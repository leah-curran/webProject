<?php
include 'db.inc.php';
date_default_timezone_set("UTC");

$sql= "SELECT * from customers where CustId = " . $_POST('personid');

$result = mysqli_query($con,$sql);

$rowcount =mysqli_affected_rows($con);

if ($rowcount == 1)
{
    echo "<br> The details of the selected person are <br> <br>";
    echo "The customerId is : " . $_POST['CustId' ] . "<br> <br>" ;
    echo "First Name is :" . $row['Firstname'] . "<br>";
    echo "Surname is :" . $row['Surname'] . "<br>";
    echo "Address is :" . $row['Address'] . "<br>";
    
    

    echo "Opening Balance is :" . $row['Balance'] . "<br>";
    $date= date_create($_POST['dob']);
    echo "Date of Birth is :" . date_format($date,"d/m/Y") . "<br>";

}
else if ($rowcount == 0)
        {echo "No matching records" ;}
    mysqli_close($con) ;
?>
<!-- create a form that when you press the return button you return to the OpenLoanAccount page -->
<form action = "OpenLoanAcc.html" method = "POST">
<br>
    <input type="submit" value = "Return to Insert Page"/>
</form>