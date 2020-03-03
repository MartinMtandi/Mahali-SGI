<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$results = '';
$error = '';

if(isset($_POST['submit'])){
  require 'vendor/autoload.php';

  $mail = new PHPMailer(true);

  try{
    //Server settings
    $mail->SMTPDebug = false;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.zoho.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'pazorora@mahali-sgi.com';                     // SMTP username
    $mail->Password   = 'TateTina+2';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($_POST['email'], 'Mailer');
    $mail->addAddress('pazorora@mahali-sgi.com', 'Mahali SGI');     // Add a recipient
    $mail->addReplyTo($_POST['email'], 'Client Email');
    $mail->addCC('rumbidzai@mahali-sgi.com');

    // Attachments
    $mail->addAttachment('img/sgi.png');         // Add attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $_POST['subject'];
    $mail->Body    = $_POST['message'] . '<br><br><br> Kind regards <br>' . $_POST['firstname'] . ' ' . $_POST['lastname'];

    $mail->send();
    $results = 'Message has been sent';
    echo $results;

  }catch (Exception $e) {
    $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    echo $error;
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cinzel|Josefin+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Mahali SGI</title>
    
  </head>
  <body>
   <div class="wrapper" id="wrap">
    <img src="img/sgi.png" alt="">
    <p class="down-icon">
      <a href="#target"><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
    </p>
    <section class="box"></section>
    <section class="section content" data-spy="scroll" data-target="#wrap">
      <h1 id="company-name">Mahali SGI</h1>
      <p class="tagline">Mahali SGI is an investment partnership that designs, develops, finances, and operates social infrastructure.</p>
      <p class="tagline">Our team has Southern African roots, wide global reach and combined expertise in project development, strategy, operations and infrastructure asset management.</p>
      <div class="container" id="target">
      <h1 id="company-name">Contact Us</h1>
      <?php if($results !== ''){ ?>
      <div class="alert alert-primary" role="alert">
        <?php echo $results; ?>
      </div>
      <?php } ?>
      <form action="" method="post" class="form">
        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="text" class="form-control form-control-lg" name="firstname" placeholder="Firstname" autocomplete="off" required>
          </div>
          <div class="form-group col-md-6">
            <input type="text" class="form-control form-control-lg" name="lastname" placeholder="Lastname" autocomplete="off" required>
          </div>
        </div>
        <div class="form-group">
          <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control form-control-lg" name="subject" placeholder="Subject" required>
        </div>
        <div class="form-group">
          <textarea name="message" class="form-control form-control-lg" id="msg" rows="5"style="min-width: 100%" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-block">Submit</button>
      </form>
      </div>
      <footer>
        &copy <script>document.write(new Date().getFullYear())</script> Powered by BKG Technologies
      </footer>
    </section>

   </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>