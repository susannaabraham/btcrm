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
			$(".x_panel").css("min-height",$(window).height()-200);
	   });
    	function deleteproject(id)
			{
				//alert(did);
				if(confirm("Are you sure you want to delete?")) 
				{
					$.ajax(
					{				
						type: "POST",
						url: '<?php echo base_url("/admin/projects/deleteproject")?>',
						data: {'id':id},
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
			
			
			
			
				function btn_click1(cid) {
	$('#myModal1').modal('show');
	$(".usform").empty();
	
 $.ajax({
      type: "POST",
      url: "<?php echo base_url("/admin/projects/addusers"); ?>", 
      data:{keyword:cid},
      success: function(response) {
		var k=response;
		
$(k).appendTo('.usform');
 
	 }
						});
						}

function addcontact(){
		//var n=0;
		 var user = [];
            $.each($("input[name='users']"), function(){ 
                user.push($(this).val());

            });
			
			alert(user);
			var permission = [];
        $.each($("select[name='permission']"), function(){            
            permission.push($(this).val());
        });
			alert(permission);
		var id=$(".id").val();

		
	   $.ajax({
      type: "POST",
      url: "<?php echo base_url("/admin/projects/saveusers"); ?>", 
      data:{user:user,permission:permission,id:id},
      success: function(response) {
		  //alert(response);
		$('#myModal1').modal('toggle');  
			}
		});
				
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
                    PROJECTS
                   
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
			 <form id="ShowForm" name="RptForm" class="form-horizontal"  role="form" action="<?php echo base_url("/admin/projects"); ?>?<?php echo http_build_query($_GET, '', "&");?>">							
						<fieldset>
							<div class="row">
							<div class="col-lg-4">
									<div class="form-group">
										
											<?php
												$name=($this->input->get("name",true));
											?>
											<input class="form-inline form-control" id="name" name="name" placeholder="Project Name" type="text" value="<?php echo $name; ?>">
										
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										
											<?php
												$ext=($this->input->get("ext",true));
											?>
											<select name="type" class="form-inline form-control" >
							<option value="">-Select Project Type-</option>
							<option value="1">PBX</option>
							<option value="2">CALL CENTER</option>
							<option value="3">PBX & CALL CENTER</option>
							<option value="4">Others</option>
</select>							
									</div>
								</div>
								
								
								<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>ADD USERS</b></h4>
        </div>
		
		
   <div class="modal-body" >
	  
	  <div class="form-group">
		   <label for="name" class="control-label col-md-2 col-sm-2 col-xs-12 label1">Users </label>
		  <div class="usform col-md-10 col-sm-10 col-xs-12 ">
		 </div>
		  
		  
		</div>
		</br>

		
        </div>
		
		
			
			
		
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		  							<button type="button" class="btn btn-primary pull-right" onclick='addcontact()' style="font-size:12px" >ADD USER</button>
        </div>
      </div>
      
    </div>
  </div>
  			 


								
								<div class="col-lg-2">
										<input id="btnSearch" class="btn btn-primary searchlist" name="search" type="submit" value="Search"/>
										
	   
										
										
								</div>	
															  <div style="text-align:right"><a href="<?php echo base_url(); ?>admin/projects/addprojects" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Project</a></div>
								
							</div>
						</fieldset>
					</form>
            <div class="row">
				<div class="col-md-12">
					<div class="x_panel">
						<div class="x_title">
						 
						  <div class="clearfix"></div>
						</div>
						<?php if($message){
					echo $message;
				} else { ?>
						<div class="x_content">
						  <table class="table table-striped responsive-utilities jambo_table bulk_action">
							<thead>
							  <tr role="row">
							  <th>Project Name</th>
							  <th>Type</th>
							  <th>Start Date</th>
							  <th>Contact Person</th>
							  <th>Phone Number</th>
							  <th>Status</th>
							  <th>Action</th>
							  </tr>
							</thead>


							<tbody>
							  <?php
							  $type=array('','PBX','CALL CENTER','PBX & CALL CENTER','Others');
							  $status=array('','Enquiry','POC','Implementation','AMC','NON AMC');
								if(isset($results[0]->id))
						        {
								for($i=0;$i<count($results);$i++){ ?>
							<TR id="dat_<?php echo $results[$i]->id; ?>" role="row" class="odd">
								<TD><?php echo $results[$i]->name; ?></TD>
								<TD><?php echo $type[$results[$i]->type]; ?></TD>
								<TD><?php echo $results[$i]->startdate; ?></TD>
								<TD><?php echo $results[$i]->contact_person; ?></TD>
								<TD><?php echo $results[$i]->phone; ?></TD>
								<TD><?php echo $status[$results[$i]->status]; ?></TD>
								
								<TD>
								<a class="btn btn-default " data-toggle="tooltip" title="Add Users"  onclick="javascript:parent.btn_click1(<?php echo $results[$i]->id; ?>);"  ><i class="fa fa-user-plus"></i></a>
							<!--<a class="btn btn-default " data-toggle="tooltip" title="Add Users" href="<?php echo base_url('admin/projects/addusers')."?keyword=".$results[$i]->id; ?>"><i class="fa fa-user-plus"></i></a>-->
								<a class="btn btn-default " data-toggle="tooltip" title="Edit Project" href="<?php echo base_url('admin/projects/edit')."?keyword=".$results[$i]->id; ?>"><i class="fa fa-edit"></i></a>
								<a class="btn btn-default " data-toggle="tooltip" title="Delete Project" href="javascript:void(0);" onClick="deleteproject('<?php echo $results[$i]->id; ?>')"><i class="fa fa-remove"></i></a></TD>
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
