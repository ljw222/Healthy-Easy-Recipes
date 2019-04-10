<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!

$messages = array();

// Set maximum file size for uploaded files.
// MAX_FILE_SIZE must be set to bytes
// 1 MB = 1000000 bytes
const MAX_FILE_SIZE = 1000000;

if( isset($_POST['delete_image']) ){
  //delete from images
  $img_to_delete = $_GET['img_to_delete'];
  $file_extension = $_GET['file_extension'];
  $sql = "DELETE FROM images WHERE id = :img_to_delete;";
  $params = array(
    ':img_to_delete' => $img_to_delete
  );
  $result = exec_sql_query($db, $sql, $params);

  //delete from image tags
  $sql = "DELETE FROM image_tags WHERE image_id = :img_to_delete;";
  $params = array(
    ':img_to_delete' => $img_to_delete
  );
  $result = exec_sql_query($db, $sql, $params);

  //unlink from uploads/images folder
  unlink('uploads/images/'. $img_to_delete . '.' . $file_extension);
}

// Users must be logged in to upload files!
if ( isset($_POST["submit_upload"]) && is_user_logged_in() ) {

  // TODO: filter input for the "box_file" and "description" parameters.
  // Hint: filtering input for files means checking if the upload was successful
  $upload_info = $_FILES["pic_file"];
  $recipe_name = filter_input(INPUT_POST, "recipe_name", FILTER_SANITIZE_STRING);
  $source = filter_input(INPUT_POST, "source", FILTER_SANITIZE_STRING);
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

   //insert other tags
    $tags = exec_sql_query(
    $db,
    "SELECT * FROM tags",
    array())->fetchAll();
    foreach($tags as $tag){
      if ( isset($_POST[$tag[tag] . "_tag"]) ){
        $sql = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, :tag_id);";
        $params = array(
          ':image_id' => $last_id,
          'tag_id' => $tag['id']
        );
        $result = exec_sql_query($db, $sql, $params);
      }
    }

      if ( isset($_POST["other_tag"]) && isset($_POST["other_check"]) ){
        //insert into tags table
        $last_img_id = $last_id;
        $image_tag = filter_input(INPUT_POST, 'other_tag', FILTER_SANITIZE_STRING);

        $sql_1 = "INSERT INTO tags (tag) VALUES (:image_tag);";

        $params_1 = array(
          ':image_tag' => $image_tag
        );
        $result = exec_sql_query($db, $sql_1, $params_1);

        $last_id = $db->lastInsertId("id");

        //insert into image_tags table
        $sql_2 = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, :tag_id);";
        $params_2 = array(
          ':image_id' => $last_img_id,
          ':tag_id' => $last_id
        );

        $result = exec_sql_query($db, $sql_2, $params_2);
      }



  }
    }
function print_tags($tag_name){
  if($tag_name == 'breakfast'){
    echo 'Breakfast';
  }
  else if($tag_name == 'lunch'){
    echo 'Lunch';
  }
  else if($tag_name == 'dinner'){
    echo 'Dinner';
  }
  else if($tag_name == 'snacks'){
    echo 'Snacks & Desserts';
  }
  else if($tag_name == '15mins'){
    echo '15 Mins or Less';
  }
  else if($tag_name == 'user_uploaded'){
    echo 'User Uploaded';
  }
  else{
    echo htmlspecialchars($tag_name);
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

    <?php
      $tags = exec_sql_query(
        $db,
        "SELECT tag FROM tags",
        array())->fetchAll();
    ?>

     <form id="tag_sort" method="post" action="photo.php" enctype="multipart/form-data">
        <select name="selected_tag">

        <?php
        foreach($tags as $tag){
          ?><option id=<?php echo $tag[0];?> value=<?php echo $tag[0];?>><?php print_tags($tag[0]) ?><?php
        }
        ?>
        </select>
        <input class="submit_tags" type="submit" value="Sort" name="tag_sort"/>
      </form>

      <?php
      if( isset($_POST['tag_sort']) ){
          $selected_tag = $_POST['selected_tag'];
          $records = exec_sql_query(
            $db,
            "SELECT * FROM images WHERE id IN (SELECT image_id FROM image_tags WHERE tag_id IN (SELECT id FROM tags WHERE tag = '$selected_tag'));",
          array())->fetchAll();
      }
      else{
        $records = exec_sql_query(
          $db,
          "SELECT * FROM images",
        array())->fetchAll();
      }
    ?>

    <?php

    ?>
    <div class = "gallery">
        <?php

        foreach($records as $record){
          ?>
          <div class = "pic_gallery">
          <a href= "<?php echo "recipe.php?" . http_build_query( array( 'id' => $record['id'], 'source' => $record['source'], 'recipe_name' => $record['recipe_name'], 'user_id' => $record["user_id"], 'current_user_id' => $current_user["id"], 'file_extension' => $record["file_ext"]) ) ;?>">
            <img
              src = <?php echo "uploads/images/" . htmlspecialchars($record["id"]) . "." . htmlspecialchars($record["file_ext"]); ?>
              alt="An image of <?php echo htmlspecialchars($record['recipe_name']); ?>"
            >
          </a>

            <?php
              if( isset($record['source']) ){
                ?>
                <a href = "<?php echo htmlspecialchars($record['source']); ?>" class = "source">Source</a>
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
              <?php
                $tags = exec_sql_query(
                  $db,
                  "SELECT tag FROM tags",
                  array())->fetchAll();
              ?>
              <label class="text_label">Tags:</label>
              <?php
                foreach($tags as $tag){
                  ?><p class="form_tag"><input type="checkbox" value= <?php echo $tag[0];?> name=<?php echo $tag[0] . "_tag";?>><?php print_tags($tag[0]); ?></p><?php
                }
              ?>
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
