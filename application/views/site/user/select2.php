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

        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'address_add','id' => 'address_add')); ?>
        <?php echo form_hidden('form_action', 'add'); ?>
			<div class="form-row">    
				<div class="form-group col-md-6">        							
					<label for="academic_specialization" class="">Specialization</label>
					<?php
					echo form_dropdown('academic_specialization', $arr_academic_specialization, set_value('academic_specialization'), array(
						'class' => 'form-control',
						'id' => 'academic_specialization',
					));
					?> 
					<?php echo form_error('academic_specialization'); ?>
				</div>
				<div class="newtag d-none"></div>
            </div>
			<?php
			echo form_submit(array(
			'name' => 'submit',
			'value' => 'Save',
			'class' => 'btn btn-primary',
			));
			?>
			<a href="<?php echo base_url($this->router->directory.'user/profile');?>" class="btn btn-secondary">Back</a>
        <?php echo form_close(); ?>
    </div>  
</div>