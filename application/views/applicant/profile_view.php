<h2>Profile</h2>

<div>Account type</div>
<?php
foreach ($user as $key => $field) {
  echo '<p>'. $key . ' => ' . $field . '</p>';
}
