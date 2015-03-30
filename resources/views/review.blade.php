<!DOCTYPE html>
<html>
<head>
	<title>DVD Details</title>

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

<h3 class="text-center">DVD Info </h3>

<div class="container">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>Title</th>
                                  <th>Rating</th>
                                  <th>Genre</th>
                                  <th>Label</th>
                                  <th>Sound</th>
                                  <th>Format</th>
                                  <th>Release Date</th>
                                  @if ($foundRotten === 1)
                                  <th>Critic Score</th>
                                  <th>Audience Score</th>
                                  <th>Poster</th>
                                  <th>Runtime</th>
                                  <th>Abridged Cast</th>
                                  @endif
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                  <td><?php echo $dvd->title ?></td>
                                  <td><?php echo $dvd->rating_name ?></td>
                                  <td><?php echo $dvd->genre_name ?></td>
                                  <td><?php echo $dvd->label_name ?></td>
                                  <td><?php echo $dvd->sound_name ?></td>
                                  <td><?php echo $dvd->format_name ?></td>
                                  <td><?php echo DATE_FORMAT(new DateTime($dvd->release_date), 'm-d-Y') ?></td>
                                  @if ($foundRotten === 1)
                                  <td><?php echo $rottenDetails->ratings->critics_score;?>%</td>
                                  <td><?php echo $rottenDetails->ratings->audience_score;?>%</td>
                                  <td><img src = "<?php echo $rottenDetails->posters->thumbnail;?>"></td>
                                  <td><?php echo $rottenDetails->runtime;?></td>
                                  <td>
                                  	@foreach ($rottenDetails->abridged_cast as $cast)
                                  		<?php echo $cast->name; ?><br>
                                  	@endforeach
                                  </td>
                                  @endif
                                </tr>
                            </tbody>

                        </table>
</div>
 

<div class="container">
<h3 class="text-center"> Reviews </h3>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Rating</th>
			<th>Title</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($reviews as $review): ?>
			<tr>
				<td><?php echo $review->rating ?></td>
				<td><?php echo $review->title ?></td>
				<td><?php echo $review->description ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
<br>
<br>

<?php foreach ($errors->all() as $errorMessage): ?>
	<p class="text-center error"> <?php echo $errorMessage; ?></p>
<?php endforeach; ?>

<?php if (Session::has('success')): ?>
	<p class ="text-center success"><?php echo Session::get('success'); ?></p>
<?php endif; ?>


<h3 class="text-center">Write a review</h3>
<div class="container">
<form method="post" action="<?php echo url("dvds") ?>" >
	<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
	<input type="hidden" name="dvd_id" value="<?php echo $dvd->dvd_id ?>">


	<div class="form-group">
		<label>Rating (must be from 1–10)</label><br>
		<input class="form-control" type="number" name="rating" min="1" max="10">
	</div>

	<div class="form-group">
		<label>Title (must be at least 5 characters)</label><br>
		<input class="form-control" type="text" name="title">
	</div>

	<div class="form-group">
		<label>Description (must be at least 20 characters)</label><br>
		<textarea class="form-control" type="text" name="description"></textarea>
	</div>

	<button type="submit" class="btn btn-default btn-lg">
			Submit
	</button>

</form>
</div>

</body>

</html>