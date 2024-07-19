
<?php
ob_start();

session_start();

  include 'files/ini.php';

  $pagetitle = 'Login';
  if (!isset($_SESSION['username'])) {
    echo '<div class="msg" style="color#3d4c74;; font-size:20px;" >To add notes you must login </div>' ;
    header("refresh:2.5;url=login.php");
  }


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addNote'])) {

    $note = filter_string_polyfill($_POST['note']);

    $list  = filter_var($_POST['list'], FILTER_SANITIZE_NUMBER_INT);

        $formErrors = array();

        if (empty($formErrors)) {


          $stmt = $con->prepare("SELECT
                  list_content
          FROM
                  list
          WHERE
                  list_id = :zlistid
        ");
        $stmt->execute(array(
        'zlistid' => $list
        ));
        $get = $stmt->fetch();

        $systemContent = $get['list_content'];
        $userContent = $note;
          
          $messages = send_message(
              [
                  "role" => "user",
                  "content" => $userContent,
              ],
              $api_key,
              $systemContent,
              $userContent
          );

          // get response from ChatGPT
          $message = $messages[count($messages)-1];

          $_SESSION['msg'] = $message->content;   
          $_SESSION['list'] = $list ;    

          echo '

          <script>
              $(document).ready(function(){
                  $("#exampleModalScrollable").modal("show");
                  $("#exampleModalScrollable .close").click(function() {
                    $("#exampleModalScrollable").modal("hide");
                });
              });
          </script>';





                      }
    }
    if (isset($_POST['addNotetodb'])) {
           
           
      $note_title = filter_string_polyfill($_POST['title']);

      $note_details= $_SESSION['msg'];

      $list = $_SESSION['list'];
      
      
      //$list
      $userid =  $_SESSION['userid'];

            $stmt = $con->prepare("INSERT INTO
                                    notes(note_title, note_details	 ,list  , user_id )
                                    VALUES(:ztitle, :zdetails  , :zlist , :zuserId   )");
            $stmt->execute(array(

                  'ztitle'     =>  $note_title ,
                  'zdetails'     =>  $note_details  ,
                  'zlist'    =>  $list ,
                  'zuserId'   => $userid 
            ));

      if($stmt) {

        $succesMsg = 'The note added successfully.. ';

      }

    }
  }
   ?>

		<link rel="stylesheet" href="css/login.css">
    <header class="header" style="padding-top:8rem;">

		<div class="login-wrap">
			<div class="login-html">
        <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

				<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Add Note</label>
				<input id="tab-2" type="reset" name="tab" class="sign-up"><label for="tab-2" class="tab" style="color:#ff556e;float:left; margin-right:50px;">Clear</label>
				<div class="login-form">
        <div class="group">
        <label for="list" class="label"  style="cursor:default;">list </label>
            <select 
            id="list"
            name="list"
            style="
            width: 100%;
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            font-weight: 700;"  required name="list">
                  <option  value="" class="input" >Type</option>
                  <?php
                        $con;
                        $getAll = $con->prepare("SELECT * from list  ORDER BY list_id ASC
                                   ");
                        $getAll->execute();
                        $cats = $getAll->fetchall();
                       foreach ($cats as $cat) {
                         echo "<option value='" . $cat['list_id'] . "' > " . $cat['list'] . " </option>";
                       }
                   ?>
            </select>
          </div>

          <div class="group">
  <label for="textarea" class="label" style="cursor: default;">Note </label>
  <textarea id="textarea" class="input" name="note" rows="3" cols="80" required></textarea>
</div>
      <script>
      document.addEventListener('DOMContentLoaded', () => {
          const textareaEle = document.getElementById('textarea');
          const maxHeight = 320; /* Maximum height: 320px */

          textareaEle.addEventListener('input', () => {
              textareaEle.style.height = 'auto';
              textareaEle.style.height = `${Math.min(textareaEle.scrollHeight, maxHeight)}px`;
          });
      });
      </script>
                <?php
                      if (! empty($formErrors)){
                          foreach ($formErrors as $error) {
                            echo '<div class="msg">' . $error . '</div>';
                          }
                          header("refresh:3;url=addNotes.php");
                      }

                      if (isset($succesMsg)) {
                        echo '<div class="msg">' . $succesMsg . '</div>' ;
                        header("refresh:3;url=addNotes.php");

                        }

                 ?>
                    <div class="group">
                        <input type="submit"  name="addNote"  class="btn-solid-reg" style="width:80%; padding: 20px" value="Submit">
                        <button type="button" class="btn-outline-sm " style=" padding: 15px"  data-toggle="modal" data-target="#exampleModalScrollable">
                      <i class="fas fa-robot" style=" font-size: 30px" ></i>
                    </button>
                      </div>

                  
					</div>
        </form>

				</div>
			</div>
		</div>


                <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <?php 
                 if (isset($message)) {?>
                   <div class="modal fade bd-example-modal-lg" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog  modal-lg modal-dialog-scrollable " role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
                        <div class="group">
                            <input  name="title" type="text" required class="input">
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" style="text-align: left;">
                        <?php

                        // $contents = $message->content;
                        // $htmlOutput = convertToHTML($content);
                        
                        echo "\nChatGPT: " .  $message->content  . "\n";?>
                      </div>
                      <div class="modal-footer">
                        <button type="submit"  name="addNotetodb" class="btn btn-primary">Save changes</button>
                      </div></div>
                    </div>
                  </div>

                
                <?php
                           }else{
                              ?>
                <div class="modal fade bd-example-modal-lg" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog  modal-lg modal-dialog-scrollable " role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">How Can i help you</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      \nChatGPT: how can i hel[ you
                    </div>
                  </div>
                </div>
                </div>

                           <?php }
                             ?>
                </form>

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


  <?php
		  include 'files/foot.php';
		  ob_end_flush();
		  ?>
