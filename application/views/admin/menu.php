  <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;background: #FFFFFF none repeat">
            <a href="<?php echo base_url("/admin-assets"); ?>" class="site_title"><img src="<?php echo base_url("/admin-assets"); ?>/images/logo.png" alt="..."></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="<?php echo base_url("/admin-assets"); ?>/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
			  <h2><?php echo $this->session->userdata('login_id') ?></h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>Menu</h3>
              <ul class="nav side-menu">
			  
			  <?php  
			 $this->load->database();
			 $sql ="SELECT * from `module_admin` where enabled='1' and modulename='CRM'";
					$query=$this->db->query($sql); 
					if ($query->num_rows() > 0) 
					{ ?>
				<?php if((false===$this->user_model->haspermission2(1)) && 
				(false===$this->user_model->haspermission2(3)) && 
				(false===$this->user_model->haspermission2(5)) ) { }  else { ?>

                 <li><a><i class="fa fa-headphones"></i> CRM <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
					<?php $this->load->model('user_model');
					if(false===$this->user_model->haspermission2(5)){ } else { ?>
					<li>
					<?php $groups=$this->session->userdata('groups');
					
					/* if($groups=='0'){
					?>
					<a href="<?php echo base_url("/admin/dashboard");?>">DASHBOARD</a>

					<?php } else {?>
					<a href="<?php echo base_url('/admin/dashboardgroup')."?keyword=".$groups;?>">DASHBOARD</a>
					<?php } */ ?>
					</li>
					<?php } ?>
                    <?php if(false===$this->user_model->haspermission2(1)){  } else {  ?>
					<li><a href="<?php echo base_url("/admin/projects/"); ?>">PROJECTS</a></li>
					<?php } ?> 
					
					<?php if(false===$this->user_model->haspermission2(3)){  } else {  ?>
					<li><a href="<?php echo base_url("/admin/tasks/"); ?>">TASKS</a></li>
					<?php } ?>
					
					<?php if(false===$this->user_model->haspermission2(3)){  } else {  ?>
					<li><a href="<?php echo base_url("/admin/expense/"); ?>">EXPENSE</a></li>
					<?php } ?>
					 
					
                  </ul>
                 </li>
					<?php } ?>
					<?php } ?>	<?php $sql ="SELECT * from `module_admin` where enabled='1' and modulename='CRM MASTER'";
					$query=$this->db->query($sql); 
					if ($query->num_rows() > 0) 
					{ ?>
				<?php if((false===$this->user_model->haspermission2(6)) && 
				(false===$this->user_model->haspermission2(8))) { }  else { ?>

                 <li><a><i class="fa fa-headphones"></i> CRM MASTER <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
					<?php $this->load->model('user_model');
					if(false===$this->user_model->haspermission2(2)){  } else {  ?>
					<li><a href="<?php echo base_url("/admin/department/"); ?>">DEPARTMENT</a></li>
					<?php } ?> 
					
					<?php if(false===$this->user_model->haspermission2(2)){  } else {  ?>
					<li><a href="<?php echo base_url("/admin/status/"); ?>">STATUS</a></li>
					<?php } ?>  
					
					<?php if(false===$this->user_model->haspermission2(2)){  } else {  ?>
					<li><a href="<?php echo base_url("/admin/tasktype/"); ?>">TASK TYPE</a></li>
					<?php } ?>
				
					
                  </ul>
                </li>
					<?php } ?>
					<?php } ?>
				
			
				
				
				
				<?php  $sql ="SELECT * from `module_admin` where enabled='1' and modulename='USER MANAGMENT'";
					$query=$this->db->query($sql); 
					if ($query->num_rows() > 0) 
					{ 
						?>
				<?php if((false===$this->user_model->haspermission2(10)) &&
				(false===$this->user_model->haspermission2(13)) && 
				(false===$this->user_model->haspermission2(18))) {  } else { ?>
					
				 <li><a><i class="fa fa-user"></i> USERS <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
					 <?php if(false===$this->user_model->haspermission2(13)){  } else {  ?>
					 <li><a href="<?php echo base_url("/admin/admin/addadmin"); ?>">MANAGE USERS</a> </li>
					<?php } ?>
					 <?php if(false===$this->user_model->haspermission2(10)){  } else {  ?>
					<li><a href="<?php echo base_url("/admin/permissionname/addpermissionname"); ?>">PERMISSIONS</a> </li>
					  <?php } ?>
					 <?php if(false===$this->user_model->haspermission2(18)){  } else {  ?>
					 <li><a href="<?php echo base_url("/admin/permission/addpermission"); ?>">PERMISSION GROUP</a> </li>
					<?php } ?>
                  </ul>
                </li>
					<?php } ?>
					<?php } ?>
					
					
					
				
					
					
					
					
                  </ul>
                </li>
              </ul>
            </div>
            <div class="menu_section">


            </div>

          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url("/admin-assets"); ?>/images/img.jpg" alt=""><?php echo $this->session->userdata('login_id') ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                 <!--
                  <li>
                    <a href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">Help</a>
                  </li>-->
				  <li><a href="<?php echo base_url("/admin/login/profile");?>">  Profile</a>
                  </li>
                  <li><a href="<?php echo base_url("/admin"); ?>/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="display:none">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="<?php echo base_url("/admin-assets"); ?>/images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="<?php echo base_url("/admin-assets"); ?>/images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image">
                                        <img src="<?php echo base_url("/admin-assets"); ?>/images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
        </div>

      </div>
