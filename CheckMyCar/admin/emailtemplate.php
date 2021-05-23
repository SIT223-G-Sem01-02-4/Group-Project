<?php
// Include the root "main.php" file
include 'main.php';

// Get all the defined variable keys and values
if (isset($_POST['activationemailtemplate'])) {
    file_put_contents('../admin/emailtemplates/activation-email-template.html', $_POST['activationemailtemplate']);
}
if (isset($_POST['contactusemailtemplate'])) {
    file_put_contents('../admin/emailtemplates/contactus-email-template.html', $_POST['contactusemailtemplate']);
}

// Read the activation email template HTML file
$activationemailcontents = file_get_contents('../admin/emailtemplates/activation-email-template.html');
$contactusemailcontents = file_get_contents('../admin/emailtemplates/contactus-email-template.html');
?>

<?=template_admin_header('Email Templates - Admin Panel')?>

<h2>Activiation Email Template</h2>
<div class="content-block">
    <form action="" method="post" class="form responsive-width-100">
        <textarea name="activationemailtemplate"><?=$activationemailcontents?></textarea>
        <input type="submit" value="Save">
    </form>
</div>

<br>
<br>

<h2>ContactUs Email Template</h2>
<div class="content-block">
    <form action="" method="post" class="form responsive-width-100">
        <textarea name="contactusemailtemplate"><?=$contactusemailcontents?></textarea>
        <input type="submit" value="Save">
    </form>
</div>

<?=template_admin_footer()?>
