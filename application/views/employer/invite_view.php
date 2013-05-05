<?php if ($cv == NULL) redirect('home', 'refresh'); else { ?>
  <h2>Invite applicant</h2>

  <ul>
    <li>Applicant: <?php echo $applicant['Name']; ?></li>
    <li>CV's ID: <?php echo $cv['CID']; ?></li>
  </ul>

  <p>Please select one of your jobs. Note: You cannot send invitation for a CV twice.</p>

  <?php
  if ($jobs == NULL) {
    echo '<p>Notice: You have no job now. Please create one or activate an existing job!</p>';
  } else {
    echo validation_errors();
    echo form_open('employer/verify_invite');
  ?>
      <!-- Hidden field for CID, Applicant ID -->
      <input type="hidden" name="cid" value="<?php echo $cv['CID']; ?>">
      <input type="hidden" name="auid" value="<?php echo $applicant['UID']; ?>">

      <!-- Radio button for jobs -->
      <?php foreach ($jobs as $row) if ($row['Status'] == ACTIVE) { ?>
        <input type="radio" name="job" value="<?php echo $row['JID']; ?>"/><?php echo $row['Name'].' (ID: '.$row['JID'].')'; ?>
        <br/>
      <?php } /* Close 'foreach if' */ ?>

      <input type="submit" value="Invite"/>
    </form>

  <?php } /* Close if ($jobs == NULL) {}; else { */ ?>
<?php } /* Close if ($cv == NULL) {}; else { */ ?>
