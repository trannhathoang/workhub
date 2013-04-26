<h2>Edit Job</h2>

<?php
if (isset($updated) && $updated == TRUE) echo "<p>Job is updated</p>";
echo validation_errors();
?>

<?php echo form_open('employer/verify_job'); ?>

  <label for="id">ID</label>
  <input type="text" size="20" name="id" disabled value="0"/>
  <br/>

  <label for="name">Name</label>
  <input type="text" size="20" name="name"/>
  <br/>

  <label for="category">Category</label>
  <input type="text" size="20" name="category"/>
  <br/>

  <label for="min_salary">Min salary</label>
  <input type="text" size="20" name="min_salary"/>
  <br/>

  <label for="max_salary">Max salary</label>
  <input type="text" size="20" name="max_salary"/>
  <br/>

  <label for="expire">Expire date</label>
  <input type="text" size="20" name="expire"/>
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
  <input type="text" size="40" name="address"/>
  <br/>

  <label for="description">Description</label>
  <textarea rows="5" cols="60" name="description"></textarea>
  <br/>

  <input type="submit" value="Save"/>

</form>

<?php echo anchor('home/managejobs', 'Cancel'); ?>
