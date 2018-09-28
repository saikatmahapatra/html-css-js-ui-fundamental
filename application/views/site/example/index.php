<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        
    </div>
</div><!--/.heading-container-->

<div class="row">
    <div class="col-md-12">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
        <ul>
            <li><a href="<?php echo base_url($this->router->directory.'example/form_helper');?>" class="">Form Helper</a></li>
            <li><a href="<?php echo base_url($this->router->directory.'example/dom_pdf_gen_pdf');?>" class="">DOM PDF Generate</a></li>
            <li><a href="<?php echo base_url($this->router->directory.'example/date_helper');?>" class="">Date Helper</a></li>
            <li><a href="<?php echo base_url($this->router->directory.'example/directory_helper');?>" class="">Directory Helper</a></li>
        </ul>   
    </div>

</div>