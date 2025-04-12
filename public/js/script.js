
document.addEventListener("DOMContentLoaded", function () {
    let currentPath = window.location.pathname;
    const menuItems = document.querySelectorAll('.toolbar-menu a');

    // Gán class 'active' cho menu tương ứng với URL hiện tại
    menuItems.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }

        // Xử lý sự kiện click trên menu
        link.addEventListener('click', function () {
            menuItems.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Xử lý toggle menu sidebar
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            document.body.classList.toggle('sidebar-open');
        });
    }

    // Xử lý dropdown trong dashboard navigation
    document.querySelectorAll('.dashboard-nav-dropdown-toggle').forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            this.parentElement.classList.toggle('open');
        });
    });
});

