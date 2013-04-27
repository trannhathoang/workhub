<h2>Manage CVs</h2>

<?php echo anchor('applicant/cv', 'Add'); ?>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Subject</th>
    <th>Active</th>
  </tr>

  <?php foreach ($cvs as $row) if ($row['Status'] > DISABLED) { ?>
  <tr>
    <td><?php echo $row['CID']; ?></td>
    <td><?php echo $row['Subject']; ?></td>
    <td><?php echo ($row['Status'] == ACTIVE ? 'Yes' : '-'); ?></td>
    <td><?php echo anchor('applicant/cv/edit/'.$row['CID'], 'Edit'); ?></td>
    <td><?php echo anchor('applicant/cv/discard/'.$row['CID'], 'Discard'); ?></td>
  </tr>
  <?php } /* Close 'foreach if' */ ?>
</table>
<?php if (isset($discarded) && $discarded == TRUE) echo "<p>Notice: CV is discarded</p>"; ?>
