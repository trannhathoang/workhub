<h2>Applications</h2>

<table border="1">
  <tr>
    <th>CV Subject</th>
    <th>Job</th>
    <th>Employer</th>
    <th>Status</th>
  </tr>

  <?php foreach ($applications as $row) { ?>
  <tr>
    <td><?php echo $row['Subject']; ?></td>
    <td><?php echo $row['Job_Name']; ?></td>
    <td><?php echo $row['Employer_Name']; ?></td>
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
