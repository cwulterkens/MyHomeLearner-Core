<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2B9RQRJ6W3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2B9RQRJ6W3');
    </script>


    <!-- Favicons -->
    <link href="phoenix/img/favicon.png" rel="icon">
    <link href="phoenix/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <?= $this->Html->css(['/phoenix/vendor/bootstrap/css/bootstrap.min']) ?>
    <?= $this->Html->css(['/phoenix/vendor/bootstrap-icons/bootstrap-icons']) ?>
    <?= $this->Html->css(['/phoenix/vendor/boxicons/css/boxicons.min']) ?>
    <?= $this->Html->css(['/phoenix/vendor/quill/quill.snow']) ?>
    <?= $this->Html->css(['/phoenix/vendor/quill/quill.bubble']) ?>
    <?= $this->Html->css(['/phoenix/vendor/remixicon/remixicon']) ?>
    <?= $this->Html->css(['/phoenix/vendor/simple-datatables/style']) ?>

    <!-- Template Main CSS File -->
    <?= $this->Html->css('/phoenix/css/style', ['id' => 'lightThemeStylesheet']) ?>
    <?= $this->Html->css('/phoenix/css/style-dark', ['id' => 'darkThemeStylesheet']) ?>

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.5.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
<script>
(function() {
  // Function to handle theme switch
  var handleThemeSwitch = function() {
    var lightStylesheet = document.getElementById('lightThemeStylesheet');
    var darkStylesheet = document.getElementById('darkThemeStylesheet');
    var icon = document.querySelector('#darkModeToggle i');

    if (lightStylesheet.disabled) {
      lightStylesheet.disabled = false;
      darkStylesheet.disabled = true;
      localStorage.setItem('theme', 'light');
      icon.classList.remove('bi-sun');
      icon.classList.add('bi-moon');
    } else {
      lightStylesheet.disabled = true;
      darkStylesheet.disabled = false;
      localStorage.setItem('theme', 'dark');
      icon.classList.remove('bi-moon');
      icon.classList.add('bi-sun');
    }
  };

  // Function to handle theme recovery
  var handleThemeRecovery = function() {
    var lightStylesheet = document.getElementById('lightThemeStylesheet');
    var darkStylesheet = document.getElementById('darkThemeStylesheet');
    var icon = document.querySelector('#darkModeToggle i');
    var savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'dark') {
      lightStylesheet.disabled = true;
      darkStylesheet.disabled = false;
      icon.classList.remove('bi-moon');
      icon.classList.add('bi-sun');
    } else {
      lightStylesheet.disabled = false;
      darkStylesheet.disabled = true;
      icon.classList.remove('bi-sun');
      icon.classList.add('bi-moon');
    }
  };

  // Disable the dark mode stylesheet by default
  var darkStylesheet = document.getElementById('darkThemeStylesheet');
  darkStylesheet.disabled = true;

  // Check local storage for theme preference and handle theme recovery
  handleThemeRecovery();

  // Listen for the DOMContentLoaded event to enable the theme switcher
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('darkModeToggle').addEventListener('click', function(e) {
      e.preventDefault();
      handleThemeSwitch();
    });
  });
})();
</script>


</head>

<body class="toggle-sidebar">

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="/phoenix/img/logo.svg" alt="">
            <span class="d-none d-lg-block">MyHomeLearner</span>
        </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

<li class="nav-item d-block">
    <a id="darkModeToggle" class="nav-link nav-icon" href="#">
        <i class="bi bi-moon"></i>
    </a>
</li>
            <?php if ($currentUser !== null): ?>
            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <?php if ($notificationsCount !== 0): ?>
                    <span class="badge bg-primary badge-number">
                            <?= $notificationsCount ?>
                        <?php endif; ?>
                    </span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have <?= $notificationsCount ?> new notification(s)
                        <a href="/notifications"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <?php foreach ($notificationsList as $notification): ?>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                       <li class="notification-item">
			<i class="bi bi-exclamation-circle text-<?= $notification->importance ?>"></i>
                        <div>
                            <h4><?= $this->Html->link(($notification->subject), ['controller' => 'Notifications', 'action' => 'view', $notification->id]) ?></h4>
                            <p><?= substr($notification->content, 0, 50) ?>
                                <?php if (strlen($notification->content) > 50): ?>
                                    ...
                                <?php endif; ?></p>
                            <p><?= $notification->created ?></p>
                        </div>
