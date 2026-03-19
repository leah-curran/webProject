<link rel="stylesheet" href="draft.css" />
<?php
include 'db.inc.php';
date_default_timezone_set("UTC");

$sql= "SELECT * from customer where CustId = " . $_POST['personid'] ;

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
 $loanperiod=$_POST['loanperiod'];
$monthlyPayment=$_POST['bal'] /$loanperiod;
        $sql = "INSERT INTO loanacc (CustID,LoanAmount,DateOpened, MonthlyPayment, AmountOwing, status)"
        . "VALUES ('$_POST[personid]','$_POST[bal]','$_POST[opened_date]', $monthlyPayment,'$_POST[bal]', 'open')";
   
if (!mysqli_query ($con, $sql))
    {
        die('Error in querying the database' . mysqli_error($con));
    }


 $sql = "SELECT * from loanacc where CustID =" . $_POST['personid'] ;
 $result = mysqli_query($con,$sql);

$rowcount =mysqli_affected_rows($con);



    echo "<br> The details of your loan are <br> <br>";
    echo "Loan Amount :" . $_POST['bal'] . "<br>";
    echo "Your Monthly Payment :" . $monthlyPayment . "<br>";
    echo "The Amount Owed :" . $_POST['bal'] . "<br>";
    echo "Date Opened: " . $_POST['opened_date'] . " <br>";
    echo "Status is : Open <br>";

// Create transaction using loan amount as withdrawal
$amount = $_POST['bal'];
$date = date("Y-m-d");

$sqlTrans = "INSERT INTO transaction  (Amount, Type, Date)
VALUES ('$amount', 'Withdrawal', '$date')";

if (!mysqli_query($con, $sqlTrans))
{
    die('Error creating transaction: ' . mysqli_error($con));
}
else
{
    echo "<br><b>Transaction Successful</b><br>";
    echo "A withdrawal transaction of €" . $amount . " has been recorded for Customer ID: " .$_POST['personid']. "<br>";
}


?>
<!-- create a form that when you press the return button you return to the OpenLoanAccount page -->
<form action = "OpenLoanAcc.html" method = "POST">
<br>
    <input type="submit" value = "Return to Insert Page"/>
</form>