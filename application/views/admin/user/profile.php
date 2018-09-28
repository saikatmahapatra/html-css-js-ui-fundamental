<?php
   $row = $row[0];
   //print_r($address);
?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->

<div class="row">
   <div class="col-12">
      <?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>             
   </div>
</div>
<div class="row">
   <div class="col-md-12">
   <div class="media">
   <?php   
	$img_src = "";
	$default_path = "assets/dist/img/avatar_2x.png";
	if(isset($profile_pic)){					
		$user_dp = "assets/uploads/user/profile_pic/".$profile_pic;					
		if (file_exists(FCPATH . $user_dp)) {
			$img_src = $user_dp;
		}else{
			$img_src = $default_path;
		}
	}else{
		$img_src = $default_path;
	}
	?>
	<div class="profile-pic">
		<img class="img align-self-start mr-3 dp" src="<?php echo base_url($img_src);?>">		
	</div>
  <div class="media-body">
    <h5 class="mt-0">
        <?php
            echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
            echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
            echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
        ?>
    </h5>
    <div class="small"><?php echo isset($row['role_name']) ? $row['role_name'] : ''; ?></div>
    <div class="">
        <i class="fa fa-envelope-o" aria-hidden="true"></i> 
        <a class="mr-2" href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a>
    </div>
    <div class="">
        <i class="fa fa-phone" aria-hidden="true"></i>
        <a class="mr-2" href="tel:<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?>"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></a>
        <a href="tel:<?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?>"><?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?></a>
        
    </div>            
    <div>
        <?php echo (isset($row['user_bio']) && strlen($row['user_bio'])>0) ? $row['user_bio'] : '<span class="text-muted">Describe who you are...</span>'; ?>        
    </div>
    <!--<hr style="m-8 auto">
    <span class="label label-default">some text</span>
    <span class="label label-default">some text</span>-->
  </div>
</div>
</div>
</div>


<br>

<nav>
  <div class="nav nav-tabs ci-nav-tab" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-basic-tab" data-toggle="tab" href="#nav-basic" role="tab" aria-controls="nav-basic" aria-selected="true">Basic Information</a>
	
    <a class="nav-item nav-link" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab" aria-controls="nav-address" aria-selected="false">Address Details</a>
	
    <a class="nav-item nav-link" id="nav-education-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-education" aria-selected="false">Qualification</a>
	
	<a class="nav-item nav-link" id="nav-exp-tab" data-toggle="tab" href="#nav-exp" role="tab" aria-controls="nav-exp" aria-selected="false">Work Experience</a>
	
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
	<div class="row mt-3">
		<div class="col-md-12">        
        <!--<h6>Basic Info</h6><hr>-->
        <div class="row">
            <div class="col-md-2">Name</div>
            <div class="col-md-4">
            <?php
                echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
                echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
                echo isset($row['user_lastname']) ? $row['user_lastname'] . '&nbsp;' : '';
                ?>
            </div>
            <div class="col-md-2">Email</div>
            <div class="col-md-4">
            <a href="mailto:<?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?>"><?php echo isset($row['user_email']) ? $row['user_email'] : ''; ?></a>
            </div>
        </div>
        <!--/.row-->
        
        <div class="row">
            <div class="col-md-2">Phone # 1</div>
            <div class="col-md-4"><?php echo isset($row['user_phone1']) ? $row['user_phone1'] : ''; ?></div>
            <div class="col-md-2">Phone # 2</div>
            <div class="col-md-4"><?php echo isset($row['user_phone2']) ? $row['user_phone2'] : ''; ?></div>
        </div>
        <!--/.row-->
        
        <div class="row">
            <div class="col-md-2">Date of Birth</div>
            <div class="col-md-4"><?php echo isset($row['user_dob']) ? $this->common_lib->display_date($row['user_dob']) : ''; ?></div>
            <div class="col-md-2">Gender</div>
            <div class="col-md-4"><?php echo isset($row['user_gender']) ? (($row['user_gender'] == 'M') ? 'Male' : 'Female') : ''; ?></div>
        </div>
        <!--/.row-->

        <!--/.row-->
		</div>
	</div>
  </div> <!--/#nav-basic-->
  
  <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
	<div class="row mt-3">
		<div class="col-md-12">			
			<!--<h6>Communication Address</h6><hr>-->
				<?php if(isset($address)){
					foreach($address as $key=>$addr){
					?>
						<div class="row mb-3">
							<div class="col-md-2"><?php echo isset($address_type[$addr['address_type']])?$address_type[$addr['address_type']]:'Address'; ?></div>
							<div class="col-md-10">
								<div class="">
									<?php echo isset($addr['name'])? $addr['name'].',&nbsp;' :'';?>
									<?php echo isset($addr['phone1'])? $addr['phone1'].', ':'';?>
									<?php echo isset($addr['address']) ? $addr['address'] : '';?>
									<?php echo isset($addr['locality'])? ', '.$addr['locality'] : '';?>
									<?php echo isset($addr['city']) ? ', '.$addr['city'].', ' : '';?>
									<?php echo isset($addr['state']) ? $addr['state'] : '';?>
									<?php echo isset($addr['zip']) ? ' - '.$addr['zip'] : '';?>                                
								</div>
								<div>
								</div>
							</div>
						</div>
						<!--/.row-->
					<?php
					}
				}?>
		</div>
	</div>
  </div> <!--/#nav-address-->
  
  
  <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-education-tab">
	<div class="row mt-3">
		<div class="col-md-12">			
			<!--<h6>Educational Qualification</h6><hr>-->
				<table class="table table-sm mt-1">
					<thead>
						<tr class="small">
							<th>Qualification</th>
							<th>Specialization</th>
							<th>Duration</th>
							<th>Institute/University</th>
							<th>Marks(%)</th>
						</tr>
					</thead>
					<tbody>
					<?php if(isset($education)){
						foreach($education as $key=>$edu){
						?>
							<tr>
								<td><?php echo isset($edu['qualification_name'])?$edu['qualification_name']:'';?></td>
								<td><?php echo isset($edu['specialization_name'])?$edu['specialization_name']:$edu['academic_other_specialization'];?></td>
								<td><?php echo isset($edu['academic_from_year'])?$edu['academic_from_year'].'-'.$edu['academic_to_year']:'';?></td>
								<td><?php echo isset($edu['institute_name']) ? $edu['institute_name']: $edu['academic_other_inst'];?></td>
								<td><?php echo isset($edu['academic_marks_percentage'])?$edu['academic_marks_percentage']:'';?></td>																
							</tr>
						<?php
						}
					}?>
					</tbody>				
				</table>
						
		</div>
	</div>
  </div> <!--/#nav-education-->
  
  <div class="tab-pane fade" id="nav-exp" role="tabpanel" aria-labelledby="nav-exp-tab">
	<div class="row mt-3">
		<div class="col-md-12">
			
		</div>
	</div>
  </div><!--/#nav-exp-->
  
</div><!--/.tab-content-->