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
		<div class="card">
			<div class="card-header">
                Order # <?php echo $order_no;?>
			</div>
			<div class="card-body">
                <p class="text-center">Thank you for shopping with us. We have received your order. You will get order status email notifications soon.<p>
				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'order', 'id' => 'cartForm')); ?>
				<?php echo form_hidden('form_action', 'order'); ?>			
				<div class="text-center">
					<a href="<?php echo base_url($this->router->directory.'order/download_invoice');?>" class="btn btn-primary">Download Invoice</a>
					<a href="<?php echo base_url($this->router->directory.'product');?>" class="btn btn-primary">Continue Shopping</a>
				</div>
				<?php echo form_close(); ?>
			</div>            
		</div>
	</div>	
</div>