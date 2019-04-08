<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
    $current_user_id = filter_input(INPUT_GET, 'current_user_id', FILTER_VALIDATE_INT);
    $source = filter_input(INPUT_GET, 'source', FILTER_SANITIZE_STRING);
    $recipe_name = filter_input(INPUT_GET, 'recipe_name', FILTER_SANITIZE_STRING);
    $file_extension = filter_input(INPUT_GET, 'file_extension', FILTER_SANITIZE_STRING);

    function print_tags($tag){
        if($tag['tag'] == 'breakfast'){
            ?> <li> <?php echo "Breakfast"; ?> </li> <?php
        }
        else if($tag['tag'] == 'lunch'){
            ?> <li> <?php echo "Lunch"; ?> </li> <?php
        }
        else if($tag['tag'] == 'dinner'){
            ?> <li> <?php echo "Dinner"; ?> </li> <?php
        }
        else if($tag['tag'] == 'snacks'){
            ?> <li> <?php echo "Snacks & Desserts"; ?> </li> <?php
        }
        else if($tag['tag'] == '15mins'){
            ?> <li> <?php echo "15 Min or Less"; ?> </li> <?php
        }
        else if($tag['tag'] == 'user_uploaded'){
            ?> <li> <?php echo "User Uploaded"; ?> </li> <?php
        }
        else{
            ?> <li> <?php echo htmlspecialchars($tag['tag']); ?> </li> <?php
        }
    }

    if( isset($_POST["submit_tag"]) ){
        //insert into image_tags table

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
        if ( isset($_POST["other_tag"]) && isset($_POST["other_check"]) ){
            //insert into tags table
            $last_img_id = $last_id;

            $sql_1 = "INSERT INTO tags (tag) VALUES (:image_tag);";

            $image_tag = filter_input(INPUT_POST, 'other_tag', FILTER_SANITIZE_STRING);
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

    <div id="content-wrap">


        <h2><?php echo htmlspecialchars($recipe_name) ?></h2>

        <figure>
            <img src="uploads/images/<?php echo $id. ".". $file_extension; ?>" alt="<?php echo htmlspecialchars($image['recipe_name']); ?>"/>
        </figure>

        <?php if(isset($source)) {
            ?>
            <a href = <?php echo $source; ?> class = "source_tags">Source</a>
            <?php
        }
        ?>

        <ul class = "tags">Tags

            <?php
                //get tags
                $sql = "SELECT tag FROM tags WHERE id IN (SELECT tag_id FROM image_tags WHERE image_id = :image_id);";
                $params = array(
                    ':image_id' => $id
                );
                $result = exec_sql_query($db, $sql, $params);

                if ($result) {
                    // The query was successful, let's get the records.
                    $tags = $result->fetchAll();
                    foreach($tags as $tag){
                        print_tags($tag);
                    }
                }

            ?>

        </ul>

        <?php
        if( isset($user_id) && ($current_user_id == $user_id ) ){
            $img_to_delete = $id;
            ?>
            <form id="delete_form" method="post" action= <?php echo "photo.php?". http_build_query( array( 'img_to_delete' => $img_to_delete, 'file_extension' => $file_extension ) );?> enctype="multipart/form-data">

            <button name="delete_image" type="submit">Delete</button>


            </form>
            <?php
          }
        ?>

        <form id="tag_indiv_pic" method="post" action=<?php echo "recipe.php?" . http_build_query( array( 'id' => $id, 'source' => $source, 'recipe_name' => $recipe_name, 'user_id' => $user_id, 'current_user_id' => $current_user_id ) );?> enctype="multipart/form-data">
        <fieldset>

            <legend>Add a tag to this image!</legend>
            <ul>
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
              <button name="submit_tag" type="submit">Submit</button>
            </li>
            </ul>
        </fieldset>
        </form>




  </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>
