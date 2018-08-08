<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>TASKS</title>

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
			$("#notifyemail").select2();
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
                    TASKS
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
				<?php /* if($message){
					echo $message;
				} else {  */?>
						<?php
							if(!empty($results[0]->task_id)){ 
						?> 
                  <form novalidate="" name="frmdid" id="frmdid" class="form-horizontal form-label-left" action="<?php echo base_url("/admin/tasks/updatetasks"); ?>" method="post">
					<input type="hidden" value="<?php echo $results[0]->task_id; ?>" name="id" >
					<input type="hidden" value="<?php echo $results[0]->hoursspent; ?>" name="hr_spnd" >
						
                    <span class="section">#<?php echo $results[0]->task_id; ?> : <?php echo $results[0]->title; ?></span>
					Last Updated by <b><?php echo  $task_results[0]->created_by; ?></b> on <?php echo $task_results[0]->created_date;  ?>
					
					 <div class="ln_solid"></div>
					  
					  
					<div class="item form-group" style="padding-bottom: 41px;">
						<div class="col-xs-12" >
						<label for="txtdid" class="control-label col-md-2 col-sm-2 col-xs-12" style="max-width: 8%;">Type</label><label style="text-align: left;font-weight:normal;" class="control-label col-md-2 col-sm-2 col-xs-12"><?php echo $results[0]->name; ?></label>
						<label for="txtdid" class="control-label col-md-2 col-sm-2 col-xs-12">Est. Hour(s)</label><label style="text-align: left;font-weight:normal;" class="control-label col-md-2 col-sm-2 col-xs-12"><?php echo $results[0]->estimated_hours; ?></label>
						<label for="txtdid" class="control-label col-md-2 col-sm-2 col-xs-12">Project</label><label style="text-align: left;font-weight:normal;" class="control-label col-md-2 col-sm-2 col-xs-12"><?php echo $results[0]->projectname; ?></label>
						</div>
					
					
					<div class="col-xs-12" >
						<label for="txtdid" class="control-label col-md-2 col-sm-2 col-xs-12" style="max-width: 8%;">Priority</label><label for="txtdid" style="text-align: left;font-weight:normal;" class="control-label col-md-2 col-sm-2 col-xs-12"><?php echo $results[0]->priority; ?></label>
						<label for="txtdid" class="control-label col-md-2 col-sm-2 col-xs-12">Hour(s) Spent</label><label style="text-align: left;font-weight:normal;" for="txtdid" class="control-label col-md-2 col-sm-2 col-xs-12"><?php echo $results[0]->hoursspent; ?></label>
						<label for="txtdid" class="control-label col-md-2 col-sm-2 col-xs-12">Status</label><label for="txtdid" style="text-align: left;font-weight:normal;" class="control-label col-md-2 col-sm-2 col-xs-12"><?php echo $results[0]->status; ?></label>
					
					</div>
					</div>

					 
					<div class="item form-group">
                      <!--label for="txtdid" class="control-label col-md-2 col-sm-2 col-xs-12">New Description</label-->
                      <div class="col-md-12 col-sm-12 col-xs-12">
                         <textarea  placeholder="Description" name="description" class="form-control col-md-7 col-xs-12" id="txtdid"></textarea>
                      
                      </div>
                    </div>
					<div class="item form-group">
                      <!--label class="control-label col-md-2 col-sm-2 col-xs-12">Assign to</label-->
                      <div class="col-md-2 col-sm-2 col-xs-12">
                        <select name="assignto" class="form-control col-md-12 col-xs-12">
						<option value=""></option>
						<?php for($i=0;$i<count($users);$i++){?>
						<option value="<?php echo $users[$i]->id; ?>" <?php echo ($results[0]->assignto==$users[$i]->id )? "selected":""; ?>><?php echo $users[$i]->uname; ?></option>
						<?php } ?>
						</select>
                      </div>
					  <!--label class="control-label col-md-1 col-sm-1 col-xs-12">Status </label-->
					  <div class="col-md-2 col-sm-2 col-xs-12">
						<select class="form-control"  name="status">
							<option value="In Progress">In Progress</option>
							<option value="Resolve">Resolve</option>
							<option value="Close">Close</option>
						</select>
					  </div>
					  
					  <!--label  class="control-label col-md-2 col-sm-2 col-xs-12">Hour(s) Spent<span class="required">*</span></label-->
                      <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" required placeholder="Hours Spent(s)" name="hours_spent"   class="form-control col-md-7 col-xs-12" >
                      </div>
					  
					  
					          <!--label for="name" class="control-label col-md-2 col-sm-2 col-xs-12">Notify via Email </label-->
								<div class="col-md-3 col-sm-3 col-xs-12">
		
										<select class="form-control" id="notifyemail" name="notifyemail[]" placeholder="Email" multiple>
											<option value="0" >All </option>
											<?php for($i=0;$i<count($users);$i++){ ?>
											<option value="<?php echo  $users[$i]->id; ?>"><?php echo  $users[$i]->uname;?></option>												
											<?php } ?>
											</select>
                      </div>
					  <!--div class="form-group"-->
                      <div class="col-md-2 col-sm-2 col-xs-12" style="text-align:right;">
                     								<!--input type="button" class="btn btn-primary" value="Cancel" onCLick="history.back()"-->

                        <button class="btn btn-success" style="text-align:right;" type="submit" id="send">Submit</button>
                      </div>
                    <!--/div-->
					  
                    </div>
					

					
					
                    <div class="ln_solid"></div> 
                    
					
					<?php  for($i=0;$i<count($task_results);$i++){ ?>
					<div class="item form-group" style="margin-bottom: 41px; border: solid 1px #DDDDDD;">
					<div class="item form-group"  style="margin-top: 12px;margin-bottom: 0px;">
						<div  class="col-md-1 col-sm-1 col-xs-12"><img src="http://192.168.0.158/crm/admin-assets/images/img.jpg" height="50" width="50" class="img-circle profile_img"></div>
						<div  class="col-md-2 col-sm-2 col-xs-12" ><?php echo $task_results[$i]->created_by;  ?> </br><?php echo $results[0]->created_date; ?></div>
						<div  class="col-md-3 col-sm-3 col-xs-12" style="text-align: right;">Status: <?php echo $task_results[$i]->status;  ?></div>
						<div  class="col-md-3 col-sm-3 col-xs-12" style="text-align: right;">Assigned To: <?php echo $task_results[$i]->uname;  ?></div>
						 </div>
						 <div class="ln_solid"></div>
						<div class="col-md-12 col-sm-12 col-xs-12"><?php echo $task_results[$i]->descriptions;  ?></div>
						
					
					</div>
					<?php } ?>
                  </form>
				  
				  
				 
					<?php
				}	//}
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
  //  validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      //.on('blur', 'input[required], input.optional, select.required', validator.checkField)
      //.on('blur', 'input[required], input.optional', validator.checkField)
     // .on('change', 'select.required', validator.checkField)
      //.on('keypress', 'input[required][pattern]', validator.keypress);

   /*  $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });
 */
    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

  /*   $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    }); */

    /* FOR DEMO ONLY */
  /*   $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);
 */
    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);
  </script>
  
  

</body>

</html>
