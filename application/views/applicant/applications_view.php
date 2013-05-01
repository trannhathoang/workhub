<h2>Applications</h2>

<?php
if (isset($discarded) && $discarded == TRUE) {
  echo '<p>Application is discarded</p>';
}
?>

<table border="1">
  <tr>
    <th>CV Subject</th>
    <th>Job</th>
    <th>Employer</th>
  </tr>

  <?php foreach ($applications as $row) if ($row['Status'] > DISABLED) { ?>
  <tr>
    <td><?php echo $row['Subject']; ?></td>
    <td><?php echo $row['Job_Name']; ?></td>
    <td><?php echo $row['Employer_Name']; ?></td>
    <td><?php echo anchor('applicant/applications/discard/'.$row['CID'].'/'.$row['JID'], 'Discard'); ?></td>
  </tr>
  <?php } /* Close 'foreach if' */ ?>
</table>
