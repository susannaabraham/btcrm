<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Tasks</title>

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
 <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/moment/moment.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/datepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/select/select2.full.js"></script>

      
       <script language="javascript">
	   $(document).ready(function(){
	   		$(".x_panel").css("min-height",$(window).height()-200);
			$(".sel").select2();
			
		});
		
	   $(function() {
		  $('input[name="duedate"]').daterangepicker({
			  autoUpdateInput: false,
			singleDatePicker: true,
			  locale: {
				  cancelLabel: 'Clear',
				   format: 'YYYY/MM/DD',
				   "firstDay": 1
			  }
		  });
		  $('input[name="duedate"]').on('apply.daterangepicker', function(ev, picker) {
			  $(this).val(picker.startDate.format('YYYY/MM/DD'));
		  });
		  $('input[name="duedate"]').on('cancel.daterangepicker', function(ev, picker) {
			  $(this).val('');
		  });
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
                    CREATE TASKS

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
                <div class="x_title">
                  <h2>Create Tasks</h2>


                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<?php if($message){
					echo $message;
				} else { ?>
                  <form  class="form-horizontal form-label-left" method="post" action="<?php echo base_url("/admin/tasks/savetask");?>"  id="AddForm" name="AddForm">



				  <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Project<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
					 <select class="form-control sel" id="project" name="project" placeholder="Select Project">
											<?php for($i=0;$i<count($projects);$i++){?>
											<option value="<?php echo $projects[$i]->id?>"><?php echo $projects[$i]->name?></option>
											<?php } ?>
											</select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Task title <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Task title" name="title"   class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>
					
					<div class="item form-group">
                      <label for="txtdid" class="control-label col-md-3 col-sm-3 col-xs-12">Description
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea  placeholder="Please enter Group Name" name="description" class="form-control col-md-7 col-xs-12" id="txtdid"> </textarea>
                      </div>
                    </div>
					
					 <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Assign to<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="assignto" class="form-control col-md-7 col-xs-12" id="selectdis" required>
						<option value="">Select User</option>
						<?php for($i=0;$i<count($users);$i++){?>
						<option value="<?php echo $users[$i]->id; ?>"><?php echo $users[$i]->uname; ?></option>
						<?php } ?>
						</select>
                      </div>
                    </div>
					
					
						
					 <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Due date <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Due date " name="duedate" autocomplete="off"   class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>
					
					
					
					 <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Priority <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="radio" name="priority" value="LOW"  > Low
                        <input type="radio" name="priority" value="Medium" checked="checked"> Medium
                        <input type="radio" name="priority" value="High"> High
                      </div>
                    </div>
										
					<div class="item form-group">
					  <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Task Type <span class="required">*</span>
					  </label>

					   <div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control required" required id="type" name="tasktype">
							<option value="">-Select Task Type-</option>
							<?php for($i=0;$i<count($tasktype);$i++){?>
						<option value="<?php echo $tasktype[$i]->id; ?>"><?php echo $tasktype[$i]->name; ?></option>
						<?php } ?>
						</select>
					  </div>
					</div>
					<div class="item form-group">
					  <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Status 
					  </label>

					   <div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control required" id="status" name="status">
							
							<?php for($i=0;$i<count($status);$i++){?>
						<option value="<?php echo $status[$i]->name; ?>"><?php echo $status[$i]->name; ?></option>
						<?php } ?>
						</select>
					  </div>
					</div>
					
				  <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Estimated Hour(s)<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Estimated Hour(s)" name="estimated_hours"   class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>	
					
					
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Hour(s) Spent
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text"  placeholder="Hours Spent(s)" name="hours_spent"   class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>	
					
					
						
					 <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Notify via Email 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
		
							<select class="form-control sel" id="notifyemail" name="notifyemail[]" placeholder="Email" multiple>
											<!--option value="0" >All </option-->
											<?php for($i=0;$i<count($users);$i++){ ?>
											<option value="<?php echo  $users[$i]->id; ?>"><?php echo  $users[$i]->uname;?></option>												
											<?php } ?>
											</select>
                      </div>
                    </div>
					
						
					


                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                       <button class="btn btn-primary" onclick="javascript:history.back();" >Cancel</button>
                        <button type="submit" class="btn btn-success" id="send" >Save</button>
								 <!--input type="submit" class="btn btn-success" type="submit" id="send" -->

                      </div>
                    </div>
                  </form>
				   <?php } ?>
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
/*     validator.message['date'] = 'not a real date';

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
   /* $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false); */
  </script>

</body>

</html>
