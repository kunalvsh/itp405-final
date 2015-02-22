<!DOCTYPE html>
<html>
    <head>
        <title>DVD Results Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="content">

                <h1 class="text-center">DVD Results for "<?php echo $title ?>"</h1>
                <h3 class="text-center">Genre: <?php echo $genre ?>, Rating: <?php echo $rating ?> </h3>
                <div class="results">
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
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($dvds as $dvd) : ?>
                                <tr>
                                  <td><?php echo $dvd->title ?></td>
                                  <td><?php echo $dvd->rating_name ?></td>
                                  <td><?php echo $dvd->genre_name ?></td>
                                  <td><?php echo $dvd->label_name ?></td>
                                  <td><?php echo $dvd->sound_name ?></td>
                                  <td><?php echo $dvd->format_name ?></td>
                                  <td><?php echo DATE_FORMAT(new DateTime($dvd->release_date), 'm-d-Y') ?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>

                        </table>
                </div>
            </div>
        </div>
    </body>
</html>