<link rel="stylesheet" href="Php4.css">
<?php
    include "db.inc.php";
    //sql code to find stuff in db
    $sql = "SELECT CurrentAccID, Balance, DateOpened, 'Status' FROM CurrentAcc";


    if (!$result=mysqli_query($con,$sql))
    {
        die ('Error in querying the database'.mysqli_error($con));
    }
    echo "<br><select name ='ListBox' id='ListBox' onclick='populate()'>";
    // loops the rows until it reaches the end
    while($row =mysqli_fetch_array($result))
    {
        //adds the data that they get from the table
        $id=$row['CurrentAccID'];
        $Balance=$row['Balance'];
        $Status=$row['Status'];
		$dateOpened=$row['DateOpened'];
        $dateOpened=date_create($row['DateOpened']);
        $dateOpened=date_format($dob,"Y-m-d");
        $allText="$id,$Balance,$Status,$dateOpened";
        echo "<option value='$allText'>$firstName $lastName</option>";
    }
    echo "</select>";
    mysqli_close($con);
?>