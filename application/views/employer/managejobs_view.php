<h2>Manage Jobs</h2>

<?php echo anchor('employer/job', 'Add'); ?>
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Expired date</th>
  </tr>

  <?php foreach ($jobs as $row) if ($row['Status'] > DISABLED) { ?>
  <tr>
    <td><?php echo $row['JID']; ?></td>
    <td><?php echo $row['Name']; ?></td>
    <td><?php echo $row['ExpiredDate']; ?></td>
    <td><?php echo anchor('employer/job/edit/'.$row['JID'], 'Edit'); ?></td>
    <td><?php echo anchor('employer/job/discard/'.$row['JID'], 'Discard'); ?></td>
  </tr>
  <?php } /* Close 'foreach if' */ ?>
</table>
<?php if (isset($discarded) && $discarded == TRUE) echo "<p>Notice: Job is discarded</p>"; ?>