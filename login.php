<?php
ob_start();

session_start();

include 'files/ini.php';

$pagetitle = 'Login';
if (isset($_SESSION['username'])) {
    header('Location: tasks.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashpass = sha1($password);

        // check if the user exists in the database

        $stmt = $con->prepare("SELECT
                                    user_id   ,UserName, password
                             FROM
                                    users
                             WHERE
                                 email = :zemail
                             AND
                                    password = :zpassword");
        $stmt->execute(array(
          'zemail' => $email ,
          'zpassword' => $hashpass
        ));

        $get = $stmt->fetch();
        $count = $stmt->rowCount();

        // if count > 0, this means the database contains a record about this username

        if ($count > 0) {
            $_SESSION['username'] =  $get['UserName'];      // register session name
            $_SESSION['userid'] = $get['user_id'];    // register user id in session
            header('Location: notes.php');      // redirect to the dashboard page
            exit();
        } else {
            $formErrors[] = 'Invalid username or password';
        }

    } else {
        // check the signup if valid or not before sending info to the database
        $formErrors = array();
        $username   = $_POST['username'];
        $password = $_POST['password'];
        $email    = $_POST['email'];
        $phone      = $_POST['phone'];

        if (isset($username)) {
            // filter the username from any script
            $filteruser = filter_string_polyfill($username);

            if (strlen($filteruser) < 4) {
                $formErrors[] = 'Username must be larger than 4 characters';
            }
        }

        if (empty($formErrors)) {
            // check if the user exists in the database
            $stmt = $con->prepare("SELECT
                                            user_id   ,UserName, password
                                     FROM
                                            users
                                     WHERE
                                            UserName = :zusername
                              ");
            $stmt->execute(array(
                'zusername' => $username
            ));

            $get = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($count == 1 ) {
                $formErrors[] = 'The entered username already exists';
            } else {
                // insert user info into the database VALUES(:zuser, :zpass , :zmail , :zname)");

                $stmt = $con->prepare("INSERT INTO
                                        users(UserName, password, email  , phone , notes)
                                    VALUES(:zusername, :zpassword , :zemail  ,:zphone ,1)");
                $stmt->execute(array(
                    'zusername' => $username,
                    'zpassword' => sha1($password),
                    'zemail' => $email ,
                    'zphone' => $phone
                ));

                // echo success message

                $succesMsg = 'Account created successfully..';
            }
        }
    }
}

?>

<link rel="stylesheet" href="css/login.css">
<header class="header" style="padding-top:8rem;">

    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab" style="margin-right:133px;">Login <i class="fas fa-sign-in-alt"></i></label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign up</label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="group">
                            <label for="email" class="label" style="cursor:default;" >Email</label>
                            <input id="email" name="email" type="email" class="input" required >
                        </div>

                        <div class="group">
                            <label for="pass" class="label" style="cursor:default;">Password</label>
                            <input id="pass" name="password" type="password" class="input" required data-type="password">
                        </div>

                        <?php
                        if (! empty($formErrors)){
                            foreach ($formErrors as $error) {
                                echo '<div class="msg">' . $error . '</div>';
                            }
                            header("refresh:3;url=login.php");
                        }

                        if (isset($succesMsg)) {
                            echo '<div class="msg">' . $succesMsg . '</div>';
                            header("refresh:3;url=login.php");
                        }
                        ?>
                        <div class="group">
                            <input type="submit"  name="login" class="btn-solid-reg" style="width:100%; padding: 20px" value="Login">
                        </div>
                    </form>
                </div>
                <div class="sign-up-htm">
                    <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="group">
                            <label for="user" class="label" style="cursor:default;">Username</label>
                            <input id="user" name="username" type="text" required class="input">
                        </div>
                        <div class="group">
                            <label for="email" class="label" style="cursor:default;" >Email</label>
                            <input id="email" name="email" type="email" class="input" required >
                        </div>
                        <div class="group">
                            <label for="pass" class="label" style="cursor:default;">Password</label>
                            <input id="pass" name="password" type="password" required class="input" data-type="password">
                        </div>

                        <div class="group">
                            <label for="phone" class="label" style="cursor:default;">Phone</label>
                            <input id="phone" name="phone" type="tel" class="input">
                        </div>
                        <div class="group">
                            <input type="submit" name="signup" class="btn-solid-reg" style="width:100%; padding: 20px" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="deco-white-circle-1">
        <img src="images/decorative-white-circle.svg" alt="alternative">
    </div> <!-- end of deco-white-circle-1 -->
    <div class="deco-white-circle-2">
        <img src="images/decorative-white-circle.svg" alt="alternative">
    </div> <!-- end of deco-white-circle-2 -->
    <div class="deco-blue-circle">
        <img src="images/decorative-blue-circle.svg" alt="alternative">
    </div> <!-- end of deco-blue-circle -->
    <div class="deco-yellow-circle">
        <img src="images/decorative-yellow-circle.svg" alt="alternative">
    </div> <!-- end of deco-yellow-circle -->
    <div class="deco-green-diamond">
        <img src="images/decorative-green-diamond.svg" alt="alternative">
    </div> <!-- end of deco-yellow-circle -->
</header> <!-- end of header -->

<?php
include 'files/foot.php';
ob_end_flush();
?>
