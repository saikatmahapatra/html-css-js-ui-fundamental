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
        <?php 
		echo form_open(current_url(), array(
		'method' => 'post', 
		'class' => 'ci-form',
		'name' => 'profile',
		'id' => 'profile',
		));
		?>
        <?php echo form_hidden('form_action', 'insert_address'); ?>
			<div class="row">
                <div class="col-md-6">
                    <div class="form-group">                                
						<label for="name" class="">Name</label>
                        <?php 
						echo form_input(array(
						'name' => 'name',
						'value' =>set_value('name'),
						'id' => 'address',
						'class' => 'form-control',
						'maxlength' => '100',
						'placeholder'=>'',
						));
                        ?>
                        <?php echo form_error('name'); ?>
                    </div>
                </div>
				<div class="col-md-6">
						<div class="form-group">        							
							<label for="phone1" class="">Phone Number</label>
							<?php 
							echo form_input(
							array('name' => 'phone1',
							'value' =>set_value('phone1'),
							'id' => 'phone1',
							'class' => 'form-control',
							'maxlength' => '10',
							'placeholder'=>'',
							));
							?>
							<?php echo form_error('phone1'); ?>
						</div>
					</div>
            </div>
			<div class="row">				
				<div class="col-md-6">
					<div class="form-group">        						
						<label for="zip" class="">Pincode</label>
						<?php
						echo form_input(array(
							'name' => 'zip',
							'value' => set_value('zip'),
							'id' => 'zip',
							'class' => 'form-control',
							'maxlength' => '10',
							'placeholder'=>''
						));
						?>
						<?php echo form_error('zip'); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">						
						<label for="locality" class="">Locality</label>
						<?php
						echo form_input(array(
							'name' => 'locality',
							'value' => set_value('locality'),
							'id' => 'locality',
							'class' => 'form-control',
							'placeholder'=>''
						));
						?>
						<?php echo form_error('locality'); ?>
					</div>
				</div>
				</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">        						
						<label for="address" class="">Address (Apt. Area & Street)</label>
						<?php 
						echo form_input(array(
						'name' => 'address',
						'value' => set_value('address'),
						'id' => 'address',
						'class' => 'form-control',
						'maxlength' => '100',
						));
						?>
						<?php echo form_error('address'); ?>
					</div>
				</div>
			</div>			
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="city" class="">City/District/Town</label>
						<?php 
						echo form_input(array(
						'name' => 'city',
						'value' =>set_value('city'),
						'id' => 'city',
						'class' => 'form-control',
						'maxlength' => '30',
						'placeholder'=>'',
						));
						?>
						<?php echo form_error('city'); ?>
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label for="state" class="">State</label>
						<?php 
						echo form_input(array(
						'name' => 'state',
						'value' => set_value('state'),
						'id' => 'state',
						'class' => 'form-control',
						'maxlength' => '30',
						'placeholder'=>'',
						));
						?>
						<?php echo form_error('state'); ?>
					</div>
				</div>
			</div>	
			
				
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="landmark" class="">Landmark (Optional)</label>
						<?php 
						echo form_input(array(
						'name' => 'landmark',
						'value' => set_value('landmark'),
						'id' => 'landmark',
						'class' => 'form-control',
						'maxlength' => '100',
						'placeholder'=>'',
						));
						?>
						<?php echo form_error('landmark'); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="phone2" class="">Alternate Phone (Optional)</label>
						<?php 
						echo form_input(array(
						'name' => 'phone2',
						'value' => set_value('phone2'),
						'id' => 'phone2',
						'class' => 'form-control',
						'maxlength' => '10',
						'placeholder'=>'',
						));
						?>
						<?php echo form_error('phone2'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="address_type" class="">Address Type</label>
						<div>
						<?php						
						if(isset($address_type)){
							foreach($address_type as $address_char=>$address_text){
								?>
								<label class="">
									<?php
									$radio_is_checked = $this->input->post('address_type') === $address_char;
									echo form_radio(array(
									'name' => 'address_type',
									'value' => $address_char,
									'id' => $address_char,
									'checked' => $radio_is_checked,
									'class' => '',
									), set_radio('address_type', $address_char));
									?>
									<span><?php echo $address_text;?></span>
								</label>
								<?php
							}
						}
						?>
						</div>
						<?php echo form_error('address_type'); ?>
					</div>
				</div>				
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group"> 
						<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
						<a href="<?php echo base_url($this->router->directory.'user/profile');?>" class="btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>						
					</div>
				</div>
			</div>
        <?php echo form_close(); ?>
    </div>  
</div>