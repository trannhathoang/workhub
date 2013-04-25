<h2>Manage Jobs</h2>
<div>Add</div>
<ul>
  <?php foreach ($jobs as $row) { ?>
  <li><?php echo $row['Name']; ?></li>
  <?php } ?>
</ul>
