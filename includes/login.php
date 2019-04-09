<ul>
  <?php
  foreach ($session_messages as $message) {
    echo "<li><strong>" . htmlspecialchars($message) . "</strong></li>\n";
  }
  ?>
</ul>

<form id="login_form" action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">
  <fieldset>
    <legend>Login to submit an image!</legend>
      <ul>
        <li>
          <label for="username" class="text_label">Username:</label>
          <input id="username" type="text" name="username" />
        </li>
        <li>
          <label for="password" class="text_label">Password:</label>
          <input id="password" type="password" name="password" />
        </li>
        <li>
          <button name="login" type="submit">Sign In</button>
        </li>
      </ul>
  </fieldset>
</form>
