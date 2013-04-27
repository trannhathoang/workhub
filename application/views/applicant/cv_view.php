<h2>Edit CV</h2>

<?php
if (isset($saved) && $saved == TRUE) echo "<p>CV is saved</p>";
echo validation_errors();
?>

<?php echo form_open('applicant/verify_cv'); ?>

  <label for="id">ID</label>
  <input type="text" size="20" name="id" readonly
    value="<?php echo ($cv != NULL ? $cv['CID'] : '0'); ?>"/>
  <br/>

  <label for="subject">Subject</label>
  <input type="text" size="20" name="subject"
    value="<?php echo ($cv != NULL ? $cv['Subject'] : set_value('subject')); ?>"/>
  <br/>

  <label for="status">Status</label>
  <select name="status">
    <option value="<?php echo ACTIVE; ?>" <?php echo ($cv != NULL && $cv['Status'] == ACTIVE ? 'selected' : ''); ?>>Active</option>
    <option value="<?php echo INACTIVE; ?>" <?php echo ($cv != NULL && $cv['Status'] != ACTIVE ? 'selected' : ''); ?>>Inactive</option>
  </select>
  </br>

  <label for="category">Category</label>
  <input type="text" size="20" name="category"
    value="<?php echo ($cv != NULL ? $cv['Category'] : set_value('category')); ?>"/>
  <br/>

  <label for="edu_lev">Education level</label>
  <input type="text" size="20" name="edu_lev"
    value="<?php echo ($cv != NULL ? $cv['EduLev'] : set_value('edu_lev')); ?>"/>
  <br/>

  <label for="skill">Skills</label>
  <input type="text" size="20" name="skill"
    value="<?php echo ($cv != NULL ? $cv['Skill'] : set_value('skill')); ?>"/>
  <br/>

  <label for="language">Language</label>
  <input type="text" size="20" name="language"
    value="<?php echo ($cv != NULL ? $cv['Language'] : set_value('language')); ?>"/>
  <br/>

  <label for="exp">Experience</label>
  <input type="text" size="40" name="exp"
    value="<?php echo ($cv != NULL ? $cv['Exp'] : set_value('exp')); ?>"/>
  <br/>

  <label for="region">Region</label>
  <select name="region">
    <?php
    foreach ($regions as $row) {
      if ($cv != NULL) {
        echo '<option value="'.$row['RID'].'" '.($row['RID'] == $cv['RID'] ? 'selected' : '').'>'.$row['Name'].'</option>';
      } else {
        echo '<option value="'.$row['RID'].'" '.($row['RID'] == set_value('regions') ? 'selected' : '').'>'.$row['Name'].'</option>';
      }
    }
    ?>
  </select>
  <br/>

  <label for="add_info">Additional information</label>
  <textarea rows="5" cols="60" name="add_info"><?php echo ($cv != NULL ? $cv['AddInfo'] : set_value('add_info')); ?></textarea>
  <br/>

  <input type="submit" value="Save"/>

</form>

<?php echo anchor('home/managecvs', 'Cancel'); ?>
