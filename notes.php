
<?php
ob_start();

session_start();

  include 'files/ini.php';

  if (isset($_SESSION['username'])) {
 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['showitem'])) {

        $itemid = $_POST['itemid'];

        $stmt = $con->prepare("SELECT * FROM notes WHERE note_id = ?");

            $stmt->execute(array($itemid));

            $item   = $stmt->fetch();
            $count = $stmt->rowCount();
        if ($count > 0) {
            echo '
            <script>
                $(document).ready(function(){
                    $("#exampleModalScrollable").modal("show");
                    $("#exampleModalScrollable .close").click(function() {
                      $("#exampleModalScrollable").modal("hide");
                  });
                });
            </script>';
            ?>
         <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
         <input type="hidden" name="itemid" value="<?php echo $item['note_id']; ?>">
        <div class="modal fade bd-example-modal-lg" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
           <div class="modal-dialog  modal-lg modal-dialog-scrollable " role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h3 class="modal-title" id="exampleModalScrollableTitle"><?php echo $item['note_title'] ; ?></h3>
                 <h4 class="modal-title" id="exampleModalScrollableTitle"><?php echo $item['note_time'] ; ?></h4>
                 <h5 class="modal-title" id="exampleModalScrollableTitle"><?php echo $item['list'] ; ?></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body" style="text-align: left;">
                  <?php echo $item['note_details'] ; ?>
               </div>
               <div class="modal-footer">
                 <button type="submit"  name="deletenote" class="btn-solid-reg">Delete</button>
               </div></div>
             </div>
           </div>
         </form>

         
         <?php
        }
    }

    if (isset($_POST['deletenote'])) {

        $itemid = $_POST['itemid'];

          $stmt = $con->prepare("DELETE FROM notes WHERE note_id = ?");

            $stmt->execute(array($itemid));

            $count = $stmt->rowCount();
        if ($count > 0) {

            $succesMsg = 'The note deleted';

        }
    }
}
    $do = isset($_GET['do']) ?  $_GET['do'] : 'manage';

     if ($do == 'manage'){

              $userid =  $_SESSION['userid'];

               $stmt = $con->prepare("SELECT
                                            notes.* ,
                                            users.UserName AS User ,
                                            list.list

                                            FROM notes

                                            INNER JOIN
                                                users
                                            ON
                                                users.user_id = notes.user_id

                                            INNER JOIN
                                                list
                                            ON
                                                list.list_id = notes.list

                                              WHERE notes.user_id = :zid
                                              
                                           ORDER BY
                                                 note_id
                                            DESC
                                             ");

               $stmt->execute(array('zid' => $userid));
               $items = $stmt->fetchall();

               if (! empty($items)) {


             ?>
             <div style="background-color: #f7fafd;;">

             <!-- Header -->
             <header class="header"style="padding-top: 7rem;" >
                 <div class="container">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="text-container">
                                 <h1>Notes</h1>

                                 <a class="btn-outline-reg" href="addNotes.php"><i class="fas fa-plus"></i> Add New Note </a>
                             </div> <!-- end of text-container -->
                         </div> <!-- end of col -->
                     </div> <!-- end of row -->
             </header> <!-- end of header -->
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
             <div class="container">
    <div class="row">
    <?php
                                 
                                 if (isset($succesMsg)) {
                                     echo '<div class="overlay"  id="overlay"><h1 >';
                                         echo $succesMsg ;
                                     echo '</h1></div>';
                                     echo '<script>';
                                     echo '    document.addEventListener("DOMContentLoaded", function() {';
                                     echo '        var overlay = document.getElementById("overlay");';
                                     echo '        overlay.style.display = "flex";';
                                     echo '        setTimeout(function() {';
                                     echo '            overlay.style.display = "none";'; 
                                     echo '        }, 2000);';
                                     echo '    });';
                                     echo '</script>';
                                            }
                              ?>
    <?php

$colors = array("bg-primary", "bg-info", "bg-warning", "bg-danger", "bg-success", "bg-secondary","bg-dark");
shuffle($colors);
$index = 0;
foreach ($items as $item) {
    $color = $colors[$index];
    echo "<div class='col-lg-4 col-md-6 mb-3 aa'>";
    echo "<form class='formcard' action='{$_SERVER["PHP_SELF"]}' method='post'>";
    echo '<input type="hidden" name="itemid" value="' . $item['note_id'] . '">';
    echo '<button type="submit" name="showitem">';
    // echo '<a href="notes.php?do=Show&itemid=' . $item['note_id'] . '">';
    echo "<div class='card text-white $color' style='max-width: 23rem;'>";
    echo "<div class='card-header text-white'>" . htmlspecialchars($item['note_title']);
    echo "</div>";
    echo "<div class='card-body' style='max-height: 200px;  overflow-y: auto;'>";
    echo "<h5 class='card-title text-white'>" . htmlspecialchars($item['note_details']) . "</h5>";
    echo "<p class='card-text text-white'>" . htmlspecialchars($item['note_time']) . "</p>";
    echo "</div>";
    echo "</div>";
    echo '</button>';

    // echo "</a>";

    echo "</form>";
    echo "</div>";
    $index++;
    if ($index == 6) {
        $index = 0;
    }
}    

?>
    </div>
</div>

       <?php   }else {
           echo '<div class="container">';
             echo '<div class="nice-message">There\'s No Items To Show</div>';
             echo '<a href="items.php?do=Add" class="btn btn-sm btn-primary">
                 <i class="fa fa-plus"></i> New Item
               </a>';
           echo '</div></div> ';

         }

       }elseif ($do == 'Show'){

       }

     } else {

         header('Location: login.php');

         exit();
     }


?>
  <?php
		  include 'files/foot.php';
		  ob_end_flush();
		  ?>
