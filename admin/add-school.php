<?php
include 'includes/session.inc.php';
include 'includes/functions.inc.php';
include 'includes/modals.inc.php';

$schools = $silang->getSchools();
$barangays = $silang->getBarangays();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.tailwindcss.com"></script>
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
                <h3 class="page-title mb-6 my-4 ml-4">Add School</h3>

                <!-- page tabs -->
                <div class="border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center dark:text-gray-400">
                        <li class="mr-2">
                            <a href="school-list.php" class="inline-flex align-items-center gap-2 p-4 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
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
                                <span> Add School </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-body rounded-none">
                <form action="includes/add-school.inc.php" method="POST" enctype="multipart/form-data" onsubmit="validateForm(event)" class="mb-6">
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay Name</label>
                        <input type="hidden" name="barangay_id" id="barangay_id">
                        <input type="text" name="barangay_name" id="barangay_name" readonly data-modal-target="barangay-modal" data-modal-toggle="barangay-modal" placeholder="Barangay Name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <!-- Main modal -->
                        <div id="barangay-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="barangay-modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <!-- Modal header -->
                                    <div class="px-6 py-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-base font-semibold text-gray-900 lg:text-xl dark:text-white">
                                            Select Barangay
                                        </h3>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6">
                                        <table id="barangays-table" class="row-border hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Barangay Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($barangays as $barangay) { ?>
                                                    <tr id="<?php echo $barangay['barangay_id'] ?>" style="cursor:pointer" data-modal-hide="barangay-modal">
                                                        <td><?php echo $barangay['barangay_id'] ?></td>
                                                        <td><?php echo $barangay['barangay_name'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School Name</label>
                        <input type="text" name="school_name" required placeholder="School Name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Site Development Plan</label>
                        <input type="file" name="sitedev_plan" required class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div>
                        <button type="submit" name="add-school" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add School</button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <script src="assets/js/sidebar.js"></script>
    <script src="assets/js/select-resident.js"></script>
    <script src="assets/js/query-results.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#barangays-table').DataTable({

            });

        });

        function validateForm(event) {
            var brgyNameInput = document.getElementById('barangay_name');

            if (brgyNameInput.value === '') {
                alert('Please select barangay.');
                return false;
            }

            // Continue with form submission or perform other actions
            return true;
        }
    </script>
</body>

</html>