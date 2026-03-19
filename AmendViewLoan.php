<link rel="stylesheet" type="text/css" href="draft.css"><?php

include 'db.inc.php';


$monthlyPayment = $_POST['amendloanamount'] / $_POST['amendloanperiod'];

$sql = "UPDATE loanacc 
        SET LoanAmount = '{$_POST['amendloanamount']}', 
        MonthlyPayment = '{$monthlyPayment}',
        AmountOwing = '{$_POST['amendloanamount']}',
        Status = 'open'
        WHERE CustID = '{$_POST['amendid']}'";

if (!mysqli_query($con,$sql))
{
    die("Error " . mysqli_error($con));
}

$sql = "SELECT * 
        FROM loanacc 
        INNER JOIN customer 
        ON customer.CustID = loanacc.CustID 
        WHERE customer.CustID = '{$_POST['amendid']}'";

$result = mysqli_query($con,$sql);   // store result

if ($result)
{
    $row = mysqli_fetch_array($result);
	?><div class='amendloan'>
<?php
    echo "Record(s) updated for: ";
    echo $row['Firstname'] . " " . $row['Surname'];
    echo "<br> The details of your loan are <br> <br>";
    echo "Loan Amount :" . $row['LoanAmount'] . "<br>";
    echo "Your Monthly Payment : €" . number_format($monthlyPayment, 2) . "<br>";
    echo "The Amount Owed :" .$row['AmountOwing']. "<br>";
}
else
{
    echo "No records were changed";
}

mysqli_close($con);
?>
</div>


<form action="AmendViewLoan.html.php" method="post">
<input type="submit" value="Return to Previous Screen">
</form>