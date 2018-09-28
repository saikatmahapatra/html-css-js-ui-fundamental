<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header">Welcome to <?php echo $this->config->item('app_html_title'); ?></h1>
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

<!-- Example row of columns -->
<div class="row">
  <div class="col-md-4">
	<h2>Heading</h2>
	<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
	<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
  </div>
  <div class="col-md-4">
	<h2>Heading</h2>
	<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
	<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
  </div>
  <div class="col-md-4">
	<h2>Heading</h2>
	<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
	<p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
  </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card text-center">
            <div class="card-header bg-dark text-white">
                Header
            </div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                    type and scrambled it to make a type specimen book.</p>
                <a href="#" class="btn btn-primary">Action</a>
            </div>
            <div class="card-footer text-muted">
                21 min ago
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card text-center">
            <div class="card-header bg-warning text-white">
                Header
            </div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                    type and scrambled it to make a type specimen book.</p>
                <a href="#" class="btn btn-primary">Action</a>
            </div>
            <div class="card-footer text-muted">
                21 min ago
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card text-center">
            <div class="card-header bg-primary text-white">
                Header
            </div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                    type and scrambled it to make a type specimen book.</p>
                <a href="#" class="btn btn-primary">Action</a>
            </div>
            <div class="card-footer text-muted">
                21 min ago
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card text-center">
            <div class="card-header bg-danger text-white">
                Header
            </div>
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                    type and scrambled it to make a type specimen book.</p>
                <a href="#" class="btn btn-primary">Action</a>
            </div>
            <div class="card-footer text-muted">
                21 min ago
            </div>
        </div>
    </div>
</div>