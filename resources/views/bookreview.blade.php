<!DOCTYPE html>
<html>
<head>
	<title>Book Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">  

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/landing-page.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


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
	        background: url(../img/main-bg.jpg) no-repeat;
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

<h1 class="text-center">Book Info </h1>

<div class="container">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th>Title</th>
                                  <th>Author</th>
                                  @if ($foundGood === 1)
                                  <th>Pub. Date</th>
                                  <th>Cover</th>
                                  <th>Avg. Rating</th>
                                  @endif
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                  <td><?php echo $book->title ?></td>
                                  <td><a href = "http://goodreads.com/book/author/<?php echo $book_author;?>"><?php echo $book->author ?></td>
                                  @if ($foundGood === 1)
                                  <td><?php echo $book_year ?></td>
                                  <td><img src = "<?php echo $book_img;?>"></td>
                                  <td><?php echo $book_avg_rating;?></td>
                                  @endif
                                </tr>
                            </tbody>

                        </table>
</div>
 

<div class="container">
<h3 class="text-center"> Reviews </h3>
<table class="table table-bordered">
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
<form method="post" action="<?php echo url("books") ?>" >
	<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
	<input type="hidden" name="book_id" value="<?php echo $book->book_id ?>">


	<div class="form-group">
		<label>Rating (must be from 1–5)</label><br>
		<input class="form-control" type="number" name="rating" min="1" max="5">
	</div>

	<div class="form-group">
		<label>Title (must be at least 5 characters)</label><br>
		<input class="form-control" type="text" name="title">
	</div>

	<div class="form-group">
		<label>Description (must be at least 20 characters)</label><br>
		<textarea class="form-control" type="text" name="description"></textarea>
	</div>

	<input type="submit" value="Submit" class="btn btn-primary">
	<a href="/dashboard" class="btn btn-primary">Back to Home</a>


</form>
</div>

</body>

</html>