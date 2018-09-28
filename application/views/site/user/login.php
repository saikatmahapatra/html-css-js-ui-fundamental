<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        
    </div>
</div><!--/.heading-container-->


<div class="row">
    <div class="col-12 col-sm-8 col-md-4">
        <?php
			// Show server side flash messages
			if (isset($alert_message)) {
				$html_alert_ui = '';                
				$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
				echo $html_alert_ui;
			}
		?>
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'form', 'id' => 'form')); ?> 
        <?php echo form_hidden('form_action', 'login'); ?>
        <div class="form-group">
            <label for="user_email" class="">Email <span class="required">*</span></label>
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
        <div class="form-group">            
			<label for="user_password" class="">Password <span class="required">*</span></label>
            <?php
            echo form_password(array(
                'name' => 'user_password',
                'value' => set_value('user_password'),
                'id' => 'user_password',
                'class' => 'form-control',
                'maxlength' => '16',
                'placeholder' => '',
            ));
            ?> 
            <?php echo form_error('user_password'); ?>
        </div>
        
		<?php
		echo form_submit(array(
			'name' => 'submit',
			'value' => 'Log In',
			'class' => 'btn btn-primary',
		));
		?>
		<?php echo form_close(); ?>
		
		<div class="text-centre">
			<a class="d-block" href="<?php echo base_url($this->router->directory.'user/forgot_password');?>" class="">Forgot your password?</a>
			<a class="d-block" href="<?php echo base_url($this->router->directory.'user/create_account');?>" class="">Create an account</a>
		</div>
		
		
    </div>
</div>