<?php //$row = $profile_pic; ?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->


<div class="row">
	
    <div class="col-md-8">
		<div class="row">
			<div class="col-md-3 profile-pic">
				<?php
				$img_src = "";
				$default_path = "assets/src/img/125x125.jpg";
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
				<img style="width:150px; height: 150px;" src="<?php echo base_url($img_src);?>" alt="" class="img align-self-start mr-3 dp">
				<?php if(isset($profile_pic) && sizeof($profile_pic)>0){ ?>
					<div class="edit"><a href="<?php echo base_url($this->router->directory.'user/delete_profile_pic');?>"><i class="fa fa-remove"></i> Remove</a></div>
				<?php } ?>
			</div>
			<div class="col-md-9">
				<?php //print_r($row); ?>
				<?php
				// Show server side flash messages
				if (isset($alert_message)) {
					$html_alert_ui = '';                
					$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
					echo $html_alert_ui;
				}
				?>
				<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','role' => 'form'));?>
				<?php echo form_hidden('form_action', 'file_upload'); ?>
				
					
				<div class="form-group">								
					<label for="userfile" class="control-label">Select File</label>
					<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => '',));?>
					<?php echo form_error('userfile'); ?>
					<?php echo isset($upload_error_message) ? $upload_error_message : ''; ?>
					
					<div class="text-muted help-block">
						
						<ul>
							<li>Upload photos taken in professional attire only.</li>
							<li>Upload your individual photo and not a group photo or logo.</li>
							<li>Examine the quality and size of the image before uploading it. The image should be in <span class="font-weight-bold">.JPG, .JPEG</span> format and should be less than <span class="font-weight-bold">1 MB</span> in size.</li>
							<li>Photos must have plain back ground.</li>
							<li>You can opt to remove your photo from the Remove Photo page.</li>
						</ul>						
					</div>
				</div>
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Upload','class' => 'btn btn-primary'));?>
				<a href="<?php echo base_url($this->router->directory.'user/profile');?>" class="btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
				<?php echo form_close(); ?>
			</div>
		</div>
    </div><!--/.col-md-6-->
</div>