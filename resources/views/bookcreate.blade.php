<html>
<head>
	<title>Add a Book</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/landing-page.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


	<script type="text/javascript">
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();   
	});
	</script>

	<style type="text/css">

		body,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
		    font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
		    font-weight: 700;
    		color: #f8f8f8;
    		text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
		}

		body {
			background: url(../img/main-bg.jpg) no-repeat center center;
			background-size: cover;
		}

		.error {
			color: red;
		}
		.container{
			width: 800px;
			margin: 0 auto;
		}

		.success {
			color: green;
		}

	</style>

</head>
<body>
	
	<div class="container">

		<h1 class = "text-center">Add a Book</h1>
		<form role="form" action="/books/create" method="post">

			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

			<div class="form-group">
				<label>Title</label>
				<input name="title" class="form-control">
			</div>

			<div class="form-group">
				<label>Author</label>
				<input name="author" class="form-control">
			</div>

			<div class="form-group">
				<label>Publication Year</label>
				<input type="number" name="publication_date" type="number" class="form-control">
			</div>

			<div class="form-group">
				<label>Genre</label>
				<select class="form-control" name="genre">
					@foreach ($genres as $genre)
						<option value="{{$genre->id}}" selected>  
							{{$genre->genre_name}}
						</option>
					@endforeach
				</select>
			</div>

			<input type="submit" value="Submit" class="btn btn-primary">
			<a href="/dashboard" class="btn btn-primary">Back to Home</a>


		</form>

		<br>

		@if (Session::has('success'))
			<p class = "success"> {{ Session::get('success') }} <a href="/dashboard">Back to Home.</a></p>
		@endif

		@foreach ($errors->all() as $errorMessage)
			<p class = "error"> {{ $errorMessage }} </p>
		@endforeach

	</div>


	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.js"></script>


</body>
</html>