<nav class="sidebar">
    <a class="sidebar__logo" href="#" target="_blank" title="Visit Link">
        <div>
            <div class="logo-img">
                <img src="./assets/images/silang_cavite_logo.jpg" alt="Logo of Silang" />
            </div>
        </div>
        <h1 class="barangay-name font-semibold">Silang, Cavite</h1>
    </a>

    <ul class="sidebar__links">
        <li>
            <p>Main</p>
        </li>

        <li class="sidebar__links-submenu">
            <a href="#dropdown" class="dropdown-button">
                <span class="sidebar__links-icon"><i class="fa-solid fa-sliders"></i></span>
                <span class="sidebar__links-text">Sample</span>
                <span class="dropdown-arrow"><i class="fa-solid fa-caret-down"></i></span>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item">
                    <a href="#">
                        <i class="fa-solid fa-arrow-right"></i>
                        <p class="sidebar__links-text">Change me 1</p>
                    </a>
                </li>
                <li class="sub-menu-item">
                    <a href="#">
                        <i class="fa-solid fa-arrow-right"></i>
                        <p class="sidebar__links-text">Change me 2</p>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo $barangayURL ?>admin/account/index.php">
                <span class="sidebar__links-icon"><i class="fa-solid fa-users-gear"></i></span>
                <p class="sidebar__links-text">Account</p>
            </a>
        </li>
    </ul>
</nav>