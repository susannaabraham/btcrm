
<!DOCTYPE>
<HTML>
 <HEAD>
  <TITLE> Login </TITLE>
    <link href="<?php echo base_url()?>/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>/css/luman/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>/css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>/css/style.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url()?>/js/jquery-1.11.1.min.js"></script>
  <script src="<?php echo base_url()?>/js/bootstrap.min.js"></script>

<style>
body{

	background-color: #FFFFFF;

}

.vertical-offset-100{
    padding-top:100px;
}
</style>

 </HEAD>

 <BODY>



<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">

    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Agent Login</h3>
			 	</div>
			  	<div class="panel-body">
					<?php
          //echo $ext;
          if(!empty($ext)){
            $p=$ext;
          }else{
					  $p=get_cookie('bitvoice_exten');
          }

          if(!empty($p)){
            $type="hidden";
          }else{
            $type="text";
          }
          if($p != $ext){
            $type="text";
          }
					?>
					<center><!---b style="font-size: 34px;color: rgb(37, 143, 219);"></b--><img src="<?php echo base_url('/images'); ?>/logo.png"><br><br></center>
			    	<form accept-charset="UTF-8" role="form" action="<?php echo base_url('/login'); ?>" method="post">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="username" name="email" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
						<div class="form-group">
			    			<input class="form-control" placeholder="Agent Phone" name="agentphone" type="<?php echo $type?>" value="<?php echo $p?>">
			    		</div>
						<div class="form-group"  >
						<select name="ctype" class="form-control" >
						<option value="inbound">Inbound</option>
						<option value="outbound">Outbound</option>
						</select>

			    		</div>
						<!--
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
						-->
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">

			    	</fieldset>
			      	</form>
					<a href="<?php echo base_url('/admin/login'); ?>" style="float:right;"> Admin login </a>
			    </div>
			</div>
		</div>
	</div>




 </BODY>
</HTML>
