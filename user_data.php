<?php
session_start();
require_once ('./config.php');
require_once ('./Models/User.php');
if (!isset($_SESSION['current_user']))
{
    header('location:login.php');
}
else
{
	$userClass = new User();
	$cnt = $userClass->dataCount()->user_count ?? 0;
	$current_page = $_GET['pageNo'] ?? 1;
	//echo "<pre>";print_r($cnt);exit;
    if (isset($_GET['del_id']))
    {
		$userClass->deleteUser($_GET['del_id']);
        $_SESSION['delmsg'] = "Category deleted scuccessfully ";
        header('location:user_data.php');
    }
	
	
?>

<!DOCTYPE html>
<html>
<head>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>  
    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">MANAGE USER DATA</h4> <a href="logout.php" class="btn btn-danger">logout </a>
				<a href="user_data.php?role_name=USER">  <button class="btn btn-primary">USER</button></a>
				<a href="user_data.php?role_name=ADMINISTRATOR">  <button class="btn btn-info">ADMINISTRATOR</button></a>
				<a href="user_data.php">  <button class="btn btn-primary">ALL</button></a>
			</div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading success" >
                           USER INFO
                        </div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
											<thead>
													<tr>
													<th>#</th>
													<th>Full Name</th>
													<th>Mobile</th>
													<th>Gender</th>
													<th>City</th>
													<th>Role</th>
													<th>Action</th>
													</tr>
											</thead>
										<tbody>
<?php
	$usersDetails = $userClass->getUsers(null, $_GET['role_name'] ?? null, $current_page ?? 1,PAGE_SIZE);
	if (isset($usersDetails))
    {
		//echo "<pre>"; print_r(count($usersDetails)); exit;
        foreach ($usersDetails as $index => $result)
        {
?>                              
			<tr class="odd gradeX">
				<td class="center"><?php echo htmlentities(($index + 1) + PAGE_SIZE * ($current_page-1)); ?></td>
				<td class="center"><?php echo htmlentities($result->username); ?></td>
				<td class="center"><?php echo htmlentities($result->mobile); ?></td>
				<td class="center"><?php echo htmlentities($result->gender); ?></td>
				<td class="center"><?php echo htmlentities($result->city); ?></td>
				<td class="center"><?php echo htmlentities($result->role_name); ?></td>
				<td class="center">
					<a href="update_details.php?user_id=<?php echo htmlentities($result->user_id); ?>"><button class="btn btn-primary"><i class="fa fa-pencil"></i> UPDATE</button> </a>
					<a href="user_data.php?del_id=<?php echo htmlentities($result->user_id); ?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button class="btn btn-danger"><i class="fa fa-trash-o"></i> DELETE </button>
				</td>
			</tr>		
										
		<?php
        }
    } ?>                                      
									</tbody>
								</table>
                            </div>   
                        </div>
                    </div>
					<ul class="pagination">
							    <li class="page-item <?php echo $current_page <= 1 ? 'disabled': ''; ?>"><a class="page-link" href="user_data.php?pageNo=<?php echo ($current_page-1);?>">Previous</a></li>	
					<?php
						 $total_page = ($cnt % PAGE_SIZE === 0) ?  ($cnt / PAGE_SIZE) : ($cnt / PAGE_SIZE)+1;
						 for ($i = 1 ; $i <= $total_page ; $i++)
						 {
						 ?>
								<li class="page-item <?php echo ($current_page == $i) ? 'active': ''; ?>"><a class="page-link " href="user_data.php?pageNo=<?php echo $i;?>"><?php echo $i;?></a></li>
						 <?php
						 }
						 ?>
								<li class="page-item <?php echo $current_page >= $total_page-1 ? 'disabled': ''; ?>"><a class="page-link" href="user_data.php?pageNo=<?php echo ($current_page+1)?>">Next</a></li>
						</ul>
					
				</div>
            </div>       
		</div>
    </div>
</body>
</html>
<?php
} 
?>
