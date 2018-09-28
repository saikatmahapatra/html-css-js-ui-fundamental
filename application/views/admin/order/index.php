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
			<div class="card-header">Data Table</div><!-- /.card-header -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table table-sm">
						<thead>
							<tr>
								<th>Order #</th>
								<th>Date</th>
								<th>Order Amt</th>
								<th>Payment Status</th>
								<th>Customer</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<th>Order #</th>
								<th>Date</th>
								<th>Order Amt</th>
								<th>Payment Status</th>
								<th>Customer</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div><!-- /.card-body -->
		</div><!-- /.card -->
    </div><!-- /.col-md-12 -->
</div><!-- /.row -->