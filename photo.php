<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!

$messages = array();

// Set maximum file size for uploaded files.
// MAX_FILE_SIZE must be set to bytes
// 1 MB = 1000000 bytes
const MAX_FILE_SIZE = 1000000;
$user = $username;

// Users must be logged in to upload files!
if ( isset($_POST["submit_upload"]) && is_user_logged_in() ) {

  // TODO: filter input for the "box_file" and "description" parameters.
  // Hint: filtering input for files means checking if the upload was successful
  $upload_info = $_FILES["pic_file"];
  //
  //
  //need to filter !!!!!!!!
  $recipe_name = $_POST["recipe_name"];
  $source = $_POST["source"];

  // TODO: If the upload was successful, record the upload in the database
  // and permanently store the uploaded file in the uploads directory.
  if($upload_info['error'] == 0){
    $basename = basename($upload_info["name"]);
    $upload_ext = strtolower( pathinfo($basename, PATHINFO_EXTENSION) );
    $sql = "INSERT INTO images (user_id, file_name, file_ext, recipe_name, source) VALUES (:current_user, :basename, :upload_ext, :recipe_name, :source);";

    $params = array(
      ':current_user' => $current_user["id"],
      ':basename' => $basename,
      ':upload_ext' => $upload_ext,
      ':recipe_name' => $recipe_name,
      ':source' => $source
    );

    $result = exec_sql_query($db, $sql, $params);
    $last_id = $db->lastInsertId("id");
    move_uploaded_file( $_FILES["pic_file"]["tmp_name"], "uploads/images/$last_id.$upload_ext" );
  }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="styles/all.css" type="text/css" rel="stylesheet">
  <title>Photo Gallery</title>
</head>

<body>
    <?php include("includes/header.php"); ?>

    <h1 class = "photo_h1">HEALTHY & EASY Recipes Photo Gallery!</h1>

    <form id="tag_sort" method="post" action="photo.php">
        <label>Tags:</label>
        <input type="checkbox" name="breakfast" value="breakfast"><p>Breakfast</p>
        <input type="checkbox" name="lunch" value="lunch"><p>Lunch</p>
        <input type="checkbox" name="dinner" value="dinner"><p>Dinner</p>
        <input type="checkbox" name="snacks" value="snacks"><p>Snacks & Desserts</p>
        <input type="checkbox" name="snacks" value="snacks"><p>User Uploaded</p>

        <input class="submit_tags" type="submit" value="Sort" name="submit"/>
    </form>



      <?php
        $records = exec_sql_query(
          $db,
          "SELECT * FROM images",
          array())->fetchAll();

          ?>
          <div class = "gallery">

          <?php

          foreach($records as $record){
              ?>
            <div class = "pic_gallery">
              <img
                src = <?php echo "uploads/images/" . $record["id"] . "." . $record["file_ext"]; ?>
                alt="An image of <?php echo $record['recipe_name']; ?>";
              >
              <?php
                if(isset($record['source'])){
                  ?>
                  <a href = <?php echo $record['source']; ?> class = "source">Source</a>
                  <?php
                }
              ?>
            </div>
            <?php
          }

          ?>
          </div>





    <?php
    if ( is_user_logged_in()){
        foreach ($messages as $message) {
            echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
        }
        ?>
        <form id="pic_form" method="post" action="photo.php" enctype="multipart/form-data">
        <fieldset>

            <legend>Welcome! Did you make one of the HEALTHY & EASY recipes?? Submit a picture!</legend>
            <ul>
            <li>
                <!-- MAX_FILE_SIZE must precede the file input field -->
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />

                <label for="pic_file" class="text_label">Upload File:</label>
                <input id="pic_file" type="file" name="pic_file">
            </li>
            <li>
                <label for="recipe_name" class="text_label">Recipe Name:</label>
                <input id="recipe_name" type="text" name="recipe_name">
            </li>
            <li>
                <label class="text_label">Tags:</label>
                <p class="form_tag"><input type="checkbox" value="breakfast">Breakfast</p>
                <p class="form_tag"><input type="checkbox" value="lunch">Lunch</p>
                <p class="form_tag"><input type="checkbox" value="dinner">Dinner</p>
                <p class="form_tag"><input type="checkbox" value="snacks">Snacks & Desserts</p>
                <p class="form_tag"><input type="checkbox" value="other">Other:  <input type="text"></p>
            </li>
            <li>
                <button name="submit_upload" type="submit">Upload File</button>
            </li>
            </ul>
        </fieldset>
        </form>
        <?php
    } else {
        ?>
        <?php
        include("includes/login.php");
    }
    ?>

    <?php include("includes/footer.php"); ?>
</body>
</html>
