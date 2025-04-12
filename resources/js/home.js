document.addEventListener('DOMContentLoaded', function () {
    // Sidebar Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.dashboard-sidebar');
    const dashboardContent = document.querySelector('.dashboard-content');

    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
            document.body.classList.toggle('sidebar-open');
        });
    }

    // Close sidebar when clicking outside
    dashboardContent.addEventListener('click', function (event) {
        // Only process if sidebar is active and not clicking on menu toggle
        if (sidebar.classList.contains('active') &&
            !event.target.closest('.menu-toggle') &&
            !event.target.closest('.dashboard-sidebar')) {
            sidebar.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        }
    });

    // Dropdown Toggles
    const dropdownToggles = document.querySelectorAll('.dashboard-nav-dropdown-toggle');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const parent = this.parentElement;

            // Close all other dropdowns
            const allDropdowns = document.querySelectorAll('.dashboard-nav-dropdown');
            allDropdowns.forEach(dropdown => {
                if (dropdown !== parent) {
                    dropdown.classList.remove('active');
                }
            });

            // Toggle the clicked dropdown
            parent.classList.toggle('active');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dashboard-nav-dropdown')) {
            const allDropdowns = document.querySelectorAll('.dashboard-nav-dropdown');
            allDropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
            });
        }
    });
});
