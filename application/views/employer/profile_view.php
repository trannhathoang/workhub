<h2>Profile</h2>

<?php
if (isset($updated) && $updated == TRUE) echo "<p>Profile is updated</p>";
echo validation_errors();
?>
<?php echo form_open('employer/verify_profile'); ?>

  <label for="type">Account type</label>
  <input type="text" size="20" name="type" disabled
    value="Employer"/>
  <br/>

  <label for="username">Username</label>
  <input type="text" size="20" name="username" disabled
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

   <label for="category">Category</label>
  <input type="text" size="20" id="category" name="category"
    value="<?php echo $user['Category']; ?>"/>
  <br/>

  <label for="size">Size</label>
  <input type="text" size="20" id="size" name="size"
    value="<?php echo $user['Size']; ?>"/>
  <br/>

 <label for="description">Description</label>
  <textarea rows="5" cols="60" id="description" name="description"><?php echo $user['Description']; ?></textarea>
  <br/>

  <input type="submit" value="Update"/>

</form>
