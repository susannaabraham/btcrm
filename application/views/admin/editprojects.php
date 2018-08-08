<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Projects</title>

  <!-- Bootstrap core CSS -->

  <link href="<?php echo base_url("/admin-assets"); ?>/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url("/admin-assets"); ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url("/admin-assets"); ?>/css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url("/admin-assets"); ?>/css/icheck/flat/green.css" rel="stylesheet">


  <script src="<?php echo base_url("/admin-assets"); ?>/js/jquery.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/validator/validator.js"></script> 
   <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/moment/moment.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/datepicker/daterangepicker.js"></script>

  <script language="javascript">
	   $(document).ready(function(){
			$(".x_panel").css("min-height",$(window).height()-200);
	   });
    	
			
	   $(function() {
		  $('input[name="startdate"]').daterangepicker({
			  autoUpdateInput: false,
			singleDatePicker: true,
			  locale: {
				  cancelLabel: 'Clear',
				   format: 'YYYY/MM/DD',
				   "firstDay": 1
			  }
		  });
		  $('input[name="startdate"]').on('apply.daterangepicker', function(ev, picker) {
			  $(this).val(picker.startDate.format('YYYY/MM/DD'));
		  });
		  $('input[name="startdate"]').on('cancel.daterangepicker', function(ev, picker) {
			  $(this).val('');
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

      <div class="right_col" role="main">
        <div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                   Projects
                  
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
					  <h2>Edit Project</h2>
					 <div class="clearfix"></div>
					</div>
					<div class="x_content">
					<?php if($message){
						echo $message;
						} else { ?>
						<form  class="form-horizontal form-label-left" method="post" action="<?php echo base_url("/admin/projects/editproject");?>"  id="AddForm" name="AddForm">
							<input type="hidden" value="<?php echo $project[0]->id; ?>" name="id" />
							
							
							
                    <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Project Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Project Name" name="name"   class="form-control col-md-7 col-xs-12" value="<?php echo $project[0]->name; ?>" >
                      </div>
                    </div>
					
					<div class="item form-group">
					  <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Project Type <span class="required">*</span>
					  </label>

					   <div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control required" id="type" name="type">
							<option value="">-Select Project Type-</option>
							<option value="1" <?php if($project[0]->type=='1') { echo "selected"; } ?>>PBX</option>
							<option value="2" <?php if($project[0]->type=='2') { echo "selected"; } ?>>CALL CENTER</option>
							<option value="3" <?php if($project[0]->type=='3') { echo "selected"; } ?>>PBX & CALL CENTER</option>
							<option value="4" <?php if($project[0]->type=='4') { echo "selected"; } ?>>Others</option>
						</select>
					  </div>
					</div>
					
					
					 <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Project Start date <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Project Start Date" name="startdate" value="<?php echo $project[0]->startdate; ?>"  class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>
					
					
					
				  <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Contact Person" name="contact_person" value="<?php echo $project[0]->contact_person; ?>"  class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>	
					
					
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Contact Number" name="contact_number" value="<?php echo $project[0]->phone; ?>"  class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>	
					
					
						
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Address <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" placeholder="Email Address" name="email" value="<?php echo $project[0]->email; ?>"  class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>	
					
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Project Status <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control required" id="status" name="status" >
							<option value="">-Select Project Status-</option>
							<option value="1" <?php if($project[0]->status=='1') { echo "selected"; } ?> >Enquiry</option>
							<option value="2" <?php if($project[0]->status=='2') { echo "selected"; } ?>>POC</option>
							<option value="3" <?php if($project[0]->status=='3') { echo "selected"; } ?>>Implementation</option>
							<option value="4" <?php if($project[0]->status=='4') { echo "selected"; } ?>>AMC</option>
							<option value="5" <?php if($project[0]->status=='5') { echo "selected"; } ?>>NON AMC</option>
						</select>
						</div>
                    </div>	
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Project Description<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea  name="description"   class="form-control col-md-7 col-xs-12" ><?php echo $project[0]->description; ?></textarea>
                      </div>
                    </div>	
                    
							
						    <div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
								<input type="button" class="btn btn-primary" value="Cancel" onCLick="history.back()">
								<button type="submit" class="btn btn-success" id="send" >Save</button>
								</div>
							</div>
					   </form>
						<?php } ?>
					</div>
				</div>
            </div>
          </div>
        </div>
      </div> </div></div>
      <footer>
        <div class="pull-right">
					Bitvoice Solutions PVT LTD
        </div>
        <div class="clearfix"></div>
      </footer>
   
  

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
