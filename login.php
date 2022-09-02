<?php
require_once('./config.php');
include('./Models/User.php');
	
if (isset($_POST['login']))
{
	//echo"<pre>";print_r($_SERVER);exit;
	$userClass = new User();
	$user = $userClass->getUser($_POST['emailid'], $_POST['password']);
    if ($user)
    {
		
		if ($user->is_active == 1)
		{
			// echo "<pre>"; print_r($user); exit;
			session_start();
			$_SESSION['current_user'] = $user;
			header('location:user_data.php');
			exit;
		}
		else
		{
			echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";

		}
    }
    else
    {
        echo "<script>alert('Invalid Details');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>
  <body>   
        <div class="row pad-botm">
          <div class="col-md-6 col-md-offset-3 text-center">
            <h2>USER LOGIN FORM</h2>
          </div>
        </div>
        <a name="ulogin"></a>
        <div class="row pad-botm">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="panel panel-info">
              <div class="panel-heading"> LOGIN FORM </div>
              <div class="panel-body">
                <form role="form" method="post">
                  <div class="form-group">
                    <label>Enter Email id</label>
                    <input class="form-control" type="text" name="emailid" />
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" />
                  </div>
                  <button type="submit" name="login" class="btn btn-info">LOGIN </button> <a href="signup.php" class=" btn btn-success" > SIGN UP </a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
