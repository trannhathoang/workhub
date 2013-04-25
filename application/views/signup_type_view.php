<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Sign up</title>
  </head>

  <body>
    <h1>Choose account type</h1>

    <?php echo validation_errors(); ?>

    <?php echo form_open('verify_type'); ?>
      <input type="radio" name="type" value="applicant" checked="checked" />Applicant
      <input type="radio" name="type" value="employer" />Employer
      <br/>

      <input type="submit" value="Next"/>
    </form>
  </body>

</html>
