<?php
    session_start();
    $page = "events.php";


    if (!isset($_SESSION['adminLoggedIn']) || $_SESSION['adminLoggedIn'] != true) {


        header("location: login.php", true);
        exit();
    }
    $adminId = $_SESSION['adminId'];
    // echo $_SESSION['adminId'];
    

    include "assets/header.php";
    require '../config.php';

    $q = "select * from events where status= 'pending'";
    $result = mysqli_query($conn, $q);
    foreach ($result as $event) {
?>

    <section id="journal-posts" class="my-4 p-4">
        <div class="container j-container ">
            <div class="j-post p-4 ">
                <!-- Journal Post header section -->
                <div class="j-post-header d-flex offset-lg-1">
                    <!-- user image and name -->
                    <div class="user-data d-flex justify-content-end me-5">

                        <?php
                        $uId = $event['user_id'];
                        $query = "select UserFName,userLName,userImage from `user` WHERE user_id= $uId";
                        $exec = mysqli_query($conn, $query);

                        foreach ($exec as $value) {

                        ?>
                            <div class="profile-icon-container">

                                <img src="../userProfiles/<?php echo $value['userImage']; ?>" class="profile-icon rounded-circle img-fluid" alt="icon">
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
                    <!-- <div class="j-date-and-options d-flex col-sm-5 col-md-7 justify-content-end">
                        <div class="date d-flex  me-5">
                                <p class="pt-2">1/1/11</p>
                            </div> 
                         <div class="options btn">
                            <span class="dots"></span>
                            <span class="dots"></span>
                            <span class="dots"></span>
                        </div>
                    </div> -->
                </div>
                <!-- Journal title and content. -->
                <div class="journal-title-and-content col-lg-10 offset-lg-1 mt-4">
                    <div class="">
                        <h5><?php echo $event['e_name'] ?></h5>
                    </div>
                    <hr>
                    <div class="">
                        <h6><?php echo $event['e_date'] ?></h6>
                    </div>
                    <hr>
                    <div class="">
                        <h6><?php echo $event['e_time'] ?></h6>
                    </div>
                    <hr>
                    <div class="">
                        <h6><?php echo $event['e_location'] ?></h6>
                    </div>
                    <hr>
                    <div class="">
                        <h6><?php echo $event['e_type'] ?></h6>
                    </div>
                    <hr>
                    <div class="">
                        <h6><?php echo $event['e_requirements'] ?></h6>
                    </div>
                    <hr>
                    <div class=" mt-4">
                        <p><?php echo $event['e_desc'] ?></p>
                    </div>
                </div>

                <form class="j-like-section offset-lg-1 mt-5 row" action="" method="POST">
                    <div class="d-flex align-items-center col-sm-6  px-0">
                        <button name="<?php echo "approve".$event['id'];?>" type="submit" class="btn btn-primary">Approve</button>
                    </div>
                    <div class="reject-btn d-flex justify-content-center col-sm-6  px-0">
                        <button name="<?php echo "reject".$event['id'];?>" type="submit" class="btn btn-primary">Reject</button>
                    </div>
                </form>
                <?php 
                    if(isset($_POST["approve".$event['id']])){
                        $eId = $event['id']; 
                        $updateQuery = "UPDATE events SET status='approved' WHERE id='$eId'"; 
                        $fireUpdateQuery = mysqli_query($conn, $updateQuery); 
                        if($fireUpdateQuery > 0){
                            echo "Approved";
                        }else{
                            echo "Error".mysqli_error($conn); 
                        }
                    }
                     if(isset($_POST["reject".$event['id']])){
                        $eId = $event['id']; 
                        $deleteQuery = "DELETE FROM events WHERE id='$eId'"; 
                        $fireDeleteQuery = mysqli_query($conn, $deleteQuery); 
                        if($fireDeleteQuery > 0){
                            echo "deleted";
                            echo "<script> windows.location.reload(); </script>"; 
                        }else{
                            echo "Error".mysqli_error($conn); 
                        }                   
                    }
                ?>
            </div>
        </div>
    </section>


<?php
}
// require('../../partials/footer.php');
?>