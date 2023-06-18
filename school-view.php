<?php
include 'admin/includes/dbh.inc.php';
include 'admin/includes/functions.inc.php';

$id = $_GET['id'];
$school = $silang->getSchoolById($id);

$buildings = $silang->getBuildingBySchoolId($id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/main.css">
    <title>DBMS</title>

    <style>
        nav {
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px,
                rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
            height: 70px;
            background-color: white;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="wrapper max-w-screen-lg flex flex-wrap items-center justify-between mx-auto py-4 md:py-0">
            <a href="#" class="flex items-center">
                <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" /> -->
                <span class="self-center text-lg font-semibold whitespace-nowrap text-blue-700">Building Audits <span class="text-gray-500"> in Silang </span></span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="home.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
                    </li>
                    <li>
                        <a href="about.php" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About Us</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Building Audits</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <main>
        <div class="wrapper">
            <h1 class="text-3xl text-center font-semibold my-4"><?php echo $school['school_name'] ?></h1>

            <div class="mb-4 border-b border-gray-200 dark:border-gray-700 ">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Site Development Plan</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">List of Buildings</button>
                    </li>
                </ul>
            </div>
            <div id="myTabContent">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p> -->
                    <div>
                        <img src="admin/assets/images/uploads/<?php echo $school['sitedev_plan'] ?>" alt="" class="mx-auto w-full">
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <!-- <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p> -->
                    <!-- Cards -->
                    <div class="card-container" id="card-container">
                        <?php foreach ($buildings as $building) : ?>
                            <div class="cards">
                                <a href="bldg-view.php?id=<?php echo $building['building_id'] ?>" target="_blank">
                                    <div class="card-img">
                                        <?php if (!empty($building['bldg_image'])) : ?>
                                            <img src="admin/assets/images/uploads/<?php echo $building['bldg_image']; ?>" alt="" srcset="" />
                                        <?php else : ?>
                                            <img src="admin/assets/images/uploads/bldg_default.jpg" alt="" srcset="" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $building['building_name'] ?></h3>
                                        <p><?php echo $building['location'] ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>

                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>