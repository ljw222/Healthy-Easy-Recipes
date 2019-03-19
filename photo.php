<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="styles/all.css" type="text/css" rel="stylesheet">
  <title>Lunch</title>
</head>

<body>
    <?php include("includes/header.php"); ?>

    <h1 class = "photo_h1">HEALTHY & EASY Recipes Photo Gallery!<h1>

    <form id="tag_sort" method="post" action="photo.php">
        <label>Tags:</label>
        <input type="checkbox" name="breakfast" value="breakfast"><p>Breakfast</p>
        <input type="checkbox" name="lunch" value="lunch"><p>Lunch</p>
        <input type="checkbox" name="dinner" value="dinner"><p>Dinner</p>
        <input type="checkbox" name="snacks" value="snacks"><p>Snacks & Desserts</p>
        <input type="checkbox" name="snacks" value="snacks"><p>User Uploaded</p>

        <input class="submit_tags" type="submit" value="Sort" name="submit"/>
        </fieldset>
    </form>

    <form id="pic_form" method="post" action="photo.php">
        <fieldset>
            <legend>Did you make one of the HEALTHY & EASY recipes?? Login, and submit a picture!</legend>

        </fieldset>
    </form>

    <?php include("includes/footer.php"); ?>
</body>
</html>
