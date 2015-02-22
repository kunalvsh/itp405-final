<!DOCTYPE html>
<html>
    <head>
        <title>Dvd Search Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">


    </head>
    <body>

        <div class="container">
            <div class="content">
                <div class="dvd-container">
                    <h1 class="text-center">Search for a Movie</h1>

                    <form action="/dvds" method="get">
                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input class="form-control" type="text" name="title" value="">
                        </div>

                        <div class="form-group">
                            <label for="genre">Genre: </label>
                            <select class="form-control" name="genre">
                                <option value="all" selected>All</option>
                                <?php foreach ($genres as $genre) : ?>
                                    <option value="<?php echo $genre->id ?>"><?php echo $genre->genre_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating: </label>
                            <select class="form-control" name="rating">
                                <option value="all" selected>All</option>
                                <?php foreach ($ratings as $rating) : ?>
                                    <option value="<?php echo $rating->id ?>"><?php echo $rating->rating_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="button" class="btn btn-default btn-lg">
                          <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>