<?php
session_start();
require_once ('./config.php');
require_once ('./Models/User.php');
if (!isset($_SESSION['current_user']))
{
	header('location:login.php');
}else{ 
    
    $updateClass = new User();
		if(isset($_POST['update']))
		{
			$updateClass->updateUser($_POST,$_GET['user_id']);
			echo "<script>alert('User info updated successfully');</script>";
			echo "<script>window.location.href='user_data.php'</script>";
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet" />
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
			  <div class="col-md-12">
				<h4 class="header-line">Edit Details</h4>
			  </div>
			</div>
			<div class="row">
				<div class="col-md12 col-sm-12 col-xs-12">
				<div class="panel panel-info">
				<div class="panel-heading ">USER INFORMATION</div>
				<div class="panel-body">
                <form name= "update" method="post"> 
				<?php 
					$existed_data=$updateClass->getUsers($_GET['user_id']);
					$cnt=1;
					if(isset($existed_data)) {
					foreach($existed_data as $result)
				{              
				?> 
					<div class="col-md-6">
						<div class="form-group">
						  <label>Full Name <span style="color:red;">*</span></label>
						  <input class = "form-control" type = "text" name = "efullname" id = "efullname" value = <?php echo htmlentities($result->username);?> > 
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>Mobile <span style="color:red;">*</span></label>
						  <input class="form-control" type="text" name = "emobile" id="emobile" maxlength="10" value=<?php echo htmlentities($result->mobile);?> >
						  
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						<label>Gender <span style="color:red;">*</span></label>
                      <select id="egender" name="egender" class="form-control" > 
                        <option selected><?php echo htmlentities($result->gender);?></option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                        <option value="transgender">transgender</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>City <span style="color:red;">*</span>
                      </label>
                      <select id="ecity" name="ecity" class="form-control">
                        <option selected><?php echo htmlentities($result->city);?></option>
                        <option value="Jalandhar">Jalandhar</option>
                        <option value="Ludhiana">Ludhiana</option>
                        <option value="Chandigarh">Chandigarh</option>
						<option value="Malerkotla">Malerkotla</option>
                      </select>
                      <br/>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" name="update" id="update" class="btn btn-info">Update </button> <a href="logout.php" class="btn btn-danger">logout </a>
					</div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php } } ?>
  </body>
</html> 
<?php }?>
