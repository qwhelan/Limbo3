<?php
require_once( 'db.php');
require_once('config.php');
if (array_key_exists('message',$_POST)) {
  $message = strip_tags($_POST['message']);
} else {
  $message = '';
}
if(!empty($_POST['submit']) && !empty($_POST['username'])) {
  require_once('recaptchalib.php');
  $privatekey = "6LeiR78SAAAAAD2B_KoFz01GIb290ArC_QEPzDJ9";
  $resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." . "(reCAPTCHA said: " . $resp->error . ")");
  } else {
  $_POST['username'] = trim($_POST['username']);
  if (is_numeric($_POST['username'])) {
    $message = 'I need a more sensible name to call you by.';
  } else {
    // FIXME: We should transactionify account creation
    $user = UserQuery::create()->findOneByUsername($_POST['username']);
    if (is_null($user)) {
      $user = new User();
      $user->setUsername(strip_tags($_POST['username']));
      $user->setEmail(strip_tags(trim($_POST['email'])));
      $user->setRealName(strip_tags(trim($_POST['name'])));
      $user->save();
      redirect("welcome to the party.");
      die;
    } else {
      $message = "I already know someone by that name.";
    }
  }
}
}
?>
<?php include('templates/header.php'); ?>

<center>
<h1> Do tell me who you are </h1>
<p class="message"> <?= $message ?> </p>
<form method="post">

<script type="text/javascript">
$(document).ready(function() {
  $("input[type=text]#username").focus();
});
</script>

<label for="username">I'm known as </label> <input name="username" id="username" type="text" />, 
<br />
<label for="email">my email address is </label>  <input name="email" type="text" />
<br/>
<label for="name">and my real name is </label>  <input name="name" type="text" />.
<br />
<?php
  require_once('recaptchalib.php');
  $publickey = "6LeiR78SAAAAAAcPaRuBSFk0nzbFiGQZkfNyj06N";
  echo recaptcha_get_html($publickey);
?>
<input value="and that is who I am." class="submit" type="Submit"/>
<input type="hidden" name="submit" value="true" />
</form>
</center>


<?php include( 'templates/footer.php'); ?>
