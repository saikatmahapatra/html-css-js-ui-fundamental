<div class="row">
    <div class="col-md-12">
        <h3>Welcome to <?php echo $this->config->item('app_html_title'); ?></h3>        
		<a href="<?php echo base_url($this->router->directory.'user/create_account');?>" class="btn btn-info">Create an account</a>        
		<a href="<?php echo base_url($this->router->directory.'user/login');?>" class="btn btn-info">Login</a>
    </div>
</div>