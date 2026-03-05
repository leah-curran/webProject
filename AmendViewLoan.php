<?php

include 'db.inc.php';

date_default_timezone_set('UTC');
$dbDate = date("Y-m-d",strtotime($_POST['amendDOB']));

$sql = "UPDATE loanacc SET LoanAmount = '{$_POST['amendloanamount']}', 
MonthlyPayment = '{$monthlyPayment}',AmountOwing = '{$_POST['amendloanamount']}',status = 'open'
WHERE CustID = '{$_POST['amendid']}'";

if (! mysqli_query($con,$sql))
{
    die "Error " . mysqli_error($con);
}
else
{
    if (mysqli_affected_rows($con)!= 0)
    {
        $sql = "SELECT * from loanacc innerjoin customer on customer.CustID = loanacc.CustID where CustID =" . $_POST['personid'] ;
        $result = mysqli_query($con,$sql);
        $row =mysqli_affected_rows($con);
        echo "record(s) updated for: ";
        echo .$row['Firstname'] ." ". $row['Lastname'] ;
    }
    else{
        echo "No records were changed";
    }
}
mysqli_close($con);
?>
<link rel="stylesheet" type="text/css" href="report.css">
<form action = "AmendView.html.php" method = "post" >
<input type = "submit" value = "Return to Previous Screen">
</form>