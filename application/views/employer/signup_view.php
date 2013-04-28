<h1>Enter information</h1>

<?php echo validation_errors(); ?>

<?php echo form_open('employer/verify_signup'); ?>
  <label for="username">Username</label>
  <input type="text" size="20" id="username" name="username"
    value="<?php echo set_value('username'); ?>"/>
  <br/>

  <label for="password">Password</label>
  <input type="password" size="20" id="password" name="password"/>
  <br/>

  <label for="confirm">Confirm password</label>
  <input type="password" size="20" id="confirm" name="confirm"/>
  <br/>

  <label for="email">Email</label>
  <input type="text" size="20" id="email" name="email"
    value="<?php echo set_value('email'); ?>"/>
  <br/>

  <label for="name">Name</label>
  <input type="text" size="20" id="name" name="name"
    value="<?php echo set_value('name'); ?>"/>
  <br/>

  <label for="region">Region</label>
  <select name="region" value="24">
    <?php
    foreach ($regions as $row) {
      echo '<option value="'.$row['RID'].'">'.$row['Name'].'</option>';
    }
    ?>
  </select>
  <br/>

  <label for="address">Address</label>
  <input type="text" size="40" id="address" name="address"
    value="<?php echo set_value('address'); ?>"/>
  <br/>

  <label for="size">Size</label>
  <input type="text" size="20" id="size" name="size"
    value="<?php echo set_value('size'); ?>"/>
  <br/>

  <label for="description">Description</label>
  <textarea rows="5" cols="60" id="description" name="description"><?php echo set_value('description'); ?></textarea>
  <br/>

  <input type="submit" value="Sign up"/>
</form>
