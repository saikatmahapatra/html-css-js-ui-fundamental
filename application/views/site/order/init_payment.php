<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        
    </div>
</div><!--/.heading-container-->


<?php
	// Show server side flash messages
	if (isset($alert_message)) {
		$html_alert_ui = '';                
		$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
		echo $html_alert_ui;
	}
?>

<?php echo form_open(current_url(), array('method' => 'post','class'=>'ci-form','name' => '','id' => '',)); ?>
<?php echo form_hidden('form_action', 'place_order'); ?>
<div class="row">    
   <div class="col-md-8">    
    <div id="accordion">        
        <div class="card">
            <div class="card-header" id="heading_1">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_1" aria-expanded="false" aria-controls="collapse_1">1. Login</button>
                </h5>
            </div>
            <div id="collapse_1" class="collapse show" aria-labelledby="heading_1" data-parent="#accordion">
            <div class="card-body">
                  <div class="">
                     <h4><?php echo $this->session->userdata['sess_user']['user_firstname'].' '.$this->session->userdata['sess_user']['user_lastname'];?></h4>
                  </div>
                  <div class=""><?php echo $this->session->userdata['sess_user']['user_email'];?></div>
               </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="heading_2">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_2" aria-expanded="false" aria-controls="collapse_2">2. Select Delivery Address</button>
                </h5>
            </div>
            <div id="collapse_2" class="collapse" aria-labelledby="heading_2" data-parent="#accordion">
            <div class="card-body">
                  <?php //echo '<pre>';print_r($shipping_address);?>
                  <?php if(isset($shipping_address)){
                     foreach($shipping_address as $key=>$shipping_addr){
                     ?>
					 
                  <div class="radio">
                     <label>                        
						<?php
							$radio_is_checked = $this->input->post('shipping_address') === $shipping_addr['id'];
							echo form_radio(array(
							'name' => 'shipping_address',
							'value' => $shipping_addr['id'],
							'id' => 'delivery_address_'.$shipping_addr['id'],
							'checked' => $radio_is_checked,
							'class' => '',
							), set_radio('shipping_address', $shipping_addr['id']));
						?>
                        <div class="text-bold">
							<?php echo isset($shipping_addr['name'])?$shipping_addr['name'].'&nbsp;' :'';?>
							<?php echo isset($shipping_addr['phone1'])?$shipping_addr['phone1']:'';?>
						</div>
						<div>
							<?php echo isset($shipping_addr['address']) ? $shipping_addr['address'] : '';?>
							<?php echo isset($shipping_addr['locality'])? ', '.$shipping_addr['address'] : '';?>
							<?php echo isset($shipping_addr['city']) ? ', '.$shipping_addr['city'].', ' : '';?>                                    
						</div>
						<div>
							<?php echo isset($shipping_addr['state']) ? $shipping_addr['state'] : '';?>
							<?php echo isset($shipping_addr['zip']) ? ' - <span class="text-bold">'.$shipping_addr['zip'].'</span>' : '';?>
						</div>
						<?php echo form_error('shipping_address');?>
						<a class="btn btn-primary">Deliver Here</a>
                     </label>
                  </div>
                  <?php
                     }
                     }else{
						 ?>
						 <a class="btn btn-primary pull-right" href="<?php echo base_url($this->router->directory.'user/add_address');?>">Add a Shipping Address</a>
						 <?php
					 }
					?>
               </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="heading_3">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_3" aria-expanded="false" aria-controls="collapse_3">3. Review Order Summary</button>
                </h5>
            </div>
            <div id="collapse_3" class="collapse" aria-labelledby="heading_3" data-parent="#accordion">
            <div class="card-body">
                  <?php
                     if (sizeof($cartrows) > 0) {
                     	$row_counter = 1;								
                     	foreach ($cartrows as $row) {									
                     		//print_r($row);
                     		?>
                  <div class="row cart-item" data-rowid="<?php echo $row['rowid']; ?>" data-id="<?php echo $row['id']; ?>">
                     <div class="col-md-12">
                        <div class="media">
                           <div class="media-left media-top mr-3">
                              <img src="https://www.w3schools.com/bootstrap/img_avatar1.png" class="media-object" style="width:60px">
                           </div>
                           <div class="media-body">
                              <h4 class="media-heading"><?php echo $row['name']; ?></h4>
                              <div>Size: M</div>
                              <div>Seller: Polo Store</div>
                              <div class="row">
                                 <div class="col-md-2">
                                    Quantity : <?php echo $row['qty']; ?>
                                    <?php echo form_hidden('rowid_'.$row_counter,$row['rowid']);?>
                                 </div>
                                 <div class="col-md-8 text-right text-bold"><?php echo '<span class="currency" id="INR">&#8377;</span>'.number_format($row['line_total'], 2); ?></div>
                              </div>
                           </div>
                        </div>
                        <!--/.media-->
                     </div>
                  </div>
                  <?php
                     $row_counter++;
                     } ?>
                  <?php } ?>
               </div>
            </div>
        </div>



        <div class="card">
            <div class="card-header" id="heading_4">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse_4" aria-expanded="false" aria-controls="collapse_4">4. Payment</button>
                </h5>
            </div>
            <?php $expand_on_error = form_error('payment_method')? 'show':''; ?>
            <div id="collapse_4" class="collapse <?php echo $expand_on_error; ?>" aria-labelledby="heading_4" data-parent="#accordion">
            <div class="card-body">
					<div class="form-group">
						<label for="payment_method" class="">Payment Method</label>
						<div>
						<?php						
						if(isset($payment_method)){
							foreach($payment_method as $key=>$val){
								?>
								<label class="">
									<?php
									$radio_is_checked = $this->input->post('payment_method') === $key;
									echo form_radio(array(
									'name' => 'payment_method',
									'value' => $key,
									'id' => $key,
									'checked' => $radio_is_checked,
									'class' => '',
									), set_radio('payment_method', $key));
									?>
									<span><?php echo $val;?></span>
								</label>
								<?php
							}
						}
						?>
						</div>
						<?php echo form_error('payment_method'); ?>
					</div>
               </div>
            </div>
        </div>        
    </div><!--/#accordion-->    
   </div>
   <div class="col-md-4">
      <div class="card">
         <div class="card-header">Price Details</div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-6">Price(<?php echo isset($total_items) ? $total_items.' items' : ''; ?>)</div>
               <div class="col-md-6 text-right"><span class="currency" id="INR">&#8377;</span><?php echo isset($cart_total)?number_format($cart_total,2):'';?></div>
            </div>
            <div class="row">
               <div class="col-md-6">Delivery Charges</div>
               <div class="col-md-6 text-right text-success">FREE</div>
            </div>
         </div>
         <div class="card-footer">
            <div class="row">
                <div class="col-12 h5">
                Amount Payble <span class="currency" id="INR">&#8377;</span><?php echo isset($cart_total) ? number_format($cart_total,2) :'';?>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </div>
            </div>
         </div>
      </div>
   </div>   
</div><!--/.row-->
<?php echo form_close(); ?>