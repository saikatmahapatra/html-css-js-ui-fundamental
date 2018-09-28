<?php $row = $row[0]; ?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->


<div class="row">        
    <div class="col-md-6">
        <?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form',
            'name' => 'profile',
            'id' => 'profile',));
        ?>
        <?php echo form_hidden('form_action', 'update_profile'); ?>
			
			<?php /* ?>
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
            </div><!--/.row-->
			<?php */ ?>
			<div class="form-group">
				<label for="user_bio" class="">About me</label>
				<?php
				echo form_input(array(
					'name' => 'user_bio',
					'value' => isset($row['user_bio']) ? $row['user_bio'] : set_value('user_bio'),
					'id' => 'user_bio',
					'class' => 'form-control',
					'placeholder' => 'write brief intro',							
					'maxlength' => '100',
				));
				?>
				<?php echo form_error('user_bio'); ?>
			</div>
                
			<?php /*?>	
            <div class="form-control">
                    <label class="">Gender <span class="required">*</span></label>
                    <div class="radio">  
                        <label class="label-normal">
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
                            <span>Male</span>
                        </label>                    
                        <label class="label-normal">
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
                            <span>Female</span>
                        </label>                    
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
            </div><!--/.form-row-->
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.'user/profile');?>" class="btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
        <?php echo form_close(); ?>
    </div><!--/.col-md-6-->
</div>