<h2>Manage Jobs</h2>

<?php echo anchor('employer/job', 'Add'); ?>
<ul>
  <?php foreach ($jobs as $row) { ?>
  <li><?php echo $row['Name']; ?></li>
  <?php } ?>
</ul>
