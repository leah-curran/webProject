<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="draft.css">
    <title>Customer Maintenance</title>
</head>
<body>
   
    <div class="nav">
     <img src="pics/logo.jpg" width="100" height="100">
     <div class="links">
    <ul><li><A HREF="MainMenu.html">Home</A></li>
<li><A HREF="withdrawals.html">Withdrawals</A></li>
<li><A HREF="Lodgements.html">Lodgements</A></li>
<li><A HREF="CustomerMaintenance.html">Customer Maintenance</A></li>
<li><A HREF="AccountMaintenance.html">Account Maintenance</A></li>
<li><A HREF="Management.html">Management</A></li>
<li><A HREF="Reports.html">Reports</A></li>
<li><A HREF="Quotes.html">Quotes</A></li>
<li><A HREF="ChangePassword.html">Change Password</A></li>
</ul></div>
    </div>
     <div class="submenu">
       <ul>
        <P><a href=addCustomer.html>Add Customer </a></P><!--Change-->
        <P><a href=deleteCustomer.html>Delete Customer</a></P>
        <P><a href=amendViewCustomer.html.php>Amend/View Customer</a></P>
       </ul> 
    </div>
	
<div class="amendCust">	
	<!-- Page heading -->
    <h1> Amend/View a person</h1>
    <h4>Please select a person and then click the amend button if you wish to update </h4>

    <?php 
        include 'listboxCust.php';
    ?>

    <script>

        // This function runs when a person is selected from the listbox
        // It fills the form fields with the selected person's details
        function populate()
        {
            // Get the selected value from the listbox
            var sel = document.getElementById("listbox");
            var result;

            // Store selected option value
            result = sel.options[sel.selectedIndex].value;

            // Split the value into an array (ID, First Name, Last Name, DOB)
            var personDetails = result.split(',');

            // Display selected person details on screen
           // document.getElementById("display").innerHTML = 
               // "The details of the selected person are: " + result;

            // Fill form fields with the selected person's data
            document.getElementById("amendid").value = personDetails[0];
            document.getElementById("amendfirstname").value = personDetails[1];
            document.getElementById("amendlastname").value = personDetails[2];
            document.getElementById("amendDOB").value = personDetails[3];
			document.getElementById("amendAddress").value = personDetails[4];
			document.getElementById("amendEircode").value = personDetails[5];
			document.getElementById("amendphone").value = personDetails[6];
			document.getElementById("amendEmail").value = personDetails[7];
			document.getElementById("amendOccupation").value = personDetails[8];
			document.getElementById("amendSalary").value = personDetails[9];
			document.getElementById("amendGuarantor").value = personDetails[10];

        }

        // This function enables or disables the form fields
        function toggleLock()
{
    if (document.getElementById("amendViewbutton").value == "Amend Details") // == not =
    {
        document.getElementById("amendfirstname").disabled = false;
        document.getElementById("amendlastname").disabled = false;
        document.getElementById("amendDOB").disabled = false;
        document.getElementById("amendAddress").disabled = false;
        document.getElementById("amendEircode").disabled = false;
        document.getElementById("amendphone").disabled = false;
        document.getElementById("amendEmail").disabled = false;
        document.getElementById("amendOccupation").disabled = false;
        document.getElementById("amendSalary").disabled = false;
        document.getElementById("amendGuarantor").disabled = false;
        document.getElementById("amendViewbutton").value = "Lock Fields"; // change button text
    }
    else
    {
        document.getElementById("amendfirstname").disabled = true;
        document.getElementById("amendlastname").disabled = true;
        document.getElementById("amendDOB").disabled = true;
        document.getElementById("amendAddress").disabled = true;
        document.getElementById("amendEircode").disabled = true;
        document.getElementById("amendphone").disabled = true;
        document.getElementById("amendEmail").disabled = true;
        document.getElementById("amendOccupation").disabled = true;
        document.getElementById("amendSalary").disabled = true;
        document.getElementById("amendGuarantor").disabled = true;
        document.getElementById("amendViewbutton").value = "Amend Details";
    }
}
        // This function runs when the form is submitted
        // It asks the user to confirm before saving changes
        function confirmCheck()
        {
            var response;

            // Show confirmation message
            response = confirm('Are you sure you want to save these changes?');

            if (response)
            {
                // Enable all fields before submitting form
				document.getElementById("amendid").disabled = false;
                document.getElementById("amendfirstname").disabled = false;
                document.getElementById("amendlastname").disabled = false;
                document.getElementById("amendDOB").disabled = false;
				document.getElementById("amendAddress").disabled = false;
				document.getElementById("amendEircode").disabled = false;
				document.getElementById("amendphone").disabled = false;
				document.getElementById("amendEmail").disabled = false;
				document.getElementById("amendOccupation").disabled = false;
				document.getElementById("amendSalary").disabled = false;
				document.getElementById("amendGuarantor").disabled = false;

                return true; // Allow form submission
            }
            else
            {
                // If user clicks Cancel, reset fields
                populate();
                toggleLock();

                return false; // Stop form submission
            }
        }

    </script>

    <!-- Paragraph to display selected person's details -->
    <p id="display"> </p>

    <!-- Button to enable editing -->
    <input type="button" value="Amend Details" id="amendViewbutton" onclick="toggleLock()">

    <!-- Form to submit updated details -->
    <form name="myForm" action="AmendViewCust.php" onsubmit="return confirmCheck()" method="post">
<div class="addform">
        <!-- Person ID field -->
        <label for='amendid'>Customer Id </label>
        <input type="text" name="amendid" id="amendid" disabled ><br><br>

        <!-- First Name field -->
        <label for='amendfirstname'>First Name </label>
        <input type="text" name="amendfirstname" id="amendfirstname" disabled><br><br>

        <!-- Last Name field -->
        <label for='amendlastname'>Surname</label>
        <input type="text" name="amendlastname" id="amendlastname" disabled><br><br>

        <!-- Date of Birth field -->
        <div class="addDob"><label for='amendDOB'>Date of Birth </label>
        <input type="date" name="amendDOB" id="amendDOB" 
			   title="format is dd-mm-yyyy" disabled></div> <br>

			<label for='amendAddress'>Address </label>
        <input type="text" name="amendAddress" id="amendAddress" disabled>
        <br><br>
	
	<label for='amendEircode'>Eircode</label>
        <input type="text" name="amendEircode" id="amendEircode" disabled><br><br>
		
			<label for='amendphone'>Phone Number</label>
        <input type="text" name="amendphone" id="amendphone" disabled>
        <br><br>
		
	 <label for='amendEmail'>Email</label>
        <input type="email" name="amendEmail" id="amendEmail" disabled><br><br>
	   
		<label for='amendOccupation'>Occupation</label>
        <input type="text" name="amendOccupation" id="amendOccupation" disabled>
        <br><br>	    

			<label for='amendSalary'>Salary</label>
        <input type="text" name="amendSalary" id="amendSalary" disabled>
        <br><br>
	
	<label for='amendGuarantor'>Guarantor</label>
        <input type="text" name="amendGuarantor" id="amendGuarantor" disabled>
        <br><br>
	
        <!-- Submit button -->
	<input type="submit" value="Save Changes"></div>
    </form>
</div>
	
</body>
</html>
