<!DOCTYPE html>
<html>
    <head>
        <title>Book Search Page</title>
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
                color: black;
            }

        </style>
    </head>
    <body>


    <div class="container">
                <h1 class="text-center">Search for a Book</h1>

                    <form role="form" action="/books" method="get">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" value="">
                        </div>

                        <div class="form-group">
                            <label>Author</label>
                            <input class="form-control" type="text" name="author" value="">
                        </div>

                        <div class="form-group">
                            <label>Genre</label>
                            <select class="form-control" name="genre">
                                <option value="all" selected>All</option>
                                <?php foreach ($genres as $genre) : ?>
                                    <option value="<?php echo $genre->id ?>"><?php echo $genre->genre_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <input type="submit" value="Search" class="btn btn-primary">
                        <a href="/dashboard" class="btn btn-primary">Back to Home</a>


                    </form>

                    <br>
        </div>


    </body>
</html>