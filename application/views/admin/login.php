<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login</title>

  <!-- Bootstrap core CSS -->

  <link href="<?php echo base_url("/admin-assets"); ?>/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url("/admin-assets"); ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url("/admin-assets"); ?>/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/icheck/flat/green.css" rel="stylesheet">


  <script src="<?php echo base_url("/admin-assets"); ?>/js/jquery.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/validator/validator.js"></script> 


		

</head>

<body style="background:#FFFFFF;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <div id="wrapper">
    <div class="panel panel-default">
        <div class="panel-heading">Login</div>
        <div class="panel-body">
            
			<div class="animate">
				
				 <section class="login_content">
				  <form accept-charset="UTF-8" role="form" action="<?php echo base_url('admin/login/login1'); ?>" method="post">

					<div>
						<input class="form-control" placeholder="username" name="username" type="text">
					</div>
					<div>
					  <input class="form-control" placeholder="Password" name="password" type="password" >
					</div>
					<div>
					    <input class="btn btn-default submit" type="submit" value="Login" style="margin-left:0px">
						<a class="reset_pass" href="#">Lost your password?</a>
					</div>
					<div class="clearfix"></div>
				  </form>
				</section>
			</div>
	  
	   </div>
	</div>
      
    </div>
        </div>
                 
    

</body>

</html>
