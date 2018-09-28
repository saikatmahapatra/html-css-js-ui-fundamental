<!DOCTYPE html>
    <head>
        <?php echo $el_html_head; ?>
        <!-- Customized Boostrap Theme CSS -->
        <link href="<?php echo base_url('assets/dist/css/styles.css');?>" rel="stylesheet">
        <!-- Font Awesome Icons -->        
        <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
		
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?>"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?>"></script>
        <![endif]-->
    </head>

    <body data-controller="<?php echo $this->router->class; ?>" data-method="<?php echo $this->router->method; ?>">
        
		<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">            
			<?php echo $el_navbar; ?>
        </nav>		
		
		<main role="main">
		  <!-- Main jumbotron for a primary marketing message or call to action -->
		  <div class="jumbotron">
			<div class="container">
			  <h1 class="display-3">Hello, world!</h1>
			  <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
			  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
			</div>
		  </div>

		  <div class="container">
			<?php echo $maincontent; ?>			
		  </div> <!-- /container -->
		</main>
		
		<footer class="footer">
            <?php echo $el_footer; ?>
        </footer>

        <button class="btn btn-primary scrollup" data-toggle="tooltip" data-placement="left" data-original-title="Scroll to top"><i aria-hidden="true" class="fa fa-arrow-up"></i></button>
		<div class="ajax-loader-ui" id="ajax-loader" style="display:none;"><img src="<?php echo base_url('assets/src/img/ajax-loader.svg');?>" class="ajax-loader-img" alt="Loading..."></div>
	
		<!-- jQuery -->    
        <script type="text/javascript" src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js'); ?>"></script>
        <!-- Bootstrap dependency popper.js -->
        <script src="<?php echo base_url('assets/vendors/popper.js/dist/umd/popper.min.js'); ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>                       
		<!-- Pace JS for page load progress -->
		<script src="<?php echo base_url('assets/vendors/pace-js/pace.min.js'); ?>"></script>
        <!--Application Specific JS Loading Through Controllers-->
        <?php echo isset($app_js) ? $app_js : ''; ?>
    </body>
</html>
