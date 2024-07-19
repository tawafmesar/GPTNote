
<?php
ob_start();

session_start();

  include 'files/ini.php';

  $pagetitle = 'Login';
  if (isset($_SESSION['username'])) {

    $do = isset($_GET['do']) ?  $_GET['do'] : 'manage';

    // START MANAGE page

     if ($do == 'manage'){

            // start manage items page

              $userid =  $_SESSION['userid'];
               // select all users exept Admin

               $stmt = $con->prepare("SELECT
                                            tasks.* ,
                                            users.UserName AS User ,
                                            list.list

                                            FROM tasks

                                            INNER JOIN
                                                users
                                            ON
                                                users.user_id = tasks.user_id

                                            INNER JOIN
                                                list
                                            ON
                                                list.list_id = tasks.list

                                              WHERE tasks.user_id = :zid

                                           ORDER BY
                                                 task_id
                                            DESC
                                             ");

               // execute the statement

               $stmt->execute(array('zid' => $userid));


               // assign to variable

               $items = $stmt->fetchall();

               if (! empty($items)) {


             ?>
             <div style="background-color: #f7fafd;;">

             <!-- Header -->
             <header class="header">
                 <div class="container">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="text-container">
                                 <h1>إدارة المهام</h1>
                                 <p class="p-large p-heading"> <i class="fas fa-user"></i> المستخدم : <?php echo $_SESSION['username']; ?> </p>
                                 <a class="btn-outline-reg" href="addTask.php"><i class="fab fa-apple"></i>إضافة مهمة </a>


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


           <div class="container"  >
                 <div class="table-responsive">
                       <table class="main-table text-center table table-borderd">
                             <tr>
                                 <td>#ID</td>
                                 <td>المهمة</td>
                                 <td>التاريخ</td>
                                 <td>الوقت</td>
                                 <td>القائمة</td>
                                 <td>الأهمية</td>
                                 <td>الأنجاز</td>

                             </tr>

                             <?php

                                 foreach ($items as $item) {
                                       echo "<tr>";
                                             echo "<td>" . $item['task_id'] . "</td>" ;
                                             echo "<td>" . $item['task'] . "</td>" ;
                                             echo "<td>" . $item['dueDate'] . "</td>" ;
                                             echo "<td>" . $item['dueTime'] . "</td>" ;
                                             echo "<td>" . $item['list'] ."</td>" ;
                                             echo "<td>" . $item['priority'] ."</td>" ;
                                           echo "<td> <input type='checkbox' >
                                           </td>";
                                       echo "</tr>";
                                 }

                              ?>

                       </table>
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
          // end manage items page


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
