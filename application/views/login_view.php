<h1>Login</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('verify_login'); ?>
  <label for="username">Username</label>
  <input type="text" size="20" id="username" name="username"
    value="<?php echo set_value('username'); ?>"/>
  <br/>
  <label for="password">Password</label>
  <input type="password" size="20" id="password" name="password"/>
  <br/>
  <input type="submit" value="Login"/>
</form>
<?php echo anchor('signup', 'Sign up', array('title' => 'Sign up for an account')); ?>

