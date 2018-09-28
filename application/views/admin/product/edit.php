<?php
$row = $rows[0];
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
		
		<nav>
			<?php
				/*Logic for active nav link*/
				$active_tab_class = "show active";
				$active_nav_link_class = "active";
				
				$show_nav_link_info = "";
				$show_nav_info = "";
				
				$show_nav_link_upload = "";
				$show_nav_upload = "";
				
				if($this->input->post('form_action')=='update'){
					$show_nav_info = $active_tab_class;
					$show_nav_link_info = $active_nav_link_class;
				}
				else if($this->input->post('form_action')=='file_upload'){
					$show_nav_upload = $active_tab_class;
					$show_nav_link_upload = $active_nav_link_class;
				}
				else{
					$show_nav_info = $active_tab_class;
					$show_nav_link_info = $active_nav_link_class;
				}
			?>
		  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link <?php echo isset($show_nav_link_info)? $show_nav_link_info :''; ?>" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-controls="nav-info" aria-selected="true">Edit Product Information</a>			
			<a class="nav-item nav-link <?php echo isset($show_nav_link_upload)? $show_nav_link_upload :''; ?>" id="nav-upload-tab" data-toggle="tab" href="#nav-upload" role="tab" aria-controls="nav-upload" aria-selected="false">Upload Files</a>
			
		  </div>
		</nav>
		
		<div class="tab-content mt-1" id="nav-tabContent">
			<div class="tab-pane fade <?php echo isset($show_nav_info)? $show_nav_info :''; ?>" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
				<?php echo form_hidden('form_action', 'update'); ?>
				<?php echo form_hidden('id', $row['id']); ?>
				<div class="form-group">									
					<label for="" class="">Product SKU #</label>
					<?php echo $row['product_sku']; ?>
				</div>
				
				<div class="form-group">
					<label for="product_name" class="">Product Name <span class="required">*</span></label>
					<?php echo form_input(array('name' => 'product_name', 'value' => (isset($_POST['product_name']) ? set_value('product_name') : $row['product_name']),'id' => 'product_name', 'class' => 'form-control', 'minlength' => '3', 'maxlength' => '200',));?>
					<?php echo form_error('product_name'); ?>
				</div>
				
				<div class="form-row">			
					<div class="form-group col-md-4">
						<label for="category_id" class="">Category <span class="required">*</span></label>
						<?php echo form_dropdown('category_id', $category_dropdown, (isset($_POST['category_id']) ? set_value('category_id') : $row['category_id']), array('class' =>'form-control',));?>
						<?php echo form_error('category_id'); ?>
					</div>
				
					<div class="form-group col-md-4">
						<label for="product_mrp" class="">MRP <span class="required">*</span></label>
						<?php echo form_input(array('name' => 'product_mrp','value' => (isset($_POST['product_mrp']) ? set_value('product_mrp') : $row['product_mrp']),'id' => 'product_mrp','class' => 'form-control','minlength' => '1','maxlength' => '10',));?>
						<?php echo form_error('product_mrp'); ?>
					</div>
				
					<div class="form-group col-md-4">
						<label for="product_price" class="">Price <span class="required">*</span></label>
						<?php echo form_input(array('name' => 'product_price', 'value' => (isset($_POST['product_price']) ? set_value('product_price') : $row['product_price']),'id' => 'product_price','class' => 'form-control','minlength' => '1','maxlength' => '10',));?>
						<?php echo form_error('product_price'); ?>
					</div>			
				</div>
				
				<div class="form-group">
					<label for="product_description" class="">Description <span class="required">*</span></label>
					<?php echo form_textarea(array('name' => 'product_description', 'value' => (isset($_POST['product_description']) ? set_value('product_description') : $row['product_description']), 'id' => 'product_description','class' => 'form-control','rows' => '4','cols' => '50',));?>
					<?php echo form_error('product_description'); ?> 
				</div>
				
				<div class="form-row">			
					<div class="form-group col-md-2">
						<label for="product_size" class="">Size</label>
						<?php echo form_input(array('name' => 'product_size','value' => (isset($_POST['product_size']) ? set_value('product_size') : $row['product_size']),'id' => 'product_size','class' => 'form-control','minlength' => '1','maxlength' => '5',));?>
						<?php echo form_error('product_size'); ?>
					</div>
				
					<div class="form-group col-md-2">
						<label for="product_color" class="">Color</label>
						<?php echo form_input(array('name' => 'product_color','value' => (isset($_POST['product_color']) ? set_value('product_color') : $row['product_color']),'id' => 'product_color','class' => 'form-control'));?>
						<?php echo form_error('product_color'); ?>
					</div>
				
					<div class="form-group col-md-2">
						<label for="product_weight" class="">Weight</label>
						<?php echo form_input(array('name' => 'product_weight','value' => (isset($_POST['product_weight']) ? set_value('product_weight') : $row['product_weight']),'id' => 'product_weight','class' => 'form-control'));?>
						<?php echo form_error('product_weight'); ?>
					</div>
				
					<div class="form-group col-md-2">
						<label for="product_height" class="">Height</label>
						<?php echo form_input(array('name' => 'product_height','value' => (isset($_POST['product_height']) ? set_value('product_height') : $row['product_height']),'id' => 'product_height','class' => 'form-control'));?>
						<?php echo form_error('product_height'); ?>
					</div>
				
					<div class="form-group col-md-2">
						<label for="product_width" class="">Width</label>
						<?php echo form_input(array('name' => 'product_width','value' => (isset($_POST['product_width']) ? set_value('product_width') : $row['product_width']),'id' => 'product_width','class' => 'form-control'));?>
						<?php echo form_error('product_width'); ?>
					</div>
				
					<div class="form-group col-md-2">
						<label for="product_length" class="">Length</label>
						<?php echo form_input(array('name' => 'product_length','value' => (isset($_POST['product_length']) ? set_value('product_length') : $row['product_length']),'id' => 'product_length','class' => 'form-control'));?>
						<?php echo form_error('product_length'); ?>
					</div>		
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-2">									
					<label for="product_status" class="">Status</label>
					<?php echo form_dropdown('product_status', array('Y' => 'Shown', 'N' => 'Hidden'), (isset($_POST['product_status']) ? set_value('product_status') : $row['product_status']), array('class' => 'form-control',));?>
					<?php echo form_error('product_status'); ?> 
					</div>
				</div>
				
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
				<a href="<?php echo base_url($this->router->directory.'product');?>" class="btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
				<?php echo form_close(); ?>
			</div><!--/#nav-info-->
			
			<div class="tab-pane fade <?php echo isset($show_nav_upload)? $show_nav_upload :''; ?>" id="nav-upload" role="tabpanel" aria-labelledby="nav-upload-tab">
				<div class="row">
					<div class="col-md-5">
						<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' => 'form'));?>
						<?php echo form_hidden('form_action', 'file_upload'); ?>
						<?php echo form_hidden('id', $row['id']); ?>
						
						<div class="form-group">
							<label for="" class="">Product SKU #</label>                         
							<?php echo $row['product_sku']; ?>
						</div>
						
						<div class="form-group">									
							<label for="upload_document_type_name" class="control-label">Document Type <span class="required">*</span></label>
							<?php echo form_dropdown('upload_document_type_name', $arr_upload_document_type_name, set_value('upload_document_type_name'), array('class' => 'form-control','id' => 'upload_document_type_name',));?>
							<?php echo form_error('upload_document_type_name'); ?>
						</div>
						
						<div class="form-group">								
							<label for="userfile" class="control-label">Select File</label>
							<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => '',));?>
							<?php echo form_error('userfile'); ?>
							<?php echo isset($upload_error_message) ? $upload_error_message : ''; ?>
							
							<div class="text-muted help-block small">
								<span class="font-weight-bold">pdf, doc, docx, png, jpg, jpeg</span> are allowed for docs. <span class="font-weight-bold">jpg, jpeg, png</span> are allowed for images. Maximum file size: <span class="font-weight-bold">2MB</span>
							</div>
						</div>
						<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Upload','class' => 'btn btn-primary'));?>
						<?php echo form_close(); ?>
					</div>
					
					<div class="col-md-7">
						<h6 class="">Uploaded Files</h6>
						<?php
                        //print_r($all_uploads);
                        ?>
                        <?php
                        if (isset($all_uploads) && sizeof($all_uploads) > 0) {
                            foreach ($all_uploads as $key => $upload) {
                                echo '<div class="file-container row" id="upload_grid_' . $upload['id'] . '">';
                                echo '<div class="col-md-4">';
                                echo strtoupper($upload['upload_document_type_name']);
                                echo '</div>';
                                echo '<div class="col-md-6">';
                                //echo $upload['upload_file_name'];
                                $file_path = 'assets/uploads/'.$upload_object_name.'/' . $row['id'] . '/' . $upload['upload_file_name'];
                                if (file_exists(FCPATH . $file_path)) {
                                    $file_src = base_url($file_path);
                                    echo '<a href="' . $file_src . '" title="' . $upload['upload_document_type_name'] . '" target="_blank">' . $upload['upload_file_name'] . '</a>';
                                } else {
                                    $file_src = '';
                                    echo 'File not found';
                                }

                                echo '</div>';
                                echo '<div class="col-md-2">';
                                echo '<a href="#" class="btn btn-sm btn-danger btn-delete-file" data-confirmation="1" data-confirmation-message="Are you sure, you want to delete this?" data-upload_id="' . $upload['id'] . '" title="Delete ' . $upload['upload_document_type_name'] . '" data-path="' . $file_path . '">Delete</a>';
                                echo '</div>';
                                echo '</div>';                                
                            }
                        } else {
                            echo '<div class="col-md-12 text-center">No uploads found</div>';
                        }
                        ?>
					</div>
				</div>
			</div><!--/#nav-upload-->
		</div><!--/#nav-tabContent-->
	</div>
</div><!--/.row-->