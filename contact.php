<?php
ob_start();
session_start();
include 'files/ini.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['addmsg'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    $successMsg = 'Your message has been sent. We will contact you as soon as possible.';
  }
}
?>

             <!-- Header -->
             <header class="header" style="margin-bottom: -120px;">
                 <div class="container">
                     <div class="row">
                         <div class="col-lg-12">
                         </div> <!-- end of col -->
                     </div> <!-- end of row -->

             </header> <!-- end of header -->

<div style="background-color: #f7fafd;">
  <link rel="stylesheet" href="css/login.css">
  <div class="deco-white-circle-1">
    <img src="images/decorative-white-circle.svg" alt="alternative">
  </div>
  <!-- end of deco-white-circle-1 -->
  <div class="deco-white-circle-2">
    <img src="images/decorative-white-circle.svg" alt="alternative">
  </div>
  <!-- end of deco-white-circle-2 -->
  <div class="deco-blue-circle">
    <img src="images/decorative-blue-circle.svg" alt="alternative">
  </div>
  <!-- end of deco-blue-circle -->
  <div class="deco-yellow-circle">
    <img src="images/decorative-yellow-circle.svg" alt="alternative">
  </div>
  <!-- end of deco-yellow-circle -->
  <div class="deco-green-diamond">
    <img src="images/decorative-green-diamond.svg" alt="alternative">
  </div>
  <!-- end of deco-yellow-circle -->

  <div class="container">
    <div class="login-wrap">
      <div class="login-html">
        <div id="name" class="login-form">
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="group">
              <label for="name" class="label" style="cursor:default;">Name</label>
              <input name="name" type="text" class="input">
            </div>
            <div class="group">
              <label for="phone" class="label" style="cursor:default;">Phone</label>
              <input name="phone" type="tel" class="input">
            </div>
            <div class="group">
              <label for="email" class="label" style="cursor:default;">Email (optional)</label>
              <input name="email" type="email" class="input">
            </div>
            <div class="group">
              <label for="task" class="label" style="cursor:default;">Message</label>
              <textarea class="input" name="msg" rows="4" cols="80"></textarea>
            </div>
            <?php
            if (isset($successMsg)) {
              echo '<div class="msg">' . $successMsg . '</div>';
              header("refresh:3;url=index.php");
            }
            ?>
            <div class="group">
              <input type="submit" name="addmsg" class="btn-solid-reg" class="btn-solid-reg" style="width:100%; padding: 20px" value="Send">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include 'files/foot.php';
ob_end_flush();
?>
