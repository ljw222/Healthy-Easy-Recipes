<?php
// DO NOT REMOVE!
include("includes/init.php");
// DO NOT REMOVE!
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $source = filter_input(INPUT_GET, 'source', FILTER_SANITIZE_STRING);
    $recipe_name = filter_input(INPUT_GET, 'recipe_name', FILTER_SANITIZE_STRING);
    //$user_tag = filter_input(INPUT_GET, 'other_tag', FILTER_SANITIZE_STRING);

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
            <img src="uploads/images/<?php echo $id; ?>.jpg" alt="<?php echo htmlspecialchars($image['recipe_name']); ?>"/>
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


  </div>

    <?php include("includes/footer.php"); ?>
</body>
</html>
