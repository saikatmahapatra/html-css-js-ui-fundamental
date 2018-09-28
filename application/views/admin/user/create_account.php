<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading: 'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        
    </div>
</div><!--/.heading-container-->

<div class="row">
    <div class="col-md-8">
        <?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
        <?php echo form_hidden('form_action', 'create_account'); ?>        
        <div class="form-row">
			<div class="form-group col-md-6">                            
				<label for="user_firstname" class="">First Name <span class="required">*</span></label>
				<?php
				echo form_input(array(
					'name' => 'user_firstname',
					'value' => set_value('user_firstname'),
					'id' => 'user_firstname',
					'class' => 'form-control',
					'maxlength' => '30',
					'placeholder' => '',
				));
				?>
				<?php echo form_error('user_firstname'); ?>
			</div>
			
			<div class="form-group col-md-6">                            
				<label for="user_lastname" class="">Last Name <span class="required">*</span></label>
				<?php
				echo form_input(array(
					'name' => 'user_lastname',
					'value' => set_value('user_lastname'),
					'id' => 'user_lastname',
					'class' => 'form-control',
					'maxlength' => '50',
					'placeholder' => '',
				));
				?>
				<?php echo form_error('user_lastname'); ?>
			</div>
		</div>
       
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="user_email" class="">Email Address <span class="required">*</span></label>
				<?php
				echo form_input(array(
					'name' => 'user_email',
					'value' => set_value('user_email'),
					'id' => 'user_email',
					'class' => 'form-control',
					'maxlength' => '255',
					'placeholder' => '',
				));
				?> 
				<?php echo form_error('user_email'); ?>
			</div>
			<div class="form-group col-md-6">                           
				<label for="user_phone1" class="">Mobile (Primary) <span class="required">*</span></label>
				<?php
				echo form_input(array(
					'name' => 'user_phone1',
					'value' => set_value('user_phone1'),
					'id' => 'user_phone1',
					'maxlength' => '10',
					'class' => 'form-control',
					'placeholder' => '',
				));
				?>
				<?php echo form_error('user_phone1'); ?>
			</div>
		</div>
			
            <div class="form-row">
                <div class="form-group col-md-6">                            
					<label for="user_dob" class="">Date of Birth <span class="required">*</span></label>
                    <div class="">
                        <?php echo form_dropdown('dob_day', $day_arr, set_value('dob_day'), array('class' => 'form-control dob-inline',));?>
                        <?php echo form_dropdown('dob_month', $month_arr, set_value('dob_month'), array('class' => 'form-control dob-inline',));?>
                        <?php echo form_dropdown('dob_year', $year_arr, set_value('dob_year'), array('class' => 'form-control dob-inline'));?>
                    </div>
                    <?php echo form_error('dob_day'); ?>
                    <?php echo form_error('dob_month'); ?>
                    <?php echo form_error('dob_year'); ?>
                </div>
            
				<div class="form-group col-md-6">
					<label for="gender">Gender <span class="required">*</span></label>
					<div class="form-radio">
						<?php
						$radio_is_checked = $this->input->post('user_gender') === 'M';
						echo form_radio(array(
							'name' => 'user_gender',
							'value' => 'M',
							'id' => 'm',
							'checked' => $radio_is_checked,
							'class' => '',
								), set_radio('user_gender', 'M')
						);
						?>
						<label class="form-radio-label" for="m">Male</span></label>
						
						<?php
						$radio_is_checked = $this->input->post('user_gender') === 'F';
						echo form_radio(array(
							'name' => 'user_gender',
							'value' => 'F',
							'id' => 'f',
							'checked' => $radio_is_checked,
							'class' => ''
								), set_radio('user_gender', 'F')
						);
						?>
						<label class="form-radio-label" for="f">Female</span></label>
						
						<?php
						$radio_is_checked = $this->input->post('user_gender') === 'T';
						echo form_radio(array(
							'name' => 'user_gender',
							'value' => 'T',
							'id' => 't',
							'checked' => $radio_is_checked,
							'class' => ''
								), set_radio('user_gender', 'T')
						);
						?>
						<label class="form-radio-label" for="t">Others</span></label>
					</div>
					<?php echo form_error('user_gender'); ?>
			  </div>
			</div>

        <div class="form-row">
			<div class="form-group col-md-6">
			  <label for="user_role" class="">Role <span class="required">*</span></label>
				<?php
				echo form_dropdown('user_role', $arr_roles, set_value('user_role'), array(
					'class' => 'form-control field-help',					
					'data-help-text' => 'This will define user role. Role controlls user permission to do any thing like add, edit or delete something. If you are adding employee, choose role as <b>User</b>, If you are adding HR or CEO you can choose role as <b>administrator</b> or <b>super admin</b>',
					'data-help-text-class' => 'p-3 mt-1 mb-2 bg-info text-white'
				));
				?> 
				<?php echo form_error('user_role'); ?>
			</div>
		</div>

        <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		<a href="<?php echo base_url($this->router->directory.'user/manage');?>" class="btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
        <?php echo form_close(); ?>
    </div>
</div>