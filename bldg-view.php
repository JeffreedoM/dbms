<?php
include 'admin/includes/dbh.inc.php';
include 'admin/includes/functions.inc.php';

$id = $_GET['id'];
$building = $silang->getOneBuilding($id);
$defects = $silang->getDefectImages($id);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

    <!-- for pie -->
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
    <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/magnify.css">
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

        .image-viewer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1001;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .image-viewer.active {
            opacity: 1;
            pointer-events: auto;
        }

        .image-viewer img {
            max-width: 90%;
            max-height: 90%;
        }

        .anychart-credits {
            visibility: hidden;
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
                        <a href="bldg-audit.php?id=" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
                    </li>
                    <li>
                        <a href="school-view.php?id=" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About Us</a>
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

            <!-- Breadcrumb -->
            <div class="flex px-5 py-3 mb-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="bldg-audit.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Schools
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="school-view.php?id=<?php echo $building['school_id'] ?>" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white"><?php echo $building['school_name'] ?></a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400"><?php echo $building['building_name'] ?></span>
                        </div>
                    </li>
                </ol>
            </div>

            <div class="building">
                <div class="left">
                    <!-- Building Image -->
                    <?php if (!empty($building['bldg_image'])) : ?>
                        <img src="admin/assets/images/uploads/<?php echo $building['bldg_image']; ?>" alt="" id="bldg-img" />
                    <?php else : ?>
                        <img src="admin/assets/images/uploads/bldg_default.jpg" alt="" id="bldg-img" />
                    <?php endif; ?>

                    <h3>Sample Defects Found:</h3>
                    <div class="defect-images">
                        <?php foreach ($defects as $defect) : ?>
                            <img src="admin/assets/images/uploads/<?php echo $defect['defect_images']; ?>" alt="defect image" onclick="openImageViewer(this)">

                        <?php endforeach ?>
                    </div>

                    <div class="image-viewer" onclick="closeImageViewer()">
                        <img id="fullImage">
                    </div>

                </div>
                <div class="right">
                    <h2>Building Information</h2>
                    <dl class="details">
                        <div>
                            <dt>Year Established</dt>
                            <dd><?php echo $building['year_established'] ?></dd>
                        </div>
                        <div>
                            <dt>Location</dt>
                            <dd><?php echo $building['location'] ?></dd>
                        </div>
                        <div>
                            <dt>Number of Storey</dt>
                            <dd><?php echo $building['storey'] ?></dd>
                        </div>
                        <div>
                            <dt>Year/Edition of NSCP Used</dt>
                            <dd><?php echo $building['year_nscp'] ?></dd>
                        </div>
                        <div>
                            <dt>Type of Building</dt>
                            <dd><?php echo $building['type_of_bldg'] ?></dd>
                        </div>
                        <div>
                            <dt>Type of Structure</dt>
                            <dd><?php echo $building['type_of_structure'] ?></dd>
                        </div>
                        <div>
                            <dt>Design Occupancy</dt>
                            <dd><?php echo $building['design_occupancy'] ?></dd>
                        </div>

                        <h3>Summary Report</h3>
                        <div>
                            <dt>RVS Score</dt>
                            <dd><?php echo $building['rvs_score'] ?></dd>
                        </div>
                        <div>
                            <dt>Vulnerability</dt>
                            <dd><?php echo $building['vulnerability'] ?></dd>
                        </div>
                        <div>
                            <dt>Physical Conditions</dt>
                            <dd><?php echo $building['physical_conditions'] ?></dd>
                        </div>
                        <!-- <dt style="background: none; border:none;">Compliance</dt> -->
                        <div id="container" style="width: 100%; height: 400px;"></div>
                        <div>
                            <dt>Hazard/Risk Mitigation Actions</dt>
                            <dd><?php echo $building['mitigation_actions'] ?></dd>
                        </div>

                    </dl>


                </div>
            </div>

        </div>
    </main>

    <script src="assets/js/jquery.magnify.js" charset="utf-8"></script>
    <script>
        $(document).ready(function() {
            $('.zoom').magnify();
        });

        function openImageViewer(element) {
            const imageViewer = document.querySelector('.image-viewer');
            const fullImage = document.getElementById('fullImage');
            const imageUrl = element.src;

            fullImage.src = imageUrl;
            imageViewer.classList.add('active');
        }

        function closeImageViewer() {
            const imageViewer = document.querySelector('.image-viewer');
            imageViewer.classList.remove('active');
        }
    </script>
    <script>
        anychart.onDocumentReady(function() {
            // create pie chart with passed data
            var chart = anychart.pie3d([
                ['Yes', 62.5],
                ['No', (100 - 62.5)],

            ]);

            // set chart title text settings
            chart
                .title('Compliance').radius('100%');

            // set the position of the legend
            chart.legend()
                .position("right")
                .align("top")
                .itemsLayout("vertical");

            // set container id for the chart
            chart.container('container');
            // initiate chart drawing
            chart.draw();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</body>

</html>