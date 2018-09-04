<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Expense</title>

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
			$("#project").select2();
			
		});
	
		</script>

<script type="text/javascript">
	 	  $(function() {
		  $('input[name="create_date"]').daterangepicker({
			  autoUpdateInput: false,
			singleDatePicker: true,
			  locale: {
				  cancelLabel: 'Clear',
				   format: 'YYYY/MM/DD',
				   "firstDay": 1
			  }
		  });
		  $('input[name="create_date"]').on('apply.daterangepicker', function(ev, picker) {
			  $(this).val(picker.startDate.format('YYYY/MM/DD'));
		  });
		  $('input[name="create_date"]').on('cancel.daterangepicker', function(ev, picker) {
			  $(this).val('');
		  });
		});

$(document).ready(function(){		
$("select#project").change(function(){

var project = $("select#project option:selected").attr('value');
 //alert(project);

 //if (project != 'Default' ) { }
 
	$.post( "<?php echo base_url("/admin/expense/drpdwn"); ?>", 
                  { "project_id":project}, 
                  function(data) { //alert(data);
                   $("#exp_type").html(data);
				 }
               ); 
 
 
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
                   Expense

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
                  <h2>Add Expense</h2>


                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
				<?php if($message){
					echo $message;
				} else { ?>
                  <form  class="form-horizontal form-label-left" method="post" action="<?php echo base_url("/admin/expense/saveexpense");?>"  id="AddForm" name="AddForm">

					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Project<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control sel" id="project" name="project" placeholder="Select Project" required>
								<option value="">select Project</option>
								<?php for($i=0;$i<count($projects);$i++){?>
									<option value="<?php echo $projects[$i]->id?>"><?php echo $projects[$i]->name?></option>
								<?php } ?>
							</select>
                      </div>
                    </div>
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Expense Type<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12" id="exp_type">
							<select class="form-control sel" id="sub"   name="expense_type">
								<?php for($i=0;$i<count($expense_type);$i++){?>
									<option value="<?php echo $expense_type[$i]->exp_id?>"><?php echo $expense_type[$i]->exp_name?></option>
								<?php } ?>
							</select>
                      </div>
                    </div>
					
					
					
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Expense SubType<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control sel" id="expense_sub_type" name="expense_sub_type" required>
								<?php for($i=0;$i<count($expense_sub_type);$i++){?>
									<option value="<?php echo $expense_sub_type[$i]->exp_subid?>"><?php echo $expense_sub_type[$i]->exp_subname?></option>
								<?php } ?>
							</select>
                      </div>
                    </div>
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Description </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
							<textarea name="discription" placeholder="Description" class="form-control col-md-7 col-xs-12"></textarea>
                      </div>
                    </div>

					 <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> cost</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text"  placeholder=" cost" name="cost" required  class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>
					<div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Date</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
					    <input type="text"  placeholder=" Date" name="create_date" id="single_cal1"  class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>
					 <div class="item form-group">
                      <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">User<span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control sel" id="project" name="users" required>
								<?php for($i=0;$i<count($users);$i++){?>
									<option value="<?php echo $users[$i]->uname?>"><?php echo $users[$i]->uname?></option>
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
