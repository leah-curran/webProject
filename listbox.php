<?php
/* Name: Leah Curran
	 Student NO: C00310980
	 Date: 27/2/26 
     Lab 5 */
session_start();
include 'db.inc.php';

$sql = "select CustID,firstName,lastName, DOB from customers where DeletedFlag = 0 " ;

if (!$result = mysqli_query($con,$sql))
{
    die ('Error in querying the database' . mysqli_error($con));

}

echo "<br><select name = 'listbox' id = 'listbox' onclick= 'populate()'" ;

while ($row = mysqli_fetch_array($result))
{
    $id = $row['CustID'];
    $fname = $row['FirstName'];
    $sname = $row['Surname'];
    $dateofBirth = $row['DOB'];
    $dob = date_create($row['DOB']);
    $dob = date_format($dob, "Y-m-d");
    $allText = "$id,$fname,$sname,$dob";
    echo "<option value = '$allText'> $fname $sname </option>";}
echo "</select>";	
mysqli_close($con);
?>