<?= $this->Form->postLink('X', ['controller' => 'Notifications', 'action' => 'markAsRead', $notification->id], ['class' => 'text-black-50 mark-as-read-button']);?>
                    </li>
                    <?php endforeach; ?>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="/notifications">Show all notifications</a>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->
            <?php endif; ?>
            <?php if ($currentUser !== null): ?>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="<?= $currentUser->avatar_url ?>" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">My Profile</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?= $currentUser->first_name ?> <?= $currentUser->last_name ?></h6>
                        <span><?= $currentUser->email ?></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/users/view/<?php echo $currentUser->id?>">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="https://community.myhomelearner.com">
                            <i class="bi bi-people"></i>
                            <span>Community</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="https://docs.myhomelearner.com">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>


                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/users/logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
            <?php endif; ?>
            <?php if ($currentUser == null): ?>
                <?= $this->Html->link('Login', ['controller' => 'users', 'action' => 'login'], ['escape' => false, 'class' => 'btn btn-sm btn-secondary px-3 me-3']);?>
            <?php endif; ?>
        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<main id="main" class="main">
    <?php echo $this->fetch('content'); ?>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>MyHomeLearner</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Developed by <a href="https://www.wulterkens.tech/" target="_blank">Wulterkens Technology Solutions</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?= $this->Html->script(['/phoenix/vendor/apexcharts/apexcharts.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/bootstrap/js/bootstrap.bundle.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/chart.js/chart.umd']) ?>
<?= $this->Html->script(['/phoenix/vendor/echarts/echarts.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/quill/quill.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/simple-datatables/simple-datatables']) ?>
<?= $this->Html->script(['/phoenix/vendor/tinymce/tinymce.min']) ?>
<?= $this->Html->script(['/phoenix/js/search']) ?>
<script>
    tinymce.init({
        selector: 'textarea:not(.no-tinymce)',  // change this value according to your HTML
        plugins: 'advlist autolink lists link charmap print preview anchor code emoticons wordcount',
        toolbar: 'undo redo | formatselect | bold italic sizeselect fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        menubar: true,
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        statusbar: true,
        branding: false,
        promotion: false
    });
</script>
<?= $this->Html->script(['/phoenix/vendor/php-email-form/validate']) ?>

<!-- Template Main JS File -->
<?= $this->Html->script(['/phoenix/js/main']) ?>

<script>
(function() {
  // Function to handle theme switch
  var handleThemeSwitch = function() {
    var lightStylesheet = document.getElementById('lightThemeStylesheet');
    var darkStylesheet = document.getElementById('darkThemeStylesheet');
    var icon = document.querySelector('#darkModeToggle i');

    if (lightStylesheet.disabled) {
      lightStylesheet.disabled = false;
      darkStylesheet.disabled = true;
      localStorage.setItem('theme', 'light');
      icon.classList.remove('bi-sun');
      icon.classList.add('bi-moon');
    } else {
      lightStylesheet.disabled = true;
      darkStylesheet.disabled = false;
      localStorage.setItem('theme', 'dark');
      icon.classList.remove('bi-moon');
      icon.classList.add('bi-sun');
    }
  };

  // Function to handle theme recovery
  var handleThemeRecovery = function() {
    var lightStylesheet = document.getElementById('lightThemeStylesheet');
    var darkStylesheet = document.getElementById('darkThemeStylesheet');
    var icon = document.querySelector('#darkModeToggle i');
    var savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'dark') {
      lightStylesheet.disabled = true;
      darkStylesheet.disabled = false;
      icon.classList.remove('bi-moon');
      icon.classList.add('bi-sun');
    } else {
      lightStylesheet.disabled = false;
      darkStylesheet.disabled = true;
      icon.classList.remove('bi-sun');
      icon.classList.add('bi-moon');
    }
  };

  // Disable the dark mode stylesheet by default
  var darkStylesheet = document.getElementById('darkThemeStylesheet');
  darkStylesheet.disabled = true;

  // Check local storage for theme preference and handle theme recovery
  handleThemeRecovery();

  // Listen for the DOMContentLoaded event to enable the theme switcher
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('darkModeToggle').addEventListener('click', function(e) {
      e.preventDefault();
      handleThemeSwitch();
    });
  });
})();
</script>



</body>

</html>
