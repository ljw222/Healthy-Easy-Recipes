    <h1 class = "header_h1">HEALTHY & EASY</h1>
    <h2 class = "header_h2">RECIPES</h2>

    <nav class = "header_nav">
        <ul class = "header_ul">
        <?php
            $pages = [
                ['index.php', 'Home'],
                ['breakfast.php', 'Breakfast'],
                ['lunch.php', 'Lunch'],
                ['dinner.php', 'Dinner'],
                ['snacks.php', 'Snacks & Desserts'],
                ['photo.php', 'Photo Gallery']
            ];



            foreach ($pages as $page){
                $current_file = basename($_SERVER['PHP_SELF']);
                ?> <li class = "header_li <?php if($current_file == $page[0]){ ?>  current_page"<?php ;} else{?>" <?php ;} ?>><a class = "header_a" href = <?php echo $page[0];?>>
                <?php echo $page[1];?></a></li> <?php
            }
        ?>
        </ul>
        <?php
        if ( is_user_logged_in() ) {
              // Add a logout query string parameter
              $logout_url = htmlspecialchars( $_SERVER['PHP_SELF'] ) . '?' . http_build_query( array( 'logout' => '' ) );

              ?> <?php echo '<a class="logout" href="' . $logout_url . '">Sign Out ' . htmlspecialchars($current_user['username']) . '</a>'; ?><?php
        }
        ?>



    </nav>
