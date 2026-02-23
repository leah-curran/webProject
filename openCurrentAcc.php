 <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
        include 'db.inc.php';
        date_default_timezone_set("UTC");
        echo "Your Account Deatils Are: <br>";
	    echo "Current Acc ID is: ".$_POST['CurrentAccID']."<br>";
        echo "Balance is: ".$_POST['Balance']."<br>";
	    $date=date("d-M-Y");
        echo "Date Opened is: ".date("d-M-Y");
        $status="User";    
        $sql="Insert into CurrentAcc (CurrentAccID,Balance,DateOpened,Status) 
        VALUES('$_POST[CurrentAccID]','$_POST[Balance]','$date','$status')";
        echo  "<br>A record has been added for ".$_POST['CurrentAccID']."".$_POST['Balance']."".$date."".$status."";
        if(!mysqli_query($con,$sql))
        {
			   die("An Error in the sql Query: ".mysqli_error($con));
        }
     }   
    mysqli_close($con);
    ?>
    <form action="openCurrentAcc.html"method="POST">
        <br>
        <input type="submit"value="Return to Insert Page"/>
    </form>