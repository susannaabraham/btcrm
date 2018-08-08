<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Edit Admin</title>

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
	<style type="text/css">
		.alert-box { color:#555; border-radius:10px; font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px; padding:10px 10px 10px 36px; margin:10px; } 
		.alert-box span { font-weight:bold; text-transform:uppercase; } 
		.error { background:#ffecec; border:1px solid #f5aca6; } 
		.success { background:#e9ffd9; border:1px solid #a6ca8a; } 
		#msgbx_err{ display: none; } 
		#msgbx_success{ display: none; } 
    </style>

       <script language="javascript">
	   $(document).ready(function(){
	   		//alert("")
	   		//window.dispatchEvent(new Event('resize'));
			$(".x_panel").css("min-height",$(window).height());
			
			$('#divgrp').hide();
			$('#divtext').hide();
			$('#divctype').hide();
			
			/*$("#frmdid").validate({
			  rules: {
				exttext: {
				  //required: true,
				  number: true
				}
			  }
			});*/
			
			
			 
			
	   });
    	
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
                    Permissions Name   
                    <small>
                       
                    </small>
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

            <div class="col-md-12">
              <div class="x_panel">
                
                <div class="x_content">
				<?php if($message){
					echo $message;
				} else { ?>
						<?php 
							if(!empty($results[0]->permission)){
						?>	
                  <form novalidate="" name="frmdid" id="frmdid" class="form-horizontal form-label-left" action="<?php echo base_url("/admin/permissionname/updatePermission"); ?>" method="post">
					<input type="hidden" value="<?php echo $results[0]->permission; ?>" name="id" />
                   
                    <span class="section">Edit Permissions Name   </span>

                   <div class="item form-group">
                      <label for="txtdid" class="control-label col-md-3 col-sm-3 col-xs-12">Permissions Name    <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" value="<?php echo $results[0]->value; ?>" placeholder="Please enter Group Name" 
						name="txtdid" class="form-control col-md-7 col-xs-12" id="txtdid">
                      </div>
                    </div>
					 <div class="item form-group">
					  <label for="txtdid" class="control-label col-md-3 col-sm-3 col-xs-12">Module
					  <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
					
										<select class="form-control" id="selectdis"  name="module">
											<option value="" >Select Permission</option>
											<?php for($i=0;$i<count($module);$i++){ ?>
											<option value="<?php echo $module[$i]->module_id; ?>" <?php echo ($results[0]->module_id==$module[$i]->module_id )? "selected":""; ?> ><?php echo $module[$i]->modulename; ?></option>												
											<?php } ?>
											</select>
					</div>
					</div>	
					
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                         <button class="btn btn-primary" onclick="javascript:history.back();" >Cancel</button>
                        <button class="btn btn-success" type="submit" id="send">Submit</button>
                      </div>
                    </div>
                  </form>
					<?php
							}	}				
					?>
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
