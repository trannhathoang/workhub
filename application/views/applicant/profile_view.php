<h2>Profile</h2>

<?php
if (isset($updated) && $updated == TRUE) echo "<p>Profile is updated</p>";
echo validation_errors();
?>
<?php echo form_open('applicant/verify_profile'); ?>

  <label for="type">Account type</label>
  <input type="text" size="20" name="type" readonly
    value="Applicant"/>
  <br/>

  <label for="username">Username</label>
  <input type="text" size="20" name="username" readonly
    value="<?php echo $user['Username'];?>"/>
  <br/>

  <label for="password">Password</label>
  <input type="password" size="20" id="password" name="password"/>
  <br/>

  <label for="confirm">Confirm password</label>
  <input type="password" size="20" id="confirm" name="confirm"/>
  <br/>

  <label for="email">Email</label>
  <input type="text" size="20" id="email" name="email"
    value="<?php echo $user['Email']; ?>"/>
  <br/>

  <label for="name">Name</label>
  <input type="text" size="20" id="name" name="name"
    value="<?php echo $user['Name']; ?>"/>
  <br/>

  <label for="sex">Sex</label>
  <input type="radio" name="sex" value="male" <?php if ($user['Sex'] == MALE) echo 'checked="checked"';?> />Male
  <input type="radio" name="sex" value="female" <?php if ($user['Sex'] == FEMALE) echo 'checked="checked"';?>/>Female
  <br/>

  <label for="birthday">Birthday</label>
  <input type="date" id="birthday" name="birthday"
    value="<?php echo $user['Birthday']; ?>"/>
  <br/>

  <label for="region">Region</label>
  <select name="region">
    <?php
    foreach ($regions as $row) {
      echo '<option value="'.$row['RID'].'" '.($row['RID'] == $user['RID'] ? 'selected' : '').'>'.$row['Name'].'</option>';
    }
    ?>
  </select>
  <br/>

  <label for="address">Address</label>
  <input type="text" size="40" id="address" name="address"
    value="<?php echo $user['Address']; ?>"/>
  <br/>

  <label for="description">Description</label>
  <textarea rows="5" cols="60" id="description" name="description"><?php echo $user['Description']; ?></textarea>
  <br/>

  <input type="submit" value="Update"/>

</form>
