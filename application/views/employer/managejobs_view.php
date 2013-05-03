<h2>Manage Jobs</h2>

<?php if (isset($discarded) && $discarded == TRUE) echo "<p>Notice: Job is discarded</p>"; ?>
<?php echo anchor('employer/job', 'Add'); ?>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Expired date</th>
    <th>Active</th>
    <th>Number of applications</th>
  </tr>

  <?php foreach ($jobs as $row) if ($row['Status'] > DISABLED) { ?>
  <tr>
    <td><?php echo $row['JID']; ?></td>
    <td><?php echo $row['Name']; ?></td>
    <td><?php echo $row['ExpiredDate']; ?></td>
    <td><?php echo ($row['Status'] == ACTIVE ? 'Yes' : '-'); ?></td>
    <td><?php echo count($apps[$row['JID']]); ?></td>
    <td><?php echo anchor('employer/managejobs/examine/'.$row['JID'], 'Examine'); ?></td>
    <td><?php echo anchor('employer/job/edit/'.$row['JID'], 'Edit'); ?></td>
    <td><?php echo anchor('employer/job/discard/'.$row['JID'], 'Discard'); ?></td>
  </tr>
  <?php } /* Close 'foreach if' */ ?>
</table>

<?php if ($exjid > 0) { ?>
<h3>Examine Job: <?php echo $exjob.' - ID: '.$exjid; ?></h3>
<table border="1">
  <tr>
    <th>CV's ID</th>
    <th>Education Level</th>
    <th>Skills</th>
    <th>Language</th>
    <th>Experience</th>
    <th>Additional Information</th>
    <th>Status</th>
  </tr>

  <?php if (isset($apps[$exjid])) foreach ($cvs as $row) { ?>
  <tr>
    <td><?php echo $row['CID']; ?></td>
    <td><?php echo $row['EduLev']; ?></td>
    <td><?php echo $row['Skill']; ?></td>
    <td><?php echo $row['Language']; ?></td>
    <td><?php echo $row['Exp']; ?></td>
    <td><?php echo $row['AddInfo']; ?></td>
    <td><?php
        foreach ($ex_apps as $app) if ($app['CID'] == $row['CID']) {
          if ($app['Status'] == ACCEPTED) {
            echo 'Accepted';
          } else if ($app['Status'] == REFUSED) {
            echo 'Refused';
          } else {
            echo 'Waiting';
          }
          break;
        }
        ?></td>
    <td><?php echo anchor('employer/managejobs/accept/'.$exjid.'/'.$row['CID'], 'Accept'); ?></td>
    <td><?php echo anchor('employer/managejobs/refuse/'.$exjid.'/'.$row['CID'], 'Refuse'); ?></td>
  </tr>
  <?php } /* Close 'if foreach' */ ?>
</table>
<?php } /* Close if ($exjid > 0) */ ?>
