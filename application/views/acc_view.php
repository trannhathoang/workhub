<div>
  <?php
  if (isset($username)) {
    echo 'Welcome '.$username.' | ';
    echo anchor('home/logout', 'Logout');
  } else {
    echo anchor('signup', 'Sign up');
    echo anchor('login', 'Login');
  }
  ?>
</div>
