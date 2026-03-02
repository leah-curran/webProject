<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CurrentAcc.css">
</head>
<body>
    <script>
        function confirmCheck()
        {
            return confirm("Is the information correct?");
        }
    </script>
    <div class="nav">
     <img src="pics/logo.jpg" width="100" height="100">
     <div class="links">
        <!-- the top bar menu to navigate between pages -->
    <ul><li><A HREF="AccountMaintenance.html">Home</A></li>
    <li><A HREF="openCurrentAcc.html">Open Current Account</A></li>

    </ul></div>
    </div>
    <!-- this will move to the open current acc php file but will also run the confirm check function on submit -->
    <h2>If you dont have an account yet, you can go to this link </h2>
    <li><A HREF="addCust.html">Open Customer Account</A></li>
    <form method="post" action="openCurrentAcc.php" onsubmit="return confirmCheck()">
        <h2>If you already have an account, pick from this list</h2>
        <?php
        include "db.inc.php";
        //sql code to find stuff in db
        $sql = "SELECT CustId, Firstname, Surname, Phone, 'Address', 'Password',Email FROM customer";

        if (!$result=mysqli_query($con,$sql))
        {
            die ('Error in querying the database'.mysqli_error($con));
        }
        echo "<br><select name ='ListBox' id='ListBox' onclick='populate()'>";
        // loops the rows until it reaches the end
        while($row =mysqli_fetch_array($result))
        {
            //adds the data that they get from the table
            $id=$row['CustId '];
            $firstName=$row['Firstname'];
            $lastName=$row['Surname'];
            $phone=$row['Phone'];
            $address=$row['Address'];
            $password=$row['Password'];
            $email=$row['Email'];
            $allText="$id,$firstName,$lastName,$phone,$address,$password,$email";
            echo "<option value='$allText'>$firstName $lastName</option>";
        }
        echo $id;
        echo $firstName;
        echo $lastName;
        echo $phone;
        echo $address;
        echo $password;
        echo $email;
        echo "If this information is correct, click submit";
        echo "</select>";
        mysqli_close($con);
        ?>
        <input type="submit" value="submit"/>
        <br>
        <input type="reset" value="Clear"/>
    </form>
</body>
</html>
