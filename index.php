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
  <title>Home</title>
</head>

<body>
  <?php include("includes/header.php");

  if (isset($_POST['submit'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $breakfast = isset($_POST['breakfast']) ? $_POST['breakfast'] : '';
    $lunch = isset($_POST['lunch']) ? $_POST['lunch'] : '';
    $dinner = isset($_POST['dinner']) ? $_POST['dinner'] : '';
    $snacks = isset($_POST['snacks']) ? $_POST['snacks'] : '';
    $valid_request = TRUE;

    if ($first_name == "") {
      $valid_request = FALSE;
      $valid_first_name = FALSE;
    }

    if ($email == "") {
      $valid_request = FALSE;
      $valid_email = FALSE;
    }

    if(!isset($_POST['breakfast']) && !isset($_POST['lunch']) && !isset($_POST['dinner']) && !isset($_POST['snacks']))
    {
      $valid_content = FALSE;
      $valid_request = FALSE;
    }
  }

  if(isset($valid_request) && $valid_request){ ?>
    <p>Thank you for visiting this site <?php if(isset($_POST['first_name'])){ echo htmlspecialchars($first_name);}
    ?>!</p>
    <p>An email should be sent shortly to <?php if(isset($_POST['email'])){ echo htmlspecialchars($email);} ?> containing a pdf of recipes for the following section(s):</p>
      <ul>
        <?php
          if(isset($_POST['breakfast'])){
            ?><li class = "request">Breakfast</li><?php
          }
          if(isset($_POST['lunch'])){
            ?><li class = "request">Lunch</li><?php
          }
          if(isset($_POST['dinner'])){
            ?><li class = "request">Dinner</li><?php
          }
          if(isset($_POST['snacks'])){
            ?><li class = "request">Snacks & Desserts</li><?php
          }
        ?>
      </ul>
    <?php
  }

  else{ ?>
  <div class = "flex-container">
    <div class = "left">
      <!-- Source: https://chefsavvy.com/wp-content/uploads/energy-bites1.jpg -->
      <img src="images/energybites.jpg" alt="An image of peanut butter energy bites">
      <a href = "https://chefsavvy.com/wp-content/uploads/energy-bites1.jpg" class = "source_left">Source</a>

      <!-- Source: https://i0.wp.com/letthebakingbegin.com/wp-content/uploads/2018/09/Margherita-Pizza-5.jpg?resize=600%2C900&ssl=1 -->
      <img src="images/pizza.jpg" alt="An image of a margherita flatbread pizza">
      <a href = "https://i0.wp.com/letthebakingbegin.com/wp-content/uploads/2018/09/Margherita-Pizza-5.jpg?resize=600%2C900&ssl=1" class = "source_left">Source</a>
    </div>

    <div class = "middle">
      <p>Welcome to Healthy&Easy Recipes! Do you live a busy life? Do you enjoy eating well balanced meals? Do you often compromise your health just because you are too busy? If you answered yes to any or all of those questions, this is the site for you! I have compiled my favorite easy and healthy recipes for <a href = "snacks.php">snacks</a>, <a href = "breakfast.php">breakfast</a>, <a href = "lunch.php">lunch</a>, and <a href = "dinner.php">dinner</a>. Not only are these recipes delicious, but they are easy to make!
      </p>

        <form id="pdf_recipes" method="post" action="index.php">
          <fieldset>
            <legend>Request a PDF of all of the recipes!</legend>
            <div>
              <p class = "feedback" <?php if(!isset($valid_email)) { echo "hidden";} ?>>Please enter a valid email</p>
              <div class = "label"><p class = "required">* </p><label>Email:</label></div>
              <input class = "text_input" type="email" name="email" value="<?php if(isset($email)) {echo htmlspecialchars($email);};?>"/>
            </div>
            <div>
            <p class = "feedback" <?php if(!isset($valid_first_name)) { echo "hidden";} ?>>Please enter your name</p>
              <div class = "label"><p class = "required">* </p><label>First Name:</label></div>
              <input class = "text_input" type="text" name="first_name" value="<?php if(isset($first_name)) {echo htmlspecialchars($first_name);};?>"/>
            </div>
            <div class = "last_name">
              <label class = "text_label">Last Name:</label>
              <input class = "text_input" type="text" name="last_name" value="<?php if(isset($last_name)) {echo htmlspecialchars($last_name);};?>"/>
            </div>
              <p class = "feedback" <?php if(!isset($valid_content)) { echo "hidden";} ?>>Please select at least one section</p>
              <p><p class = "required">* </p>Content requested:
              <div class = "content">
                <input type="checkbox" name="breakfast" value="breakfast"<?php if(isset($breakfast) && $breakfast != "") {echo "checked";}?>>
                <label>Breakfast</label>
              </div>
              <div class = "content">
                <input type="checkbox" name="lunch" value="lunch" <?php if(isset($lunch) && $lunch != "") {echo "checked";}?>>
                <label>Lunch</label>
              </div>
              <div class = "content">
                <input type="checkbox" name="dinner" value="dinner" <?php if(isset($dinner) && $dinner != "") {echo "checked";}?>>
                <label>Dinner</label>
              </div>
              <div class = "content">
                <input type="checkbox" name="snacks" value="snacks" <?php if(isset($snacks) && $snacks != "") {echo "checked";}?>>
                <label>Snacks & Desserts</label>
              </div>

            <input class="submit_button" type="submit" value="Request" name="submit"/>
          </fieldset>
        </form>
    </div>

    <div class = "right">
      <!-- Source: https://www.chocolatecoveredkatie.com/wp-content/uploads/The-Dr.-Oz-Show_A0D6/banana-pancake_thumb_3.jpg -->
      <img src="images/pancakes.jpg" alt="An image of 3 ingredient pancakes">
      <a href = "https://www.chocolatecoveredkatie.com/wp-content/uploads/The-Dr.-Oz-Show_A0D6/banana-pancake_thumb_3.jpg" class = "source_right">Source</a>

      <!-- Source: https://sweetpeasandsaffron.com/wp-content/uploads/2015/11/Peanut-Lime-Chicken-Lunch-Bowls-600x900.jpg -->
      <img src="images/thai_bowl.jpg" alt="An image of a thai chicken lunch bowl">
      <a href = "https://sweetpeasandsaffron.com/wp-content/uploads/2015/11/Peanut-Lime-Chicken-Lunch-Bowls-600x900.jpg" class = "source_right">Source</a>
    </div>
  </div>
    <?php } ?>

  <?php include("includes/footer.php"); ?>
</body>
</html>
