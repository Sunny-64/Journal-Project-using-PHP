<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- <link rel="stylesheet" href="../../assets/css/style.css"> -->

</head>

<body>
  <!-- ============!!!!! Header !!!!!!============== -->
  <header>

    <nav class="navbar navbar-expand-lg  pt-2">
      <div class="container">

        <div class="col-md-4 col-lg-2 col-xl-4 d-flex justify-content-start align-items-center">

          <a class="navbar-brand online-journal-txt text-wrap online-journal-txt" href="#">
            <h2>Online Journal</h2>
          </a>

        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse  col-md-7 " id="myNavbar">

          <ul class="navbar-nav nav-bg">
            <li class="nav-item ">
              <a class="nav-link  px-4 fs-5  <?php echo ($page == "index.php" ? "active-nav-link" : "") ?> " href="index.php">Dashboard</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link  px-4 fs-5  <?php echo ($page == "journals.php" ? "active-nav-link" : "") ?> " href="journals.php">Journals</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link px-4  fs-5   <?php echo ($page == "events.php" ? "active-nav-link" : "") ?> " href="events.php">Events</a>
            </li>
            <!--<li class="nav-item ">
               <a class="nav-link px-4  fs-5   <?php // echo ($page == "events.php" ? "active-nav-link" : "" )
                                                ?> " href="events.php">Events</a> 
            </li>-->
            <li class="nav-item ">
                <a class="nav-link px-4 fs-5   <?php echo ($page == "contactRecords.php" ? "active-nav-link" : "") ?> " href="contactRecords.php">Contact Records</a>
              </li>
            <!-- <li class="nav-item ">
                <a class="nav-link px-4 fs-5   <?php echo ($page == "answers.php" ? "active-nav-link" : "") ?> " href="answers.php">Answers</a>
              </li> -->
          </ul>

          <form action="" method="GET">
            <button class="nav-link px-4 fs-5 text-bg-primary" name="logout" type="submit" style="border : none; height:46px">Logout</button>
          </form>
        </div>

      </div>
    </nav>

  </header>

  <?php
  if (isset($_GET['logout'])) {
    echo "This code is running"; 
    session_unset();
    session_destroy();
    echo "<script> window.location.assign('login.php');</script>";
  }
  ?>