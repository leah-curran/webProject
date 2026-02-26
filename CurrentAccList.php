<link rel="stylesheet" href="currentAcc.css">
<?php
    include "db.inc.php";
    //sql code to find stuff in db
    $sql = "SELECT CurrentAccountId, Balance, DateOpened , AccStatus FROM CurrentAcc";
    if (!$result=mysqli_query($con,$sql))
    {
        die ('Error in querying the database'.mysqli_error($con));
    }
    echo "<br><select name ='ListBox' id='ListBox' onclick='populate()'>";
    // loops the rows until it reaches the end
    while($row =mysqli_fetch_array($result))
    {
        //adds the data that they get from the table
        $id=$row['CurrentAccountId'];
        $Balace=$row['Balance'];
        $DateOpened=$row['DateOpened'];
        $AccStatus=$row['AccStatus'];
        $AccStatus=date_create($row['DateOpened']);
        $AccStatus=date_format($AccStatus,"Y-m-d");
        $allText="$id,$Balace,$DateOpened,$AccStatus";
        echo "<option value='$allText'>$id </option>";
    }
    echo "</select>";
    mysqli_close($con);
?>  