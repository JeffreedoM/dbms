<?php
include 'admin/includes/dbh.inc.php';
include 'admin/includes/functions.inc.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/main.css">
    <title>DBMS</title>

    <style>
        #search-select {
            width: 200% !important;
        }

        option {
            font-size: 1rem;
        }
    </style>

</head>


<body>

    <nav class="">
        <div class="wrapper row">
            <h1 class="nav-brand">Jeep.</h1>
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

    <form class="mt-10">
        <div class="wrapper">
            <div class="flex mx-auto">
                <!-- <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label> -->
                <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">Search by Category <svg aria-hidden="true" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg></button>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <div class="" aria-labelledby="dropdown-button">
                        <div class="flex gap-1" id="search-select">
                            <select name="barangay" id="" class="w-full rounded-lg border-none text-sm text-gray-900 border border-gray-300">
                                <option value="" disabled selected>Barangay</option>
                                <option value="">Barangay 1</option>
                            </select>
                            <select name="school" id="" class="w-full rounded-lg border-none text-sm text-gray-900 border border-gray-300">
                                <option value="" disabled selected>School</option>
                                <option value="">School 1</option>
                            </select>
                            <button></button>
                        </div>
                    </div>
                </div>
                <div class="relative w-full">
                    <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Mockups, Logos, Design Templates..." required>
                    <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <main>
        <div class="wrapper">
            <div class="card-container" id="card-container">
                <!-- Content in here will be dynamic -->
            </div>
        </div>
    </main>

    <button class="scroll-to-top"><i class="fa-solid fa-arrow-up"></i> </button>

    <script src="assets/js/lazy-load.js"></script>
    <script src="assets/js/handlebars.min-v4.7.7.js"></script>
    <script src="assets/js/scroll-to-top.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

</body>

</html>