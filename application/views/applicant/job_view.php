<h2>View Job</h2>

<p><?php if ($job == NULL) echo "Unknown job"; else { ?></p>

<h3><?php echo $job['Name']; ?></h3>
<p>ID: <?php echo $job['JID']; ?></p>
<p>Employer: <?php if ($employer != NULL) echo $employer['Name']; ?></p>
<p>Status: <?php if ($job['Status'] == ACTIVE) echo "Active"; else echo "Inactive"; ?></p>
<p>Expiration date: <?php echo $job['ExpiredDate']; ?></p>

<h3>Job Description</h3>
<p>Job level: <?php
  foreach ($levels as $row) {
    if ($row['JLID'] == $job['JLID']) {
      echo $row['Name'];
      break;
    }
  }
  ?>
</p>
<p>Category: <?php
  foreach ($categories as $row) {
    if ($row['CAID'] == $job['CAID']) {
      echo $row['Name'];
      break;
    }
  }
  ?>
</p>
<p>Min salary: <?php echo $job['MinSalary']; ?></p>
<p>Max salary: <?php echo $job['MaxSalary']; ?></p>
<p>Region: <?php
  foreach ($regions as $row) {
    if ($row['RID'] == $job['RID']) {
      echo $row['Name'];
      break;
    }
  }
  ?>
</p>
<p>Address: <?php echo $job['Address']; ?></p>
<p>Description:<br/><?php echo $job['Description']; ?></p>

<h3>Job Requirements</h3>

<p>Education: <?php echo $job['EduReq']; ?></p>
<p>Skills: <?php echo $job['SkillReq']; ?></p>
<p>Languages: <?php echo $job['LangReq']; ?></p>
<p>Experience: <?php echo $job['ExpReq']; ?></p>

<?php } /* Close if ($job == NULL) ...; else { */ ?>

<div>
  <?php echo anchor('applicant/job/apply/'.$job['JID'], 'Apply'); ?>
</div>
