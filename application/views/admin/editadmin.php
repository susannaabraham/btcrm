<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Edit User</title>

  <!-- Bootstrap core CSS -->

  <link href="<?php echo base_url("/admin-assets"); ?>/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url("/admin-assets"); ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url("/admin-assets"); ?>/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/icheck/flat/green.css" rel="stylesheet">
   <link href="<?php echo base_url("/admin-assets"); ?>/css/select/select2.min.css" rel="stylesheet">


  <script src="<?php echo base_url("/admin-assets"); ?>/js/jquery.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/validator/validator.js"></script>
   <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/select/select2.full.js"></script>

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
			$(".x_panel").css("min-height",$(window).height()-200);
			 $("select").select2();
	   });
 $(document).ready(function(){ 
    $("#call_group").change(function(){
		
		var gid = $(this).val();
           if(gid[0]==0){ $("#call_group").val("0").change();
			}	
		
    });
	}); 
	
	function goBack() {
    window.history.back();
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
                    User
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
							if(!empty($results[0]->id)){
						?>
                  <form novalidate="" name="frmdid" id="frmdid" class="form-horizontal form-label-left" action="<?php echo base_url("/admin/admin/updateAdmin"); ?>" method="post">
					<input type="hidden" value="<?php echo $results[0]->id; ?>" name="id" />

                    <span class="section">Edit User</span>


					 <div class="item form-group">
                      <label for="txtdid" class="control-label col-md-3 col-sm-3 col-xs-12">UserName <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Please enter Group Name"  value="<?php echo $results[0]->uname; ?>"
						name="username" class="form-control col-md-7 col-xs-12" id="txtdid">
                      </div>
                    </div>
					<div class="item form-group">
                      <label for="txtdid" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="type" required="required" placeholder="Please enter Group Name"  value="<?php echo $results[0]->pass; ?>"
						name="password" class="form-control col-md-7 col-xs-12" id="txtdid">
                      </div>
                    </div>
					<div class="item form-group">
                      <label for="txtusername" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Enter Email ID" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $results[0]->email; ?>" id="email">
                      </div>
                    </div>
					 <div class="item form-group">
					  <label for="txtdid" class="control-label col-md-3 col-sm-3 col-xs-12">Permissions
					  <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">

										<select class="form-control" id="selectdis"  name="mode">
											<option value="" >Select Permission</option>
											<?php for($i=0;$i<count($ctype);$i++){ ?>
											<option value="<?php echo $ctype[$i]->groupid; ?>" <?php echo ($results[0]->mode==$ctype[$i]->groupid )? "selected":""; ?> ><?php echo $ctype[$i]->groupname; ?></option>
											<?php } ?>
											</select>
					</div>
					</div>
					<div class="item form-group">
					  <label for="txtdid" class="control-label col-md-3 col-sm-3 col-xs-12">Call Group
					  <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">

										<select class="form-control" id="call_group" required name="gid[]" multiple>
											<!--option value="" >None</option-->
											<option value="0" <?php echo ("0"==$results[0]->groups )? "selected":""; ?>>All Groups</option>
											<?php for($i=0;$i<count($ctype1);$i++){ 
											$gid=$results[0]->groups;
											$gid=explode(",", $gid);
											 ?>
											<option value="<?php echo $ctype1[$i]->gid; ?>" <?php for($j=0;$j<count($gid);$j++){ echo ($gid[$j]==$ctype1[$i]->gid )? "selected":""; } ?>><?php echo $ctype1[$i]->name; ?></option>
											<!--option value="<?php echo $ctype1[$i]->gid; ?>" <?php //echo ($results[0]->groups==$ctype1[$i]->gid )? "selected":""; ?>><?php echo $ctype1[$i]->name; ?></option-->
											<?php } ?>
											</select>
					</div>
					</div>
					<div class="item form-group">
					  <label for="txtdid" class="control-label col-md-3 col-sm-3 col-xs-12">Home Screen</label>
						<div class="col-md-6 col-sm-6 col-xs-12">

					<select class="form-control" id="dashboard" name="dashboard">
											<option value="" >Dashboard </option>												
											<option value="/admin/admin/addadmin" <?php echo ($results[0]->dashboard=='/admin/admin/addadmin')? "selected":""; ?>>Manage Users </option>
											<option value="/admin/permission/addpermission" <?php echo ($results[0]->dashboard=='/admin/permission/addpermission')? "selected":""; ?>>Manage Permission Group </option>
											<option value="/admin/cdr/detailed_inbound" <?php echo ($results[0]->dashboard=='/admin/cdr/detailed_inbound')? "selected":""; ?>>Inbound Call Report </option>
											<option value="/admin/cdr/outbound" <?php echo ($results[0]->dashboard=='/admin/cdr/outbound')? "selected":""; ?>>Outbound Call Report </option>
											<option value="/admin/agents/report" <?php echo ($results[0]->dashboard=='/admin/agents/report')? "selected":""; ?>>AGENT PERFORMANCE REPORT</option>
											<option value="/admin/cdr/msdcall" <?php echo ($results[0]->dashboard=='/admin/cdr/msdcall')? "selected":""; ?>>Missed Calls</option>
											<option value="/admin/call_volume" <?php echo ($results[0]->dashboard=='/admin/call_volume')? "selected":""; ?>>Call volume statistics</option>
											<option value="/admin/call_report/inbound" <?php echo ($results[0]->dashboard=='/admin/call_report/inbound')? "selected":""; ?>>Call Reports</option>
											<option value="/admin/campain/addcampain" <?php echo ($results[0]->dashboard=='/admin/campain/addcampain')? "selected":""; ?>>Campaign</option>
											<option value="/admin/campainReport/report" <?php echo ($results[0]->dashboard=='/admin/campainReport/report')? "selected":""; ?>>Campaign Report</option>
											<option value="/admin/conference" <?php echo ($results[0]->dashboard=='/admin/conference')? "selected":""; ?>>Conference</option>
											<option value="/admin/voicealert/group" <?php echo ($results[0]->dashboard=='/admin/voicealert/group')? "selected":""; ?>>EMERGENCY ALERT </option>
											<option value="/admin/voicealert/listalerts" <?php echo ($results[0]->dashboard=='/admin/voicealert/listalerts')? "selected":""; ?>>EMERGENCY ALERT LIST </option>
											<option value="/admin/data/data_cdr" <?php echo ($results[0]->dashboard=='/admin/data/data_cdr')? "selected":""; ?>> MEDICAL TRANSCRIPTION</option>
											<option value="/admin/mailbox/data_cdr?selectdis=6" <?php echo ($results[0]->dashboard=='/admin/mailbox/data_cdr?selectdis=6')? "selected":""; ?>>Customer-Feedback</option>
											<option value="/admin/mailbox/data_cdr?selectdis=5" <?php echo ($results[0]->dashboard=='/admin/mailbox/data_cdr?selectdis=5')? "selected":""; ?>>Employee-Feedback</option>
												
										</select>	
					  </div>
                    </div>
					
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                     								<input type="button" class="btn btn-primary" value="Cancel" onCLick="history.back()">

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
