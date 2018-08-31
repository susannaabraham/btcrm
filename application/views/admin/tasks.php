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


  <script src="<?php echo base_url("/admin-assets"); ?>/js/jquery.min.js"></script>
  <script src="<?php echo base_url("/admin-assets"); ?>/js/validator/validator.js"></script> 
   <link href="<?php echo base_url("/admin-assets"); ?>/css/select/select2.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/select/select2.full.js"></script>

   <!-- daterangepicker -->
 <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/moment/moment.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url("/admin-assets"); ?>/js/datepicker/daterangepicker.js"></script>
 
 
       <script language="javascript">
	   $(document).ready(function(){
	   		//alert("")
	   		//window.dispatchEvent(new Event('resize'));
			$(".x_panel").css("min-height",$(window).height()-200);
			$(".sel").select2();
	   });
		
    	function deletetask(id)
			{
				//alert(id);
				if(confirm("Are you sure you want to delete?")) 
				{
					$.ajax(
					{				
						type: "POST",
						url: '<?php echo base_url("/admin/tasks/deltask")?>',
						data: {'task_id':id},
						dataType: 'json',
						success: function(d)
						{	
							if(d.success==true){
							alert("Deleted");
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
 <script type="text/javascript">
		$(function() {

		  $('input[name="single_cal1"]').daterangepicker({
			  autoUpdateInput: false,
			  timePicker: true,
			  timePicker24Hour:true,
			  timePickerSeconds:true,
			  locale: {
				  cancelLabel: 'Clear'
			  }
			  ,
			  ranges: {
           'Today': [moment().startOf('day'), moment()],
           'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		   'This Week': [moment().startOf('isoweek').isoWeekday(1), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
			  
		  });

		  $('input[name="single_cal1"]').on('apply.daterangepicker', function(ev, picker) {
			  $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
		  });

		  $('input[name="single_cal1"]').on('cancel.daterangepicker', function(ev, picker) {
			  $(this).val('');
		  });

		});
		
		function playAu($c,$r,$d){
			$("#"+$c).html('<audio controls autoplay style="width:150px;" id=""><source src="/wave.php?r='+$r+'&d='+$d+'" type="audio/wav"></audio>');
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
          </div> <div class="clearfix"></div>
		
			
					 			
            <div class="row">
				<div class="col-md-12">
					<div class="x_panel">
						<div class="x_title">
						 
						  <div class="clearfix"></div>
						  <form id="ShowForm" name="RptForm" class="form-horizontal"  role="form" action="<?php echo base_url("/admin/tasks"); ?>?<?php echo http_build_query($_GET, '', "&");?>">							
			<fieldset>
							<div class="row">
		
								<div class="col-lg-2">
									<div class="form-group">
										<?php  $project=($this->input->get("project",true));	?>
										<select name="project" class="form-control sel" id="project" >
											<option value="">-Select Project-</option>
											<?php for($i=0;$i<count($projects);$i++){?>
											<option value="<?php echo $projects[$i]->id?>" <?php echo ($projects[$i]->id==$project)? "selected":""; ?>><?php echo $projects[$i]->name?></option>
											<?php } ?>
										</select>							
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<?php $user=($this->input->get("user",true));	?>
										<select name="user" class="form-inline form-control sel" >
											<option value="">-Assign To-</option>
											<?php for($i=0;$i<count($users);$i++){?>
											<option value="<?php echo $users[$i]->id; ?>" <?php echo ($users[$i]->id==$user)? "selected":""; ?>><?php echo $users[$i]->uname; ?></option>
											<?php } ?>
										</select>							
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
									<?php
											$se="";
											if(!isset($_GET["status"])){
												$se="aa";
											}else{
												$se=$_GET["status"];
											}
										?>
										<select name="status" class="form-inline form-control sel" >
											<option value="">-Status-</option>
											<option value="New" <?php echo ($se=='New')? "selected":""; ?>>New</option>
											<option value="In Progress" <?php echo ($se=='In Progress')? "selected":""; ?>>In Progress</option>
											<option value="Reassigned" <?php echo ($se=='Reassigned')? "selected":""; ?>>Reassigned</option>
											<option value="Resolved" <?php echo ($se=='Resolved')? "selected":""; ?>>Resolved</option>
											<option value="Closed" <?php echo ($se=='Closed')? "selected":""; ?>>Closed</option>
										</select>							
									</div>
								</div>
								<!--div class="col-lg-2">
									<div class="form-group">											
										<?php
											$caldate=($this->input->get("single_cal1",true));
													
										?>
											 <input type="text" aria-describedby="inputSuccess2Status" placeholder="Due Date" id="single_cal1" name="single_cal1" value="<?php echo $caldate; ?>" class="form-control has-feedback-left">
											<span aria-hidden="true" class="fa fa-calendar-o form-control-feedback left"></span>
									</div> 
								</div-->
								
								<div class="col-lg-2">
									<input id="btnSearch" class="btn btn-primary searchlist" name="search" type="submit" value="Search"/>
								</div>	
								
								<div style="text-align:right"><a href="<?php echo base_url(); ?>admin/tasks/addtasks" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Tasks</a></div>
												
							</div>
					
								</fieldset>
					</form>
						</div>
						<?php if($message){
					echo $message;
				} else { ?>
						<div class="x_content">
						  <table class="table table-striped responsive-utilities jambo_table bulk_action">
							<thead>
							  <tr role="row">
							  <th>Project</th>
							  <th>Task</th>
							  <th>Assign To</th>
							  <th>Priority</th>
							  <th>Due Date</th>
							  <th>Status</th>
							  <th>Action</th>
							  </tr>
							</thead>


							<tbody>
							  <?php
							  // $type=array('','PBX','CALL CENTER','PBX & CALL CENTER','Others');
							  // $status=array('','Enquiry','POC','Implementation','AMC','NON AMC');
								if(isset($results[0]->task_id))
						        {
								for($i=0;$i<count($results);$i++){ 
								$stle="";
								$date1=date('Y-m-d');
								$date2=$results[$i]->duedate;
								$status=$results[$i]->status;
								if(strtotime($date1) > strtotime($date2) && ($status!="Closed"))
								{  $stle="style='background-color: #ff0e061a;'"; } ?>
								
							<TR <?php  echo $stle; ?> role="row" class="odd" >
								<?php 
									$project_id=$results[$i]->project;
									$assigned_to=$results[$i]->assignto;
									$sql ="SELECT * FROM projects where id='$project_id'";
									$query=$this->db->query($sql); 
									$project=$query->result(); 
									$sql1 ="SELECT * FROM admin_login where id='$assigned_to'";
									$query1=$this->db->query($sql1); 
									$assignto=$query1->result(); ?>
								<TD><?php echo $project[0]->name; ?></TD>
								<TD><?php echo $results[$i]->title; ?></TD>
								<TD><?php echo $assignto[0]->uname; ?></TD>
								<TD><?php echo $results[$i]->priority; ?></TD>
								<TD><?php echo $results[$i]->duedate; ?></TD>
								<TD><?php echo $results[$i]->status; ?></TD>
								<!--TD><?php //echo $status[$results[$i]->status]; ?></TD-->
								
								<TD>
								<a class="btn btn-default " href="<?php echo base_url('admin/tasks/edit')."?keyword=".$results[$i]->task_id; ?>"><i class="fa fa-edit"></i></a>
								<a class="btn btn-default " href="javascript:void(0);" onClick="deletetask('<?php echo $results[$i]->task_id; ?>')"><i class="fa fa-remove"></i></a></TD>
							</TR>
							 <?php
								}
								}else
								{
							   ?>
							
							<TR id="dat_" role="row" class="odd">
							<TD colspan="8">No results found</TD>
							</TR>
							
							 <?php	
								}
							
							?> 
						
							</tbody>
						    </table>
						    <div class="new-pagination">
								<?php echo $links; ?>
							</div>
						</div>
						<?php } ?>	
						
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

</body>

</html>
