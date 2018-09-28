<?php
$row = $rows[0];
//print_r($row);
//print_r($odetails);
?>
<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
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
		<div class="card order-summary">
			<div class="card-header">
				<h6>Order # <?php echo isset($row['order_no']) ? $row['order_no'] : '';?>  <?php echo isset($row['order_status']) ? strtoupper($row['order_status']) : '';?> <span class="pull-right"><?php echo isset($row['order_datetime']) ? $row['order_datetime'] : '';?></span></h6>
			</div>
			<div class="card-body">
				
				<div class="row">				
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-4">Order Total</div>
							<div class="col-md-1">:</div>
							<div class="col-md-7"><?php echo isset($row['order_total_amt']) ? $row['order_total_amt'] : '';?></div>
						</div>
					</div>					
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-4">Payment Status</div>
							<div class="col-md-1">:</div>
							<div class="col-md-7"><?php echo isset($row['order_payment_status']) ? $row['order_payment_status'] : '';?></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-4">Payment Mode</div>
							<div class="col-md-1">:</div>
							<div class="col-md-7"><?php echo isset($row['order_payment_method']) ? $row['order_payment_method'] : '';?></div>
						</div>
					</div>
					
				</div>
				<div class="row mb-3">				
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-4">Order GST</div>
							<div class="col-md-1">:</div>
							<div class="col-md-7"><?php echo isset($row['order_tax_amt']) ? $row['order_tax_amt'] : '';?></div>
						</div>
					</div>					
					<div class="col-md-4">						
						<div class="row">
							<div class="col-md-4">Order Discount</div>
							<div class="col-md-1">:</div>
							<div class="col-md-7"><?php echo isset($row['order_discount_amt']) ? $row['order_discount_amt'] : '';?></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-4">Transaction #</div>
							<div class="col-md-1">:</div>
							<div class="col-md-7"><?php echo isset($row['order_payment_trans_id']) ? $row['order_payment_trans_id'] : '';?></div>
						</div>
					</div>					
				</div>
				
				<div class="row mb-3 small">
					<div class="col-md-6">
						<div class="font-weight-bold">Deliver To:</div>
						<div><?php echo isset($row['order_shipping_name']) ? $row['order_shipping_name'] : '';?></div>
						<div><?php echo isset($row['order_shipping_address']) ? $row['order_shipping_address'] : '';?></div>
						<div>
						<?php echo isset($row['order_shipping_locality']) ? $row['order_shipping_locality'].', ' : '';?>
						<?php echo isset($row['order_shipping_city']) ? $row['order_shipping_city'].', ' : '';?>						
						</div>
						<div>Landmark-<?php echo isset($row['order_shipping_landmark']) ? $row['order_shipping_landmark'] : '';?></div>
						<div>
							<?php echo isset($row['order_shipping_state']) ? $row['order_shipping_state'].' - ' : '';?>
							<?php echo isset($row['order_shipping_zip']) ? $row['order_shipping_zip'] : '';?>
						</div>
						<div>
							<?php echo isset($row['order_shipping_phone1']) ? $row['order_shipping_phone1'] : '';?>
							<?php echo isset($row['order_shipping_phone2']) ? ' / '.$row['order_shipping_phone2'] : '';?>
						</div>						
					</div>
					<div class="col-md-6 text-right">
						<div class="font-weight-bold">Order Placed By</div>
						<div>
						<?php echo isset($row['user_firstname']) ? $row['user_firstname'] : '';?><?php echo isset($row['user_lastname']) ? $row['user_lastname'] : '';?>
						</div>
						<div><?php echo isset($row['user_email']) ? $row['user_email']: '';?></div>						
						<div>
							<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : '';?>
						</div>						
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<table class="table small table-sm">
						  <thead>
							<tr class="">
							  <th scope="col">#</th>
							  <th scope="col">Product</th>
							  <th scope="col">In Stock</th>
							  <th scope="col">Qty</th>
							  <th scope="col">Price</th>
							  <!--<th scope="col">Disscount</th>
							  <th scope="col">Coupon</th>-->
							  <th scope="col">Delivery</th>
							  <th scope="col">Total</th>
							  <th scope="col">Status</th>
							</tr>
						  </thead>
						  <tbody>
							<?php
							echo form_open(current_url(), array(
								'method' => 'post',			
								'class'=>'ci-form',
								'name' => '',
								'id' => 'order-update-form',
							));
							?>
							<?php echo form_hidden('form_action', 'update'); ?>
							<?php
								if (isset($odetails) && sizeof($odetails) > 0) {
									$i = 1;
									foreach ($odetails as $key => $drow) {
										?>										
										<tr class="order-item">
										  <th scope="row"><?php echo $i;?></th>
										  <td>
											<div class="media">
												<div class="mr-3 media-left media-top">
												<img class="mr-3" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16345c2a7ae%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16345c2a7ae%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
												</div>
												<div class="media-body">											
													<div class="mt-0"><?php echo isset($drow['product_name']) ? $drow['product_name'] : '';?></div>
													<div><?php echo isset($drow['product_size']) ? $drow['product_size'] : '';?></div>
													<div><?php echo isset($drow['product_color']) ? $drow['product_color'] : '';?></div>
													<div><?php echo isset($drow['order_details_unit_price']) ? $drow['order_details_unit_price'] : '';?></div>
													</div><!--/.media-body-->
											</div><!--/.media-->
										  
										  </td>
										  <td>N/A</td>
										  <td><?php echo isset($drow['order_detail_quantity']) ? $drow['order_detail_quantity'] : '';?></td>
										  <td><?php echo isset($drow['order_detail_price']) ? $drow['order_detail_price'] : '';?></td>
										  <!--<td><?php echo isset($drow['order_detail_discount_amt']) ? $drow['order_detail_discount_amt'] : '';?></td>
										  <td><?php echo isset($drow['order_detail_discount_coupon']) ? $drow['order_detail_discount_coupon'] : '';?></td>-->
										  <td><?php echo isset($drow['order_detail_delivery_amt']) ? $drow['order_detail_delivery_amt'] : '';?></td>
										  <td><?php echo isset($drow['order_detail_total_amt']) ? $drow['order_detail_total_amt'] : '';?></td>
										  
										  <td>											
											<?php
											echo form_dropdown('order_detail_status['.$drow['id'].']', $arr_order_item_status, $drow['order_detail_status'], array(
												'class' => 'form-control-sm',
											));
											?>
										  </td>
										</tr><!--/.order-item-->										
										<?php
										$i++;										
									}
								}
							?>
							
							<tr class="order-item mt-3">							  
							  <td colspan="8">
								<div class="pull-right mt-4">
								<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Update','class' => 'btn btn-primary'));?> 
								<a href="<?php echo base_url($this->router->directory.'order');?>" class="btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
								</div>
							  </td>
							</tr><!--/.order-item-->
							
						  </tbody>
						  <?php echo form_close(); ?>
						</table>				
					</div>
				</div>
				
				</div>
			</div><!--/.card-body-->
		</div><!--/.card-->
            
        </div>
	</div>
</div>