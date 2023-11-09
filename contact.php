<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg, 70);

// send email
$recipient_email = "giorgisurmanidze917@gmail.com";
$subject = "My subject";
$sender_email = "your_email@example.com"; // Replace this with a valid sender email

// Additional headers, if required
$headers = 'From: ' . $sender_email;

// Sending the email
if (mail($recipient_email, $subject, $msg, $headers)) {
    echo "Email sent successfully";
} else {
    echo "Failed to send email";
}
if (isset($_POST['submit'])) {
    $to = 'giorgisurmanidze917@gmail.com';
    $subject = $_POST['subject'];
    $body = $_POST['body'];
}

?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="subject" name="subject" id="subject" class="form-control"
                                    placeholder="Enter your subject">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <textarea id='body' class="form-control" name="body" cols="50" rows="10"></textarea>
                            </div>
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>

    <?php include "includes/footer.php"; ?>