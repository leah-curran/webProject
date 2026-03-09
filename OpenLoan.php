<link rel="stylesheet" href="draft.css" />
<?php
include 'db.inc.php';
date_default_timezone_set("UTC");

$sql= "SELECT * from customer where CustId = " . $_POST['personid'];

$result = mysqli_query($con,$sql);

$rowcount =mysqli_affected_rows($con);

if ($row = mysqli_fetch_array($result))
{
    echo "<br> The details of the selected person are <br> <br>";
    echo "The customerId is : " . $row['CustId' ] . "<br> <br>" ;
    echo "First Name is :" . $row['Firstname'] . "<br>";
    echo "Surname is :" . $row['Surname'] . "<br>";
    echo "Address is :" . $row['Address'] . "<br>";
    $date= date_create($row['dob']);
    echo "Date of Birth is :" . date_format($date,"d/m/Y") . "<br>";
}

else if ($rowcount == 0)
{echo "No matching records" ;}
 
$monthlyPayment=$_POST['bal'] /12;
        $sql = "INSERT INTO loanacc (CustID,LoanAmount,DateOpened, MonthlyPayment, AmountOwing, status)"
        . "VALUES ('$_POST[personid]','$_POST[bal]','$_POST[opened_date]', $monthlyPayment,'$_POST[bal]', 'open')";
   
if (!mysqli_query ($con, $sql))
    {
        die('Error in querying the database' . mysqli_error($con));
    }


 $sql = "SELECT * from loanacc innerjoin customer on customer.CustID = loanacc.CustID where CustID =" . $_POST['personid'] ;
 $result = mysqli_query($con,$sql);

$rowcount =mysqli_affected_rows($con);



    echo "<br> The details of your loan are <br> <br>";
    echo "Loan Amount :" . $_POST['bal'] . "<br>";
    echo "Your Monthly Payment :" . $monthlyPayment . "<br>";
    echo "The Amount Owed :" . $_POST['bal'] . "<br>";
    $date= date_create($row['opened_date']);
    echo "Status is : Open <br>";



?>
<!-- create a form that when you press the return button you return to the OpenLoanAccount page -->
<form action = "OpenLoanAcc.html" method = "POST">
<br>
    <input type="submit" value = "Return to Insert Page"/>
</form>