<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!

$messages = array();

// Set maximum file size for uploaded files.
// MAX_FILE_SIZE must be set to bytes
// 1 MB = 1000000 bytes
const MAX_FILE_SIZE = 1000000;

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
    //insert into images table
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

    //insert into image_tags table

      //insert tag that is useruploaded
    $sql = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, 5);";
    $params = array(
      ':image_id' => $last_id
    );
    $result = exec_sql_query($db, $sql, $params);

      //insert other tags
    if ( isset($_POST["breakfast_tag"]) ){
      $sql = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, 1);";
      $params = array(
        ':image_id' => $last_id
      );
      $result = exec_sql_query($db, $sql, $params);
    }
    if ( isset($_POST["lunch_tag"]) ){
      $sql = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, 2);";
      $params = array(
        ':image_id' => $last_id
      );
      $result = exec_sql_query($db, $sql, $params);
    }
    if ( isset($_POST["dinner_tag"]) ){
      $sql = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, 3);";
      $params = array(
        ':image_id' => $last_id
      );
      $result = exec_sql_query($db, $sql, $params);
    }
    if ( isset($_POST["snacks_tag"]) ){
      $sql = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, 4);";
      $params = array(
        ':image_id' => $last_id
      );
      $result = exec_sql_query($db, $sql, $params);
    }
    if ( isset($_POST["15mins_tag"]) ){
      $sql = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, 6);";
      $params = array(
        ':image_id' => $last_id
      );
      $result = exec_sql_query($db, $sql, $params);
    }
    if ( isset($_POST["other_tag"]) && isset($_POST["other_check"])){
      //insert into tags table
      $sql_1 = "INSERT INTO tags (tag) VALUES (:image_tag);";

      $image_tag = filter_input(INPUT_POST, 'other_tag', FILTER_SANITIZE_STRING);
      $params = array(
        ':image_tag' => $image_tag
      );
      //$result = exec_sql_query($db, $sql, $params);
      echo "hi";

      $last_id = $db->lastInsertId("id");
      echo $last_id;
      echo $last_img_id;

      //insert into image_tags table
      $sql_2 = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_tag, 12);";
      echo $last_tag_id;
      $params_2 = array(
        ':image_id' => $last_img_id,
        ':tag_id' => $last_tag_id
      );

      // $result = exec_sql_query($db, $sql_2, $params_2);
    }
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

    <form id="tag_sort" method="post" action="photo.php" enctype="multipart/form-data">
        <label>Tags:</label>
        <input type="checkbox" name="breakfast" value="breakfast"><p>Breakfast</p>
        <input type="checkbox" name="lunch" value="lunch"><p>Lunch</p>
        <input type="checkbox" name="dinner" value="dinner"><p>Dinner</p>
        <input type="checkbox" name="snacks" value="snacks"><p>Snacks & Desserts</p>
        <input type="checkbox" name="15" value="15"><p>15 Min or Less</p>
        <input type="checkbox" name="user" value="user"><p>User Uploaded</p>
        <input class="submit_tags" type="submit" value="Sort" name="submit"/>
    </form>

    <!-- tag submit -->
    <?php
    if ( isset($_POST["submit"]) ){
      $select = '';
      $num_tags = FALSE;
      if( isset($_POST["breakfast"]) ){
        $num_tags = TRUE;
        $select = "tag = 'breakfast'";
      }
      if( isset($_POST["lunch"]) ){
        if($num_tags){
          $select = $select . " OR tag = 'lunch'";
        }
        else{
          $select = $select . "tag = 'lunch'";
          $num_tags = TRUE;
        }
      }
      if( isset($_POST["dinner"]) ){
        if($num_tags){
          $select = $select . " OR tag = 'dinner'";
        }
        else{
          $select = $select . "tag = 'dinner'";
          $num_tags = TRUE;
        }
      }
      if( isset($_POST["snacks"]) ){
        if($num_tags){
          $select = $select . " OR tag = 'snacks'";
        }
        else{
          $select = $select . "tag = 'snacks'";
          $num_tags = TRUE;
        }
      }
      if( isset($_POST["user_uploaded"]) ){
        if($num_tags){
          $select = $select . " OR tag = 'user_uploaded'";
        }
        else{
          $select = $select . "tag = 'user_uploaded'";
          $num_tags = TRUE;
        }
      }
      if( isset($_POST["15"]) ){
        if($num_tags){
          $select = $select . " OR tag = '15mins'";
        }
        else{
          $select = $select . "tag = '15mins'";
          $num_tags = TRUE;
        }
      }

      $records = exec_sql_query(
        $db,
        "SELECT * FROM images WHERE id IN (SELECT image_id FROM image_tags WHERE image_tags.tag_id IN (SELECT tags.id FROM tags WHERE $select))",
      array())->fetchAll();

    }
    else{
      $records = exec_sql_query(
        $db,
        "SELECT * FROM images",
        array())->fetchAll();
    }

    ?>
    <div class = "gallery">

        <?php

        foreach($records as $record){
            ?>
          <div class = "pic_gallery">
          <a href= <?php echo "recipe.php?" . http_build_query( array( 'id' => $record['id'], 'source' => $record['source'], 'recipe_name' => $record['recipe_name'] ) );?>>
            <img
              src = <?php echo "uploads/images/" . $record["id"] . "." . $record["file_ext"]; ?>
              alt="An image of <?php echo $record['recipe_name']; ?>";
            >
          </a>

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

    if ( is_user_logged_in() ){
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
                <p class="form_tag"><input type="checkbox" value="breakfast" name="breakfast_tag">Breakfast</p>
                <p class="form_tag"><input type="checkbox" value="lunch" name="lunch_tag">Lunch</p>
                <p class="form_tag"><input type="checkbox" value="dinner" name="dinner_tag">Dinner</p>
                <p class="form_tag"><input type="checkbox" value="snacks" name="snacks_tag">Snacks & Desserts</p>
                <p class="form_tag"><input type="checkbox" value="15mins" name="15mins_tag">15 Mins or Less</p>
                <p class="form_tag"><input type="checkbox" value="other" name="other_check">Other:  <input type="text" name="other_tag"></p>
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
