<?php $row = $row[0]; ?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        
    </div>
</div><!--/.heading-container-->


<div class="row"> 
    <?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
	?>

    <div class="col-md-8">
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'profile','id' => 'profile',)); ?>
        <?php echo form_hidden('form_action', 'update_profile'); ?>
			<?php 
			/*
			?>
            <div class="form-row">                
				<div class="form-group col-md-6">                                
					<label for="user_firstname" class="">First Name <span class="required">*</span></label>
					<?php
					echo form_input(array(
						'name' => 'user_firstname',
						'value' => isset($row['user_firstname']) ? $row['user_firstname'] : set_value('user_firstname'),
						'id' => 'user_firstname',
						'class' => 'form-control',
						'maxlength' => '30',
					));
					?>
					<?php echo form_error('user_firstname'); ?>
				</div>                
				<div class="form-group col-md-6">  
					<label for="user_lastname" class="">Last Name <span class="required">*</span></label>
					<?php
					echo form_input(array(
						'name' => 'user_lastname',
						'value' => isset($row['user_lastname']) ? $row['user_lastname'] : set_value('user_lastname'),
						'id' => 'user_lastname',
						'class' => 'form-control',
						'maxlength' => '50',
					));
					?>
					<?php echo form_error('user_lastname'); ?>
				</div>               
            </div><!--/.form-row-->
			<?php */ ?>
			
			<div class="form-group">
				<label for="user_bio" class="">About me</label>
				<?php
				echo form_input(array(
					'name' => 'user_bio',
					'value' => isset($row['user_bio']) ? $row['user_bio'] : set_value('user_bio'),
					'id' => 'user_bio',
					'class' => 'form-control',
					'placeholder' => 'write brief intro...',
					'title' => 'Short Bio',							
					'maxlength' => '100',
				));
				?>
				<?php echo form_error('user_bio'); ?>
			</div>
			
            <?php /* ?>
			<div class="form-group">
				<label class="">Gender <span class="required">*</span></label>
				<div class="form-radio">
					<?php
					$radio_is_checked = (isset($row['user_gender']) ? $row['user_gender'] : $this->input->post('user_gender')) === 'M';
					echo form_radio(array(
						'name' => 'user_gender',
						'value' => 'M',
						'id' => 'm',
						'checked' => $radio_is_checked,
						'class' => '',
						), set_radio('user_gender', 'M')
					);
					?>
					<label  class="form-radio-label" for="m">Male</label>
					
					<?php
					$radio_is_checked = (isset($row['user_gender']) ? $row['user_gender'] : $this->input->post('user_gender')) === 'F';
					echo form_radio(array(
						'name' => 'user_gender',
						'value' => 'F',
						'id' => 'f',
						'checked' => $radio_is_checked,
						'class' => ''
						), set_radio('user_gender', 'F')
					);
					?>
					<label  class="form-radio-label" for="f">Female</label>
					
					<?php
					$radio_is_checked = (isset($row['user_gender']) ? $row['user_gender'] : $this->input->post('user_gender')) === 'T';
					echo form_radio(array(
						'name' => 'user_gender',
						'value' => 'T',
						'id' => 't',
						'checked' => $radio_is_checked,
						'class' => ''
						), set_radio('user_gender', 'T')
					);
					?>
					<label  class="form-radio-label" for="t">Others</label>
					                   
					<?php echo form_error('user_gender'); ?>
				</div>
			</div>
			
			<?php */ ?>
        
            <div class="form-row">                
				<div class="form-group col-md-6">
					<label for="user_phone1" class="">Mobile #1 <span class="required">*</span></label>
					<?php
					echo form_input(array(
						'name' => 'user_phone1',
						'value' => isset($row['user_phone1']) ? $row['user_phone1'] : set_value('user_phone1'),
						'id' => 'user_phone1',
						'class' => 'form-control',
						'maxlength' => '10',
						'minlength' => '10',
					));
					?>
					<?php echo form_error('user_phone1'); ?>
				</div>                
				<div class="form-group col-md-6">
					<label for="user_phone2" class="">Mobile #2</label>
					<?php
					echo form_input(array(
						'name' => 'user_phone2',
						'value' => isset($row['user_phone2']) ? $row['user_phone2'] : set_value('user_phone2'),
						'id' => 'user_phone2',
						'class' => 'form-control',
						'maxlength' => '10',
						'minlength' => '10',
					));
					?>
					<?php echo form_error('user_phone2'); ?>
				</div>                
            </div><!--/.row-->
			
			<?php echo form_submit(array('name' => 'submit','value' => 'Update','class' => 'btn btn-primary',));?> 
			<a href="<?php echo base_url($this->router->directory.'user/profile');?>" class="btn btn-secondary">Back</a>
        <?php echo form_close(); ?>
		
    </div><!--/.col-md-8-->
</div>