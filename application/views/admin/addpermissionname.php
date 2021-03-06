<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Permissions Name    </title>

  <!-- Bootstrap core CSS -->

  <link href="<?php echo base_url("/admin-assets"); ?>/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url("/admin-assets"); ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url("/admin-assets"); ?>/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/icheck/flat/green.css" rel="stylesheet">


  <script src="<?php echo base_url("/admin-assets"); ?>/js/jquery.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/validator/validator.js"></script> 

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
	<script language="javascript">
	$(document).ready(function(){
		//alert("")
		//window.dispatchEvent(new Event('resize'));
		//$(".x_panel").css("height",$(window).height());
		$(".x_panel").css("min-height",$(window).height()-200);
	});
	
	function deleteAdmin(id)
	{
		//alert(did);
		if(confirm("Are you sure you want to delete?")) 
		{
			$.ajax(
			{				
				type: "POST",
				url: '<?php echo base_url("/admin/permissionname/deletepermissionname")?>',
				data: {'groupid':id},
				dataType: 'json',
				success: function(d)
				{	
					if(d.success==true){
					//alert("ok");
					 window.location.reload();
				
					}
					else
					{ 
						alert("Not able to Delete.");
					}
				}
			});	 
		}		
	}
	</script>

</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

     <?php
		$this->load->view("admin/menu");
	 ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Manage Permissions                
                </h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <!--<div class="x_title">
                  <h2>Permission Name</h2>
                 
                  <div class="clearfix"></div>
                </div>-->
				<?php if($message){
					echo $message;
				} else { ?>
                <div class="x_content">
                  <p style="text-align:right;"><a href="<?php echo base_url("admin/permissionname/newpermissionname"); ?>"  class="btn btn-primary"><i class="fa fa-plus"></i> Add New Permissions</a></p>
                  <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                      <tr role="row">
					  <th width="40%">Permission Name</th>
					  
					  <th style="text-align:right">Action</th>
                    </thead>
                    <tbody>  
						<?php
						if(isset($results[0]->permission))
						        {
						for($i=0;$i<count($results);$i++){
						?>
						<TR id="dat_<?php echo $results[$i]->permission; ?>" role="row" class="odd">
							<TD><?php echo $results[$i]->value; ?></TD>
							
							<TD style="text-align:right">
								<a class="btn btn-default " href="<?php echo base_url('/admin/permissionname/editPermissionname')."?keyword=".$results[$i]->permission; ?>"><i class="fa fa-edit"></i></a>
								<a class="btn btn-default " href="javascript:void(0);" onClick="deleteAdmin('<?php echo $results[$i]->permission; ?>');"><i class="fa fa-remove"></i></a>
							</TD>
						</TR>
						<?php
								} }
						?> 
                    </tbody>
                  </table>
				    <div class="new-pagination">
						<?php echo $links; ?>
					</div>
				  </div>
				<?php } ?></div></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Bitvoice Solutions PVT LTD
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="<?php echo base_url("/admin-assets"); ?>/js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="<?php echo base_url("/admin-assets"); ?>/js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="<?php echo base_url("/admin-assets"); ?>/js/icheck/icheck.min.js"></script>
  <!-- pace -->
  <script src="<?php echo base_url("/admin-assets"); ?>/js/pace/pace.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/custom.js"></script>
  
  
  <script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);
  </script>

</body>

</html>
