<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CurrentAcc.css">
</head>
<body>
    <h1>Amend/View a Student</h1>
    <h4>Please Select a student and then click the amend button if you wish to update</h4>
    <?php include 'ListBox.php'; ?>
    <script>
        //function to put the values
        function populate()
        {
            var sel=document.getElementById("ListBox");
            var result;
            result=sel.options[sel.selectedIndex].value;
            var personDetails=result.split(',');
            document.getElementById("display").innerHTML="The details of the selected persons are: "+result;
            document.getElementById("amendid").value=personDetails[0];
            document.getElementById("amendBalance").value=personDetails[1];
            document.getElementById("amendDateOpened").value=personDetails[2];
            document.getElementById("amendAccStatus").value=personDetails[3];
        }
        //to togle between amend and view only
        function toggleLock()
        {
            if (document.getElementById("amendViewbutton").value=="Amend Details")
            {
                document.getElementById("amendBalance").disabled=false;
                document.getElementById("amendDateOpened").disabled=false;
                document.getElementById("amendAccStatus").disabled=false;
				document.getElementById("save").disabled=false;
                document.getElementById("amendViewbutton").value="View Details";
            }
            else
            {
                document.getElementById("amendBalance").disabled=true;
                document.getElementById("amendDateOpened").disabled=true;
                document.getElementById("amendAccStatus").disabled=true;
				document.getElementById("save").disabled=true;
                document.getElementById("amendViewbutton").value="Amend Details";
            }       
        }
        //check if the user actually wants to chance by using confirm
        function confirmCheck()
        {
            var response;
            response = confirm('Are you sure you want to save these changes?');
            if(response)
            {
                document.getElementById("amendid").disabled=false;
                document.getElementById("amendBalance").disabled=false;
                document.getElementById("amendDateOpened").disabled=false;
				document.getElementById("amendAccStatus").disabled=false;
				document.getElementById("save").disabled=false;
                document.getElementById("amendDOB").disabled=false;
                return true;
            }
            else
            {
                populate();
				if(document.getElementById("amendViewbutton").value="View Details")
				{
                toggleLock();
				}
                return false;
            }
        }
		function checkDate(input)
        {
            const inputDate= new Date(input.value);
            const today=new Date();
            if(inputDate>today)
            {
                input.setCustomValidity('Invalid Date, Cant be in the future');
            }
            else
            {
                input.setCustomValidity('');
            }
        }
    </script>
    <p id= "display"> </p>
    <input type ="button" value="Amend Details" id= "amendViewbutton" onclick="toggleLock()">
    <form name="myForm" action="AmendView.php" onsubmit="return confirmCheck()" method="post">
    <label for="amendid">Student ID</label>
    <input type="text" name="amendid" id="amendid" disabled>
	<br><br>
    <label for="amendBalance">Student Name</label>
    <input type="text" name="amendBalance" id="amendBalance" pattern="[0-9*\,]+" disabled>
		<br><br>
    <label for="amendstudentaddress">Student Address</label>
    <input type="text" name="amendstudentaddress" id="amendstudentaddress" pattern="[A-Z*\s*\a-z*\0-9*\,*\]" disabled>
		<br><br>
	<label for="amendAccStatus">Student CourseCode</label>
    <input type="text" name="amendAccStatus" id="amendAccStatus" disabled>
		<br><br>
    <label for="amendDateOpened">Date of Birth</label>
    <input type="date" name="amendDateOpened" id="amendDateOpened" max="<?php echo date('Y-m-d'); ?>" disabled>
    <br><br>
    <input type="submit" id="save" value="Save Changes" disabled>
    </form>
</body>
</html>