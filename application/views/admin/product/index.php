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
		<div class="card ">
			<div class="card-header">
				<span class="">Products</span>
				<span class="float-right">
					<a href="<?php echo base_url($this->router->directory.'product/add');?>" class="btn btn-sm btn-primary" title="Add"> Add New</a>
				</span>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="product-datatable" class="table table-sm">
						<thead>
							<tr>
								<th>SKU</th>
								<th>Product</th>
								<th>Category</th>
								<th>MRP</th>
								<th>Price</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<th>SKU</th>
								<th>Product</th>
								<th>Category</th>
								<th>MRP</th>
								<th>Price</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div><!-- /.card-body -->
		</div><!-- /.card -->
    </div>
</div><!--/.row-->