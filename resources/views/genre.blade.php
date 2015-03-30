<!doctype html>
<html>
<head>
	<title><?php echo ucfirst($genre_name) ?> DVDs</title>
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
	<h2 class = "text-center"><?php echo ucfirst($genre_name) ?> DVDs</h2>

	<div class = "container">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Title</th>
					<th>Rating</th>
					<th>Genre</th>
					<th>Label</th>				
				</tr>
			</thead>
			<tbody>
				@foreach ($dvds as $dvd)
				<tr>
					<td>{{ $dvd->title }}</td>
					<td>{{ $dvd->genre->genre_name }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</dvd>

	<!-- 
					<td>{{ $dvd->label->label_name }}</td>
					<td>{{ $dvd->rating->rating_name }}</td>
	 -->
</body>
</html>