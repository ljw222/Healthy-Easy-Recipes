<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!
function print_tags_2($tag_name){
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

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
    $current_user_id = filter_input(INPUT_GET, 'current_user_id', FILTER_VALIDATE_INT);
    $source = filter_input(INPUT_GET, 'source', FILTER_SANITIZE_STRING);
    $recipe_name = filter_input(INPUT_GET, 'recipe_name', FILTER_SANITIZE_STRING);
    $file_extension = filter_input(INPUT_GET, 'file_extension', FILTER_SANITIZE_STRING);


    if( isset($_POST['delete_tag']) ) {
        $img_to_delete = $_GET['img_to_delete'];
        $tag_to_delete = $_GET['tag_to_delete'][0];
        $sql = "DELETE FROM image_tags WHERE tag_id = :tag_to_delete AND image_id = :img_to_delete ;";
        $params = array(
            ':img_to_delete' => $img_to_delete,
            ':tag_to_delete' => $tag_to_delete
        );
        $result = exec_sql_query($db, $sql, $params);
    }

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
            <a href = "<?php echo $source; ?>" class = "source_tags">Source</a>
            <?php
        }
        ?>

        <?php
        if( isset($user_id) && ($current_user_id == $user_id ) ){
            $img_to_delete = $id;
            ?>
            <form id="delete_form" method="post" action= "<?php echo "photo.php?". http_build_query( array( 'img_to_delete' => $img_to_delete, 'file_extension' => $file_extension ) );?>" enctype="multipart/form-data">
                <button name="delete_image" type="submit">Delete Image</button>
            </form>
            <?php
          }
        ?>

        <p>Tags</p>

        <ul class = "tags">
            <?php
                $tags = exec_sql_query(
                    $db,
                    "SELECT * FROM tags",
                    array())->fetchAll();
                    foreach($tags as $tag){
                      if ( isset($_POST[$tag[tag] . "_tag"])){
                        $sql = "INSERT INTO image_tags (image_id,tag_id) VALUES (:image_id, :tag_id);";
                        $params = array(
                          ':image_id' => $id,
                          'tag_id' => $tag['id']
                        );
                        $result = exec_sql_query($db, $sql, $params);
                      }
                    }

                      if ( isset($_POST["other_tag"]) && isset($_POST["other_check"]) ){
                        //insert into tags table
                        $last_img_id = $id;

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

                        if( isset($current_user_id) && $current_user_id == $user_id)
                        {
                            $tag1= $tag[0];

                            $sql = "SELECT id FROM tags WHERE tag = :tag1;";
                            $params = array(
                                ':tag1' => $tag1
                            );
                            $result = exec_sql_query($db, $sql, $params);

                            $to_delete = $result->fetchAll();
                            $tag_to_delete = $to_delete[0];
                            ?>


                            <form class="delete_tag" method="post" action= "<?php echo "recipe.php?". http_build_query( array( 'tag_to_delete' => $tag_to_delete, 'img_to_delete' => $id, 'id' => $id, 'user_id' => $user_id, 'current_user_id' => $current_user_id, 'source' => $source, 'recipe_name' => $recipe_name, 'file_extension' => $file_extension) );?>" enctype="multipart/form-data">
                                <button name="delete_tag" type="submit">Delete Tag</button>
                            </form>
                            <?php
                        }
                    }
                }

            ?>

        </ul>



        <form id="tag_indiv_pic" method="post" action="<?php echo "recipe.php?" . http_build_query( array( 'id' => $id, 'source' => $source, 'recipe_name' => $recipe_name, 'file_extension' => $file_extension, 'user_id' => $user_id, 'current_user_id' => $current_user_id ) );?>" enctype="multipart/form-data">
        <fieldset>

            <legend>Add a new tag to this image!</legend>
            <ul>
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
                  ?><p class="form_tag"><input type="checkbox" value= <?php echo $tag[0];?> name=<?php echo $tag[0] . "_tag";?>><?php print_tags_2($tag[0]); ?></p><?php
                }
              ?>
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
