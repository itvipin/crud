<?php
session_start();
require_once ('./config.php');
require_once ('./Models/User.php');

if (isset($_POST['signup']))
{
    $count_page = ("userid.txt");
	$hits = file($count_page);
	$hits[0]++;
    $fp = fopen($count_page, "w");
	fputs($fp, "$hits[0]");
    fclose($fp);
    $user_id = $hits[0];
	$insert= new User();
	$lastInsertId=$insert->insertUser($_POST,$user_id);
    if ($lastInsertId)
    {
        echo '<script>alert("Your Registration successfull and your student id is "+"' . $user_id . '")</script>';
		echo "<script>window.location.href='login.php'</script>";
    }
    else
    {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <link href="./assets/css/bootstrap.css" rel="stylesheet" />
    <link href="./assets/css/font-awesome.css" rel="stylesheet" />
    <link href="./assets/css/style.css" rel="stylesheet" />
	<script src="./validation.js"></script>  
    <style>
	.error-statement {
		display: none;
		color: red;
		font-size: 12px;
	}
	</style>	
  </head>
  <body>
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-6 col-md-offset-3">
            <h4 class="header-line text-center">USER SIGNUP</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-primary">
              <div class="panel-heading">
                SIGNUP FORM
              </div>
              <div class="panel-body">
                <form name="signup" method="post" onsubmit="return submitForm();" enctype="multipart/form-data" >
                  <div class="form-group">
                    <label>Enter Full Name</label>
                    <input class="form-control" type="text" name= "fullname" id="fullname" onblur="removeValidationError('fullNameError')" />
					<span id="fullNameError" class="error-statement">Full name is required</span>
                  </div>
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input class="form-control" type="text" name="mobileno" id="mobileno" maxlength="10" onblur="removeValidationError('mobileError')"  />
					<span id="mobileError" class="error-statement">Mobile number is required</span>
                  </div>
                  <div class="form-group">
                    <label>Enter Email</label>
                    <input class="form-control" type="text" name="email" id="emailid" onblur="return emailCheck();" /> 
					<span id="emailError" class="error-statement">Email is required</span>
					
                  </div>
                  <div class="form-group">
                    <label>Enter Password</label>
                    <input class="form-control" type="password" name="password" id="password" onblur="removeValidationError('passwordError')"  />
					<span id="passwordError" class="error-statement">Password required</span>
                  </div>	
                  <div class="form-group">
                    <label>Confirm Password </label>
                    <input class="form-control"  type="password" id="confirmpassword" onblur="removeValidationError('cPasswordError')"  />
					<span id="cPasswordError" class="error-statement">Re-enter Password</span>
                  </div>
				  <div class="form-group">
						<label class >Gender</label></br>
					<label class="radio-inline">
					<input type="radio" id="male" name="gender" value="male"  checked >Male
					</label>
					<label class="radio-inline">
					<input type="radio" id="female" name="gender" value="female" >Female
					</label>
					<label class="radio-inline">
					<input type="radio" id="transgender" name="gender" value="transgender" >Transgender
					</label>
                  </div>
				  <div class="form-group">
					<label>City</label>
					<select id="city" name="city" class="form-control" onchange="removeValidationError('cityError')">

						<option value="" selected></option>
						<option value="Jalandhar">Jalandhar</option>
						<option value="Ludhiana" >Ludhiana</option>
						<option value="Chandigarh">Chandigarh</option>
						<option value="Malerkotla">Malerkotla</option>
	
					</select>
					<span id="cityError" class="error-statement">City name is required</span>
				  </div>
				  <div class="form-group">
                    <label>Assign Role </label>
                    <select id="role" name="role" class="form-control" onchange="removeValidationError('roleError')">

						<option value="" selected></option>
						<option value="2">User</option>
						<option value="1" >Adminstrator</option>
	
					</select>
					<span id="roleError" class="error-statement">Select Role</span>
                  </div>
				  <div class="form-group">
				  <label> Select image to upload:</label>
						<input type="file" name="fileToUpload" id="fileToUpload">
				  </div>
				  
                <button type="submit" name="signup" class="btn btn-info" id="submitbutton">Register Now </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>


