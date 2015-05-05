<!DOCTYPE html>
<html>
    <head>
        <title>Book Results Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

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
                padding-top: 20px; /* If you're making other pages, make sure there is 50px of padding to make sure the navbar doesn't overlap content! */
                font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
                font-weight: 700;
                color: #f8f8f8;
            }

            body {
              background: url(../img/main-bg.jpg) center center;
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
              color: black;
            }

          </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="results">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th>Title</th>
                                  <th>Author</th>
                                  <th>Publication Year</th>
                                  <th>Details</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($books as $book) : ?>
                                <tr>
                                  <td><?php echo $book->title ?></td>
                                  <td><?php echo $book->author ?></td>
                                  <td><?php echo $book->publication_date ?></td>
                                  <td><a href="/books/<?php echo $book->book_id ?>">Details</a></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>

                        </table>
                </div>
                <a href="/dashboard" class="btn btn-primary">Back to Home</a>

            </div>
        </div>
    </body>
</html>