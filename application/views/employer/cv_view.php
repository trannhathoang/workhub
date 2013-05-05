<h2>View CV</h2>

<p><?php if ($cv == NULL || $applicant == NULL) echo "Unknown CV"; else { ?></p>

<h3>Applicant information</h3>
<p>Name: <?php echo $applicant['Name']; ?></p>
<p>Sex: <?php echo ($applicant['Sex'] == MALE ? 'Male' : 'Female'); ?></p>
<p>Birthday: <?php echo $applicant['Birthday']; ?></p>
<p>Email: <?php echo $applicant['Email']; ?></p>
<p>Region: <?php
  foreach ($regions as $row) {
    if ($row['RID'] == $applicant['RID']) {
      echo $row['Name'];
      break;
    }
  }
  ?>
</p>
<p>Address: <?php echo $applicant['Address']; ?></p>
<p>Description: <?php echo $applicant['Description']; ?></p>

<h3>Working information</h3>
<p>CV's ID: <?php echo $cv['CID']; ?></p>
<p>Education Level: <?php echo $cv['EduLev']; ?></p>
<p>Skills: <?php echo $cv['Skill']; ?></p>
<p>Languages: <?php echo $cv['Language']; ?></p>
<p>Experience: <?php echo $cv['Exp']; ?></p>
<p>Additional Information: <?php echo $cv['AddInfo']; ?></p>
<p>Work region: <?php
  foreach ($regions as $row) {
    if ($row['RID'] == $cv['RID']) {
      echo $row['Name'];
      break;
    }
  }
  ?>
</p

<div>
  <?php echo anchor('employer/cv/invite/'.$cv['CID'], 'Invite'); ?>
</div>

<?php } /* Close if ($job == NULL) ...; else { */ ?>
