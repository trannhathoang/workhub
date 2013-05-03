<?php if ($job == NULL) redirect('home', 'refresh'); else { ?>
  <h2>Apply for job</h2>

  <ul>
    <li>Job Name: <?php echo $job['Name']; ?></li>
    <li>Job ID: <?php echo $job['JID']; ?></li>
    <li>Employer: <?php echo $employer['Name']; ?></li>
  </ul>

  <p>Please select one of your CVs. Note: You cannot use a CV to apply for a job twice.</p>

  <?php
  if ($cvs == NULL) {
    echo '<p>Notice: You have no CV now. Please create one!</p>';
  } else {
    echo validation_errors();
    echo form_open('applicant/verify_apply');
  ?>
      <!-- Hidden field for Job ID, Employer ID -->
      <input type="hidden" name="job" value="<?php echo $job['JID']; ?>">
      <input type="hidden" name="euid" value="<?php echo $employer['UID']; ?>">

      <!-- Radio button for CVs -->
      <?php foreach ($cvs as $row) if ($row['Status'] > DISABLED) { ?>
        <input type="radio" name="cv" value="<?php echo $row['CID']; ?>"/><?php echo $row['Subject']; ?>
        <br/>
      <?php } /* Close 'foreach if' */ ?>

      <input type="submit" value="Apply"/>
    </form>

  <?php } /* Close if ($cvs == NULL) {}; else { */ ?>
<?php } /* Close if ($job == NULL) {}; else { */ ?>
