<h2>Edit Job</h2>

<?php
if (isset($saved) && $saved == TRUE) echo "<p>Job is saved</p>";
echo validation_errors();
?>

<?php echo form_open('employer/verify_job'); ?>

  <label for="id">ID</label>
  <input type="text" size="20" name="id" readonly
    value="<?php echo ($job != NULL ? $job['JID'] : '0'); ?>"/>
  <br/>

  <label for="name">Name</label>
  <input type="text" size="20" name="name"
    value="<?php echo ($job != NULL ? $job['Name'] : set_value('name')); ?>"/>
  <br/>

  <label for="category">Category</label>
  <input type="text" size="20" name="category"
    value="<?php echo ($job != NULL ? $job['Category'] : set_value('category')); ?>"/>
  <br/>

  <label for="min_salary">Min salary</label>
  <input type="text" size="20" name="min_salary"
    value="<?php echo ($job != NULL ? $job['MinSalary'] : set_value('min_salary')); ?>"/>
  <br/>

  <label for="max_salary">Max salary</label>
  <input type="text" size="20" name="max_salary"
    value="<?php echo ($job != NULL ? $job['MaxSalary'] : set_value('max_salary')); ?>"/>
  <br/>

  <label for="expire">Expire date</label>
  <input type="text" size="20" name="expire"
    value="<?php echo ($job != NULL ? $job['ExpiredDate'] : set_value('expire')); ?>"/>
  <br/>

  <label for="region">Region</label>
  <select name="region">
    <?php
    foreach ($regions as $row) {
      if ($job != NULL) {
        echo '<option value="'.$row['RID'].'" '.($row['RID'] == $job['RID'] ? 'selected' : '').'>'.$row['Name'].'</option>';
      } else {
        echo '<option value="'.$row['RID'].'" '.($row['RID'] == set_value('regions') ? 'selected' : '').'>'.$row['Name'].'</option>';
      }
    }
    ?>
  </select>
  <br/>

  <label for="address">Address</label>
  <input type="text" size="40" name="address"
    value="<?php echo ($job != NULL ? $job['Address'] : set_value('address')); ?>"/>
  <br/>

  <label for="description">Description</label>
  <textarea rows="5" cols="60" name="description"><?php echo ($job != NULL ? $job['Description'] : set_value('description')); ?></textarea>
  <br/>

  <input type="submit" value="Save"/>

</form>

<?php echo anchor('home/managejobs', 'Cancel'); ?>
