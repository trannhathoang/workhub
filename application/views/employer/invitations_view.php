<h2>Invitations</h2>

<?php if (isset($invitations) && $invitations != NULL) { ?>
<table border="1">
  <tr>
    <th>Job ID</th>
    <th>Job</th>
    <th>CV ID</th>
    <th>Applicant</th>
    <th>Status</th>
  </tr>

  <?php foreach ($invitations as $row) { ?>
  <tr>
    <td><?php echo $row['JID']; ?></td>
    <td><?php echo $row['Job_Name']; ?></td>
    <td><?php echo $row['CID']; ?></td>
    <td><?php echo $row['Applicant_Name']; ?></td>
    <td><?php
        if ($row['Status'] == ACCEPTED) {
          echo 'Accepted';
        } else if ($row['Status'] == REFUSED) {
          echo 'Refused';
        } else {
          echo 'Waiting';
        }
        ?></td>
  </tr>
  <?php } /* Close 'foreach' */ ?>
</table>
<?php } /* Close if */ ?>
