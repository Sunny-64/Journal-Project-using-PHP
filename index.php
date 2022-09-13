<?php
$page = "index.php";
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header("location: login.php", true);
    exit();
}
$uId = $_SESSION['userId'];

require('./partials/header.php');
require "config.php";

?>
<!-- title section -->
<section id="title">

    <div class="container">
        <div class="title-container col-lg-7 offset-lg-2 col-xl-7 offset-xl-4 pt-2 ">
            <h1>Share your Journal with everyone. </h1>
            <p>Write a journal with your own words. This platform lets your journal visible to every user. Lorem
                ipsum dolor sit.</p>
        </div>
    </div>
</section>

<!-- content section -->
<?php
    if(isset($_GET['msg'])){
        ?>
        <div class="col-12 alert alert-success my-3"> Journal Posted Successfully.
</div>
        <?php
    }
?>
<section id="create-post" class="my-4 p-4">
    <div class="container c-p-container">
        <div class="create-post-container p-4 d-flex ">
            <div class="profile-icon-container offset-md-1">
                <?php
                $selectUserImg = "SELECT userImage FROM user WHERE user_id = $uId";
                $fireQuery = mysqli_query($conn, $selectUserImg);
                foreach ($fireQuery as $userImage) {
                ?>
                    <img src="./userProfiles/<?php echo $userImage['userImage'];
                                            } ?>" class="profile-icon rounded-circle img-fluid" alt="icon">
            </div>
            
            <!-- Button trigger modal -->
            <button type="button" class="btn col-8 col-md-8 ms-5 text-center share-post-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Write a journal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Write Journal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <input type="text" name="journalTitle" spellcheck="false" class="form-control" id="exampleInputText" placeholder="Journal Title">
                                </div>
                                <div class="mb-3">
                                    <!-- <label for="message-text" class="col-form-label">Message:</label> -->
                                    <textarea class="form-control" spellcheck="false" name="journalDescription" id="message-text" placeholder="Write journal here..." style="height:200px;"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary">Add images</button> -->
                                    <button type="submit" name="journalSubmit" class="btn btn-primary">Post</button>
                                </div>
                            </form>
                            <?php
                        
                            $title = (isset($_POST['journalTitle']) ? $_POST['journalTitle'] : "");
                            $description = (isset($_POST['journalDescription']) ? $_POST['journalDescription'] : "");
                            $status = "pending";

                            if (isset($_POST['journalSubmit'])) {
                                require "config.php";
                                $q = "Insert into `journals` (`title`,`description`, `status`, `user_id`) values ('$title','$description', '$status', '$uId')";

                                $result = mysqli_query($conn, $q);

                                if ($result > 0) {
                                    //echo "Journal Posted Successfully";
                                    echo "<script>window.location.assign('index.php?msg');</script>";
                                } else {
                                    echo "insertion failed <br>";
                                    echo mysqli_error($conn);
                                    echo "<br>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Posts Section -->
<?php
require 'config.php';

$q = "select * from journals where status= 'approved' order by date desc";

$result = mysqli_query($conn, $q);

foreach ($result as $journal) {
?>
    <section id="journal-posts" class="my-4 p-4">
        <div class="container j-container ">
            <div class="j-post p-4 ">
                <!-- Journal Post header section -->
                <div class="j-post-header d-flex offset-lg-1">
                    <!-- user image and name -->
                    <div class="user-data d-flex justify-content-end me-5">
                        <?php
                        $uId = $journal['user_id'];
                        $query = "select UserFName,userLName,userImage from `user` WHERE user_id= $uId";
                        $exec = mysqli_query($conn, $query);

                        foreach ($exec as $value) {

                        ?>
                            <div class="profile-icon-container">
                                <img src="userProfiles/<?php echo $value['userImage']; ?>" class="profile-icon img-fluid" alt="icon">
                            </div>
                            <div class="user-name-j-post">
                                <p class="pt-2 ps-3 userName fw-semibold">
                                <?php
                                echo $value['UserFName'] . " " . $value['userLName'];
                            }
                                ?>
                                </p>
                            </div>
                    </div>
                    <!-- date of journal and options btn  -->
                    <div class="j-date-and-options d-flex col-sm-5 col-md-7 justify-content-end">
                        <!-- <div class="date d-flex  me-5">
                                <p class="pt-2">1/1/11</p>
                            </div> -->
                        <!-- <div class="options btn">
                            <span class="dots"></span>
                            <span class="dots"></span>
                            <span class="dots"></span>
                        </div> -->
                    </div>
                </div>
                <!-- Journal title and content. -->
                <div class="journal-title-and-content col-lg-10 offset-lg-1 mt-4">
                    <div class="journal-title">
                        <h5><?php echo $journal['title']; ?></h5>
                    </div>
                    <div class="journal-content">
                        <p><?php echo $journal['description']; ?></p>
                    </div>
                </div>
                <div class="j-like-section offset-lg-1 mt-4 ">
                    <div class="btn j-like-btn d-flex align-items-center col-md-1 px-0">
                        <img src="./assets/images/heart-solid.svg" class="j-like-btn-img" alt="like">
                        <p class="ms-2">Like</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
}
?>
<?php
require('./partials/footer.php');
?>