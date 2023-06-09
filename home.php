<?php
include 'admin/includes/dbh.inc.php';
include 'admin/includes/functions.inc.php';

// $buildingsPerPage = 10; // Number of buildings to fetch per page
// $page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

// // Calculate the offset for pagination
// $offset = ($page - 1) * $buildingsPerPage;

// // Get buildings for the current page
// $buildings = $silang->getBuildingsLazy($buildingsPerPage, $offset);

// // Render the buildings as JSON response
// $response = [
//     'buildings' => $buildings
// ];
// header('Content-Type: application/json');
// echo json_encode($response);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Document</title>
</head>

<body>

    <nav>
        <div class="wrapper row">
            <h1 class="nav-brand">Brand</h1>
            <ul class="nav-links">
                <li class="nav-item active">
                    <a href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a href="">About Us</a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="wrapper">
            <div class="card-container" id="card-container">
                <script id="card-template" type="text/x-handlebars-template">
                    <div class="card">
    <div class="card-img">
      <img src="{{imageUrl}}" alt="" srcset="">
    </div>
    <div class="card-body">
      <h3 class="card-title">{{buildingName}}</h3>
      <p>Card description</p>
    </div>
  </div>
</script>
            </div>
        </div>
    </main>

    <script src="assets/js/lazy-load.js"></script>
    <script src="assets/js/handlebars.min-v4.7.7.js"></script>


</body>

</html>