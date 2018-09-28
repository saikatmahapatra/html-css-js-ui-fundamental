<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        
    </div>
</div><!--/.heading-container-->

<div class="row">
	<div class="col-md-4">
	<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
    <?php echo form_open_multipart(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => '','id' => '',));?>
    <?php echo form_hidden('form_action', 'send'); ?>    
        <div class="form-group">                    
			<label for="name">Name <span class="required">*</span></label>
            <?php
            echo form_input(array(
                'name' => 'name',
                'value' => set_value('name'),
                'id' => 'name',
                'class' => 'form-control',
                'placeholder' => '',
                'title' => '',
                'minlength' => '5',
                'maxlength' => '50',
            ));
            ?>
            <?php echo form_error('name'); ?>
        </div>

        <div class="form-group">                    
			<label for="email" class="">Email <span class="required">*</span></label>			
            <?php
            echo form_input(array(
                'name' => 'email',
                'value' => set_value('email'),
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => '',
                'title' => '',
                'minlength' => '5',
                'maxlength' => '100',
            ));
            ?> 
            <?php echo form_error('email'); ?>
        </div>
        <div class="form-group">                    
			<label for="phone_number" class="">Mobile</label>
            <?php
            echo form_input(array(
                'name' => 'phone_number',
                'value' => set_value('phone_number'),
                'id' => 'phone_number',
                'class' => 'form-control',
                'placeholder' => '',
                'title' => '',
                'minlength' => '10',
                'maxlength' => '10',
            ));
            ?>
            <?php echo form_error('phone_number'); ?>
        </div>
        <div class="form-group"> 
			<label for="message" class="">Message <span class="required">*</span></label>
            <?php
            echo form_textarea(array(
                'name' => 'message',
                'value' => set_value('message'),
                'id' => 'message',
                'class' => 'form-control',
                'rows' => '4',
                'cols' => '50',
                'placeholder' => '',
                'title' => '',
                'minlength' => '5',
                'maxlength' => '200',
            ));
            ?>
            <?php echo form_error('message'); ?>
        </div>

        <div class="form-group">            
            <div><?php print_r($captcha_image); ?></div>
            <br>
            <?php echo form_hidden('hdn_captcha_word', $captcha_word); ?> 
            <?php
            echo form_input(array(
                'name' => 'captcha',
                'value' => set_value('captcha'),
                'id' => 'captcha',
                'class' => 'form-control',
                'placeholder' => 'Enter the displayed characters',
                'title' => '',
                'minlength' => '',
                'maxlength' => '15',
            ));
            ?>
            <?php echo form_error('captcha'); ?>
        </div>
        
		<?php
		echo form_submit(array(
			'name' => 'submit',
			'value' => 'Submit',
			'class' => 'btn btn-primary',
		));
		?>
	<?php echo form_close(); ?>
	</div>
</div>