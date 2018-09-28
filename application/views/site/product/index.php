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
    </div>
</div>

<div id="products" class="row">        
    <?php
    if (isset($products) && sizeof($products) > 0) {
        foreach ($products as $key => $product) {
            ?>
			<div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="<?php echo base_url('assets/dist/img/prod.png'); ?>" alt="" data-holder-rendered="true">
                <div class="card-body">
					<?php echo isset($product['category_name']) ? '<i class="glyphicon glyphicon-tag text-warning"></i>' . $product['category_name'] : ''; ?>
					<h5><?php echo isset($product['product_name']) ? $product['product_name'] : 'Untitled'; ?></h5>
					<p class="card-text"><?php echo isset($product['product_description']) ? word_limiter($product['product_description'], 20) : 'No details available !'; ?></p>
					<p class="card-text muted"><?php echo isset($product['product_mrp']) ? '<del>&#8377; ' . $product['product_mrp'] . '</del>' : '&#8377; 00.00'; ?></p>
                    <p class="card-text lead"><?php echo isset($product['product_price']) ? '&#8377; ' . $product['product_price'] : '&#8377; 00.00'; ?></p>
					
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="<?php echo base_url($this->router->directory.'product/index/');?>" class="btn btn-info">Details</a>
                      <a href="<?php echo base_url($this->router->directory.'order/add_to_cart/'.$this->common_lib->encode($product['id']));?>" class="btn btn-primary">Add to cart</a>
                    </div>
                    <small class="text-muted">9 reviews</small>
                  </div>
                </div>
              </div>
            </div>            
            <?php
        }
    }
    ?>
</div>