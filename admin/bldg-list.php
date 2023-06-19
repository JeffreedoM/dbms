<?php
include 'includes/session.inc.php';
include 'includes/functions.inc.php';

$schools = $silang->getSchools();
$barangays = $silang->getBarangays();
$buildings = $silang->getBuildings();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="assets/css/main.css">
    <title>DBMS</title>
</head>

<body>
    <?php
    include 'partials/nav_sidebar.php';
    ?>

    <main class="main-content">
        <?php
        include 'partials/nav_header.php';
        ?>

        <div class="wrapper">
            <?php
            include 'includes/query-results.inc.php';
            ?>

            <div class="page-header m-0">
                <h3 class="page-title mb-6 my-4 ml-4">School Building</h3>

                <!-- page tabs -->
                <div class="border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center dark:text-gray-400">
                        <li class="mr-2">
                            <a href="#" class="inline-flex align-items-center gap-2 p-4 bg-white rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group">
                                <span>
                                    <i class="fa-solid fa-table-list"></i>
                                </span>
                                <span>
                                    List of Buildings
                                </span>
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="add-school-bldg.php" class="inline-flex align-items-center gap-2 p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                <span>
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                <span>
                                    Add Building
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-body rounded-none">
                <table id="bldg-table" class="row-border hover">
                    <thead>
                        <tr>
                            <th>Building</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($buildings as $building) { ?>
                            <tr>
                                <td><?php echo $building['building_name'] ?></td>
                                <td>
                                    <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm dark:focus:ring-yellow-900">
                                        <a href="edit-bldg.php?id=<?php echo $building['building_id'] ?>" class="block px-5 py-2.5">Edit</a>
                                    </button>
                                    <button type="button" id="deleteBtn" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        <a href="includes/del-bldg.inc.php?id=<?php echo $building['building_id'] ?>" onclick="return confirm('Are you sure you want to delete this barangay?')" class="block px-5 py-2.5">Delete</a>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="assets/js/sidebar.js"></script>
    <script src="assets/js/header.js"></script>
    <script src="assets/js/query-results.js"></script>
    <script src="assets/js/select-school.js"></script>
    <script src="assets/js/uploading-img.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#bldg-table').DataTable({

            });

        });
    </script>
</body>

</html>