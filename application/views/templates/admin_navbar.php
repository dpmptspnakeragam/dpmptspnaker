<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white elevation-2">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-maroon" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.main-sidebar');
            const pushMenuButton = document.querySelector('[data-widget="pushmenu"]');

            pushMenuButton.addEventListener('click', () => {
                // Toggle class to check if sidebar is minimized
                sidebar.classList.toggle('sidebar-mini');
            });
        });
    </script>
    <style>
        /* Default state: normal sidebar */
        .main-sidebar .brand-link .brand-image:first-child {
            display: none;
            /* Hide small logo */
        }

        .main-sidebar .brand-link .brand-image:last-child {
            display: block;
            /* Show normal logo */
        }

        /* Sidebar minimized */
        .main-sidebar.sidebar-mini .brand-link .brand-image:first-child {
            display: block;
            /* Show small logo */
        }

        .main-sidebar.sidebar-mini .brand-link .brand-image:last-child {
            display: none;
            /* Hide normal logo */
        }
    </style>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Role -->
        <li class="nav-item">
            <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#logoutModal">
                Logout
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </li>
    </ul>
</nav>
<!-- /.navbar -->