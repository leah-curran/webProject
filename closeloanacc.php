<?php session_start();
?> <br><br><link rel="stylesheet" type="text/css" href="draft.css">
<?php
include 'db.inc.php';
$sql = "SELECT AmountOwing FROM loanacc WHERE LoanAccId = '$_POST[delloanid]'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
if ($row['AmountOwing'] > 0)
{
	echo "You can't close an account until your loan is paid off";
	
}
else{
	
$sql = "UPDATE loanacc SET DeleteLoan = true WHERE LoanAccId = '$_POST[delloanid]'";

if (!mysqli_query($con,$sql))
{
	echo "Error " . mysqli_error($con);
}

$_SESSION["personid"]= $_POST['delid'];
$_SESSION["firstname"]= $_POST['delfirstname'];
$_SESSION["lastname"]= $_POST['dellastname'];

		if (ISSET($_SESSION["personid"])) { echo "<h1 class='myMessage'> Account Closed for ". $_SESSION["firstname"] . " " . $_SESSION["lastname"]. "</h1>";}
		session_destroy();

}
echo "<form action = 'closeLoanAcc.html.php' method = 'POST' >
    <br>
    <input type='submit' value = 'Return to Close Loan Page'/></form>";
mysqli_close($con);
?>
