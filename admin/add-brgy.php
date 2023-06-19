<?php
include 'includes/session.inc.php';
include 'includes/functions.inc.php';
include 'includes/modals.inc.php';
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
            <?php
            include 'includes/query-results.inc.php';
            ?>

            <div class="page-header">
                <h3 class="page-title">Add Barangay</h3>
            </div>
            <div class="page-body">
                <form action="includes/add-brgy.inc.php" method="POST" class="mb-10 w-full md:inline-flex gap-3 flex-wrap">
                    <div class="w-full mb-3 md:mb-0 lg:flex-none lg:w-1/2">
                        <input type="text" name="barangay_name" placeholder="Barangay Name" required class="w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <button type="submit" name="add-brgy" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full md:w-auto px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Barangay</button>
                </form>

                <table id="barangays-table" class="row-border hover">
                    <thead>
                        <tr>
                            <th>Barangay Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barangays as $barangay) { ?>
                            <tr>
                                <td><?php echo $barangay['barangay_name'] ?></td>
                                <td>
                                    <!-- Modal toggle -->
                                    <button data-modal-target="<?php echo $barangay['barangay_id'] ?>" data-modal-toggle="<?php echo $barangay['barangay_id'] ?>" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:focus:ring-yellow-900">Edit</button>

                                    <?php editBarangay($barangay) ?>


                                    <button type="button" id="deleteBtn" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        <a href="includes/del-brgy.inc.php?id=<?php echo $barangay['barangay_id'] ?>" onclick="return confirm('Are you sure you want to delete this barangay?')">Delete</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#barangays-table').DataTable({
                autoFill: true,
                responsive: true
            });

        });
    </script>
</body>

</html>