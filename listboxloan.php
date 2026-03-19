<?php
/* Name: Leah Curran
	 Student NO: C00310980
	 Date: 27/2/26 
     Lab 5 */
session_start();
include 'db.inc.php';

$sql = "SELECT *
        FROM customer
        INNER JOIN loanacc
        ON loanacc.CustId = customer.CustId";

if (!$result = mysqli_query($con,$sql))
{
    die ('Error in querying the database ' . mysqli_error($con));
}

echo "<br><select name='listbox' id='listbox' onclick='populate()'>";

while ($row = mysqli_fetch_array($result))
{
    $id = $row['CustId'];
	$loanid = $row['LoanAccId'];
    $fname = $row['Firstname'];
    $sname = $row['Surname'];
	$dateofbirth = $row['dob'];
    $dob = date_create($row['dob']);
    $dob = date_format($dob, "Y-m-d");
	$lamount = $row['AmountOwing'];
  $allText = "$id,$loanid,$fname,$sname,$dob,$lamount";

    echo "<option value='$allText'>$id - $fname $sname</option>";
}

echo "</select>";

mysqli_close($con);
?>
