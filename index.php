<?php
ob_start();
session_start();

include 'files/ini.php';

?>

<!-- Header -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-container">
                    <h1>GPT Note</h1>
                    <p class="p-large p-heading">
                    Is develop an innovative note-taking platform leveraging ChatGPT's capabilities to transform concise prompts into comprehensive notes. This platform addresses the challenge of organizing and expanding upon thoughts and concepts efficiently. </p>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="image-container">
                    <img class="img-fluid" src="images/imgHeadr.gif" style="width: 72%; border-radius: 300px;" alt="alternative">
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
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
<!-- end of header -->

<!-- Small Features -->
<div class="cards-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Set Goals</h5>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-image red">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Note Setup</h5>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-image green">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Note Seve</h5>
                    </div>
                </div>
                <!-- end of card -->


            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of cards-1 -->
<!-- end of small features -->

<!-- Description 2 -->
<div class="tabs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="tabs-container">

                    <!-- Tabs Links -->
                    <ul class="nav nav-tabs" id="cedoTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true"><i class="far fa-clock"></i>Note-taking</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false"><i class="far fa-calendar-alt"></i>Organization</a>
                        </li>
                    </ul>
                    <!-- end of tabs links -->

                    <!-- Tabs Content -->
                    <div class="tab-content" id="cedoTabsContent">
                        <!-- Tab -->
                        <div class="tab-pane fade show active " id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                            <p><strong>Note-taking</strong>&nbsp;  develop an innovative note-taking website leveraging ChatGPT's capabilities to transform concise prompts into comprehensive notes.</p>
                            <ul class="list-unstyled li-space-lg">
                                <li class="media">
                                    <i class="far fa-check-square"></i>
                                    <div class="media-body">You can always add new notes or refine existing ones in your collection. 
                                    </div>
                                </li>
                                <li class="media">
                                    <i class="far fa-check-square"></i>
                                    <div class="media-body">It's easy to continue focusing on your daily activities and those that will bring you closer to your goals.</div>
                                </li>

                            </ul>
                            <a class="btn-solid-reg page-scroll" href="terms-conditions.html">Create an Account</a> <a class="btn-outline-reg page-scroll" href="privacy-policy.html">Login</a>
                        </div> <!-- end of tab-pane -->
                        <!-- end of tab -->

                        <!-- Tab -->
                        <div class="tab-pane fade " id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                            <p>Use the power of AI to generate and organize notes on your daily.</p>
                            <ul class="list-unstyled li-space-lg">
                                <li class="media">
                                    <i class="far fa-check-square"></i>
                                    <div class="media-body">Our site empowers you to become a more organized individual without the fear of losing valuable insights.</div>
                                </li>
                                <li class="media">
                                    <i class="far fa-check-square"></i>
                                    <div class="media-body">With our intuitive tools and user-friendly interface, you'll discover a newfound sense of clarity and productivity.</div>
                                </li>
                            </ul>
                        </div> <!-- end of tab-pane -->
                        <!-- end of tab -->
                    </div> <!-- end of tab-content -->
                    <!-- end of nav tabs content -->

                </div> <!-- end of tabs-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
                <div class="image-container">
                    <img class="img-fluid desc1" src="images/desc2.gif" alt="alternative">
                    <img class="img-fluid desc2" src="images/desc1.gif" alt="alternative">
                </div> <!-- end of image-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of tabs -->
<!-- end of description 2 -->

<!-- Statistics -->
<div class="counter">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Counter -->
                <div id="counter">
                    <div class="cell">
                        <i class="fas fa-users"></i>
                        <div class="counter-value number-count" data-count="370">370</div>
                        <p class="counter-info">Users</p>
                    </div>
                    <div class="cell">
                        <i class="fas fa-code green"></i>
                        <div class="counter-value number-count" data-count="2340">2340</div>
                        <p class="counter-info">Notes Taked</p>
                    </div>

                    <div class="cell">
                        <i class="fas fa-rocket blue"></i>
                        <div class="counter-value number-count" data-count="221">221</div>
                        <p class="counter-info">Visitors</p>
                    </div>
                </div>
                <!-- end of counter -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of counter -->
<!-- end of statistics -->

<?php
include 'files/foot.php';
ob_end_flush();
?>
