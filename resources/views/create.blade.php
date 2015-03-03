<html>
<head>
	<title>Create a DVD</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  

	<style type="text/css">
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

		<h3 class = "text-center">Create a DVD</h3>
		<form role="form" action="/dvds/" method="post">

			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

			<div class="form-group">
				<label>Title</label>
				<input name="title" class="form-control">
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

			<div class="form-group">
				<label>Rating</label>
				<select class="form-control" name="rating">
					@foreach ($ratings as $rating)
						<option value="{{$rating->id}}" selected>  
							{{$rating->rating_name}}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>Format</label>
				<select class="form-control" name="format">
					@foreach ($formats as $format)
						<option value="{{$format->id}}" selected>  
							{{$format->format_name}}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>Label</label>
				<select class="form-control" name="label">
					@foreach ($labels as $label)
						<option value="{{$label->id}}" selected>  
							{{$label->label_name}}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>Sound</label>
				<select class="form-control" name="sound">
					@foreach ($sounds as $sound)
						<option value="{{$sound->id}}" selected>  
							{{$sound->sound_name}}
						</option>
					@endforeach
				</select>
			</div>


			<button type="submit" class="btn btn-default btn-lg">
					Submit
			</button>

		</form>

		<br>

		@if (Session::has('success'))
			<p class = "bg-success"> {{ Session::get('success') }}</p>
		@endif

		@foreach ($errors->all() as $errorMessage)
			<p class = "bg-danger"> {{ $errorMessage }} </p>
		@endforeach

	</div>

</body>
</html>