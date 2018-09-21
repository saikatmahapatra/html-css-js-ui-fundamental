<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>CKEditor Demo</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/styles_bootstrap.css" rel="stylesheet">
</head>

<body>

    <main class="container">
		<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
    </main>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="assets/vendors/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script>
        //Document Ready
        $(initDOM);
		function initDOM(){
			$('[data-toggle="tooltip"]').tooltip();
		}
		
		ClassicEditor
				.create( document.querySelector( '#description' ), {
        ckfinder: {
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        }
    })
				.then( editor => {
					console.log( editor );
				} )
				.catch( error => {
					console.error( error );
				} );
		
    </script>
</body>

</html>