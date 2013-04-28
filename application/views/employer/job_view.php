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

  <label for="status">Status</label>
  <select name="status">
    <option value="<?php echo ACTIVE; ?>" <?php echo ($job != NULL && $job['Status'] == ACTIVE ? 'selected' : ''); ?>>Active</option>
    <option value="<?php echo INACTIVE; ?>" <?php echo ($job != NULL && $job['Status'] != ACTIVE ? 'selected' : ''); ?>>Inactive</option>
  </select>
  </br>

  <h3>Job Description</h3>
  <label for="level">Level</label>
  <select name="level">
    <?php
    foreach ($levels as $row) {
      if ($job != NULL) {
        echo '<option value="'.$row['JLID'].'" '.($row['JLID'] == $job['JLID'] ? 'selected' : '').'>'.$row['Name'].'</option>';
      } else {
        echo '<option value="'.$row['JLID'].'" '.($row['JLID'] == set_value('level') ? 'selected' : '').'>'.$row['Name'].'</option>';
      }
    }
    ?>
  </select>
  <br/>

  <label for="category">Category</label>
  <select name="category">
    <?php
    foreach ($categories as $row) {
      if ($job != NULL) {
        echo '<option value="'.$row['CAID'].'" '.($row['CAID'] == $job['CAID'] ? 'selected' : '').'>'.$row['Name'].'</option>';
      } else {
        echo '<option value="'.$row['CAID'].'" '.($row['CAID'] == set_value('category') ? 'selected' : '').'>'.$row['Name'].'</option>';
      }
    }
    ?>
  </select>
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
        echo '<option value="'.$row['RID'].'" '.($row['RID'] == set_value('region') ? 'selected' : '').'>'.$row['Name'].'</option>';
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

  <h3>Job Requirements</h3>
  <label for="edu_req">Education</label>
  <textarea rows="5" cols="60" name="edu_req"><?php echo ($job != NULL ? $job['EduReq'] : set_value('edu_req')); ?></textarea>
  <br/>

  <label for="skill_req">Skills</label>
  <textarea rows="5" cols="60" name="skill_req"><?php echo ($job != NULL ? $job['SkillReq'] : set_value('skill_req')); ?></textarea>
  <br/>

  <label for="lang_req">Languages</label>
  <textarea rows="5" cols="60" name="lang_req"><?php echo ($job != NULL ? $job['LangReq'] : set_value('lang_req')); ?></textarea>
  <br/>

  <label for="exp_req">Experience</label>
  <textarea rows="5" cols="60" name="exp_req"><?php echo ($job != NULL ? $job['ExpReq'] : set_value('exp_req')); ?></textarea>
  <br/>

  <input type="submit" value="Save"/>

</form>

<?php echo anchor('employer/managejobs', 'Cancel'); ?>
