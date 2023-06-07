<header>
    <div class="burger-menu">
        <i class="fa-solid fa-bars"></i>
    </div>

    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" class="flex items-center text-sm font-medium text-gray-900 rounded hover:text-blue-600 dark:hover:text-blue-500 md:mr-0 dark:focus:ring-gray-700 dark:text-white" type="button">
        <span class="sr-only">Open user menu</span>


        Jeffrey Nuñez
        <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div style="box-shadow: 0px 3px 21px 0px rgb(0 0 0 / 20%)" id="dropdownAvatarName" class="z-10 hidden bg-white divide-y font-normal divide-gray-100 shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
            <div class="font-semibold">name@flowbite.com</div>
            <!-- <div class="truncate">name@flowbite.com</div> -->
        </div>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
            <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Account Settings</a>
            </li>
        </ul>
        <div class="py-2">
            <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
        </div>
    </div>



    <div class="burger-menu2">
        <i class="fa-solid fa-bars"></i>
    </div>
</header>