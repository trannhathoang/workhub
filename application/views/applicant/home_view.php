<h2>Home</h2>

<h3>Search</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('applicant/verify_search'); ?>
  <input type="text" size="60" name="search" placeholder="Job name"
    value="<?php echo set_value('search'); ?>"/>
  <input type="submit" value="Search"/>
  <br/>

  <select name="region">
    <option value="0">Any region</option>
    <?php
    foreach ($regions as $row) {
      echo '<option value="'.$row['RID'].'" '.($row['RID'] == set_value('region') ? 'selected' : '').'>'.$row['Name'].'</option>';
    }
    ?>
  </select>

  <select name="category">
    <option value="0">Any category</option>
    <?php
    foreach ($categories as $row) {
      echo '<option value="'.$row['CAID'].'" '.($row['CAID'] == set_value('category') ? 'selected' : '').'>'.$row['Name'].'</option>';
    }
    ?>
  </select>

  <select name="level">
    <option value="0">Any level</option>
    <?php
    foreach ($levels as $row) {
      echo '<option value="'.$row['JLID'].'" '.($row['JLID'] == set_value('level') ? 'selected' : '').'>'.$row['Name'].'</option>';
    }
    ?>
  </select>

</form>

<table>
  <tr>
    <?php if (isset($cvs) && $cvs != NULL) { ?>
    <th><h3>Your CVs</h3></th>
    <?php } /* Close if */ ?>

    <?php if (isset($applications) && $applications != NULL) { ?>
    <th><h3>Your Applications</h3></th>
    <?php } /* Close if */ ?>
  </tr>
  <tr>
    <td>
      <!-- View CVs -->
      <?php if (isset($cvs) && $cvs != NULL) { ?>
      <table border="1">
        <tr>
          <th>ID</th>
          <th>Subject</th>
          <th>Active</th>
          <th>NoI</th>
        </tr>

        <?php foreach ($cvs as $row) if ($row['Status'] > DISABLED) { ?>
        <tr>
          <td><?php echo $row['CID']; ?></td>
          <td><?php echo $row['Subject']; ?></td>
          <td><?php echo ($row['Status'] == ACTIVE ? 'Yes' : '-'); ?></td>
          <td><?php echo count($invs[$row['CID']]); ?></td>
          <td><?php echo anchor('applicant/managecvs/examine/'.$row['CID'], 'Examine'); ?></td>
          <td><?php echo anchor('applicant/cv/edit/'.$row['CID'], 'Edit'); ?></td>
          <td><?php echo anchor('applicant/cv/discard/'.$row['CID'], 'Discard'); ?></td>
        </tr>
        <?php } /* Close 'foreach if' */ ?>
      </table>
      <?php } /* Close if */ ?>
    </td>

    <td>
      <!-- View Applications -->
      <?php if (isset($applications) && $applications != NULL) { ?>
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
      <?php } /* Close if */ ?>
    </td>
  </tr>
</table>
