<?php
include 'includes/session.inc.php';
require_once 'includes/functions.inc.php';

$schools = $silang->getSchools();
$barangays = $silang->getBarangays(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <?php
    include 'partials/title.php';
    ?>
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
            <div class="page-header m-0">
                <h3 class="page-title mb-6 ml-4">School Building</h3>

                <!-- page tabs -->
                <div class="border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center dark:text-gray-400">
                        <li class="mr-2">
                            <a href="bldg-list.php" class="inline-flex align-items-center gap-2 p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                <span>
                                    <i class="fa-solid fa-table-list"></i>
                                </span>
                                <span> List of Buildings </span>
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="#" class="inline-flex align-items-center gap-2 p-4 bg-white rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group">
                                <span>
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                <span> Add Building </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-body">

                <form action="includes/add-bldg.inc.php" method="POST" enctype="multipart/form-data">
                    <div class="lg:flex gap-4">
                        <div class="form-images">
                            <!-- Profile Image -->
                            <div class="profile-pic-div mb-5 lg:mb-auto">
                                <img src="assets/images/uploads/bldg_default.jpg" alt="" id="photo" />
                                <input type="file" name="bldg_image" id="file" novalidate />
                                <label for="file" id="uploadBtn">Change Image</label>
                            </div>
                            <h1 class="mt-5 font-semibold">Sample Defects Found:</h1>
                            <!-- defects Images -->
                            <div id="dropArea" class="drop-area">
                                <span class="drop-text">Drag and drop images here. <br>or click the + <br></span>
                                <label for="imageUpload" class="file-upload-label">
                                    <i class="fas fa-plus"></i>
                                    <input type="file" id="imageUpload" name="defect_img[]" multiple>
                                </label>

                                <div id="previewContainer"></div>
                            </div>

                        </div>


                        <div class="w-full flex flex-col space-y-4">
                            <div>
                                <input type="hidden" name="school_id" id="school_id" />
                                <label for="">School</label>
                                <!-- Toggle Modal -->
                                <input type="text" name="school_name" id="school_name" readonly data-modal-target="school-modal" data-modal-toggle="school-modal" placeholder="School" class="w-full rounded" />
                            </div>
                            <!-- Main modal -->
                            <div id="school-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="school-modal">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <!-- Modal header -->
                                        <div class="px-6 py-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-base font-semibold text-gray-900 lg:text-xl dark:text-white">
                                                Select School
                                            </h3>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6">
                                            <table id="schools-table" class="row-border hover" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th style="display: none">ID</th>
                                                        <th style="width: 100%">School Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($schools as $school) { ?>
                                                        <tr id="<?php echo $school['school_id'] ?>" style="cursor: pointer" data-modal-hide="school-modal">
                                                            <td style="display: none"><?php echo $school['school_id'] ?></td>
                                                            <td style="width: 100%"><?php echo $school['school_name'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="">Building Name</label>
                                <input type="text" name="building_name" class="w-full rounded" required />
                            </div>
                            <div>
                                <label for="">Year Established</label>
                                <input type="number" name="year_established" id="year_established" maxlength="4" name="year" min="1900" max="2099" placeholder="XXXX" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Location</label>
                                <input type="text" name="location" placeholder="" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Number of Storey</label>
                                <input type="text" name="storey" placeholder="" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Year/Edition of NSCP Used:</label>
                                <input type="text" name="year_nscp" placeholder="" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Type of Building</label>
                                <input type="text" name="type_of_bldg" placeholder="" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Type of Structure</label>
                                <input type="text" name="type_of_structure" placeholder="" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Design Occupancy</label>
                                <input type="text" name="design_occupancy" placeholder="" class="w-full rounded" />
                            </div>

                            <div>
                                <h3 class="mt-2 font-semibold text-lg">Summary Report</h3>
                                <hr>
                            </div>

                            <div>
                                <label for="">RVS Score</label>
                                <input type="text" name="rvs_score" placeholder="" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Vulnerability</label>
                                <input type="text" name="vulnerability" placeholder="" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Physical Conditions</label>
                                <textarea name="physical_conditions" id="" cols="30" rows="6" class="w-full rounded-lg p-2"></textarea>
                            </div>
                            <div>
                                <label for="">Compliance to Accessibility Law</label>
                                <input type="number" name="compliance" placeholder="0-100" step="0.01" min="0" max="100" class="w-full rounded" />
                            </div>
                            <div>
                                <label for="">Hazard/Risk Mitigation actions</label>
                                <textarea name="mitigation_actions" id="" cols="30" rows="6" class="w-full rounded-lg p-2"></textarea>
                            </div>

                            <button type="submit" name="add-bldg" id="submitButton" class="w-full block mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <script src="assets/js/sidebar.js"></script>
    <script src="assets/js/select-school.js"></script>
    <script src="assets/js/uploading-img.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $("#schools-table").DataTable({});
        });
    </script>
</body>

</html>