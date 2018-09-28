<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading : 'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7"></div>
</div><!--/.heading-container-->

<div class="row">
    <div class="col-md-12">
        <div class="h4 alert alert-danger">
            <i class="icon fa fa-warning" aria-hidden="true"></i> You are not authorized to access the page.
        </div>
		<a href="<?php echo base_url($this->router->directory.'user/login');?>" class="btn btn-primary">Please login to continue...</a>        
    </div>
</div>