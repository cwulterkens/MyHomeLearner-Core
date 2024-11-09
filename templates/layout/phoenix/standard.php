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

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="/phoenix/img/logo.svg" alt="">
            <span class="d-none d-lg-block">MyHomeLearner</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

<div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

<li class="nav-item d-block">
    <a id="darkModeToggle" class="nav-link nav-icon" href="#">
        <i class="bi bi-moon"></i>
    </a>
</li>

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

                            <div class="notification-details flex-fill">
                                <h4><?= $this->Html->link(($notification->subject), ['controller' => 'Notifications', 'action' => 'view', $notification->id]) ?></h4>
                                <p><?= substr($notification->content, 0, 50) ?>
                                    <?php if (strlen($notification->content) > 50): ?>
                                        ...
                                    <?php endif; ?>
                                </p>
                                <p><?= $notification->created ?></p>
                            </div>

                            <?= $this->Form->postLink('X', ['controller' => 'Notifications', 'action' => 'markAsRead', $notification->id], ['class' => 'text-large text-black-50 mark-as-read-button']);?>
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

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar d-flex flex-column justify-content-between">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="/learners">
                <i class="bi bi-person"></i>
                <span><?= __('Learners') ?></span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/files">
                <i class="bi bi-folder"></i>
                <span><?= __('Files') ?></span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/journal">
                <i class="bi bi-journal"></i>
                <span><?= __('Journal') ?></span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/courses">
                <i class="bi bi-hurricane"></i>
                <span><?= __('Courses') ?></span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/honors">
                <i class="bi bi-award"></i>
                <span><?= __('Honors') ?></span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/activities">
                <i class="bi bi-lightning"></i>
                <span><?= __('Activities') ?></span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/jobs">
                <i class="bi bi-briefcase"></i>
                <span><?= __('Jobs') ?></span>
            </a>
        </li><!-- End Profile Page Nav -->
        <?php if ($currentUser->admin == 1): ?>
        <li class="nav-heading"><span><?= __('Administration') ?></span></i></li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#dashboard-nav" data-bs-toggle="collapse" href="/files">
                    <i class="bi bi-journal-text"></i><span><?= __('Dashboard') ?></span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="dashboard-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/admin/usage">
                            <i class="bi bi-circle"></i><span><?= __('Analytics') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/reports">
                            <i class="bi bi-circle"></i><span><?= __('Reporting') ?></span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/users">
                <i class="bi bi-people"></i>
                <span><?= __('Users') ?></span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#learners-nav" data-bs-toggle="collapse" href="/files">
                    <i class="bi bi-journal-text"></i><span><?= __('Learners') ?></span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="learners-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/admin/learners">
                            <i class="bi bi-circle"></i><span><?= __('Management') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/files">
                            <i class="bi bi-circle"></i><span><?= __('Files') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/journals">
                            <i class="bi bi-circle"></i><span><?= __('Journals') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/courses">
                            <i class="bi bi-circle"></i><span><?= __('Courses') ?></span>
                        </a>
                    </li>
                   <li>
                        <a href="/admin/honors">
                            <i class="bi bi-circle"></i><span><?= __('Honors') ?></span>
                        </a>
                    </li>
                   <li>
                        <a href="/admin/activities">
                            <i class="bi bi-circle"></i><span><?= __('Activities') ?></span>
                        </a>
                    </li>
                   <li>
                        <a href="/admin/jobs">
                            <i class="bi bi-circle"></i><span><?= __('Jobs') ?></span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

        <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#data-nav" data-bs-toggle="collapse" href="/files">
                    <i class="bi bi-journal-text"></i><span><?= __('Data Management') ?></span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/schoolYears">
                            <i class="bi bi-circle"></i><span><?= __('School Years') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/subjects">
                            <i class="bi bi-circle"></i><span><?= __('Subjects') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/grades">
                            <i class="bi bi-circle"></i><span><?= __('Grades') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/fileTypes">
                            <i class="bi bi-circle"></i><span><?= __('File Types') ?></span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/admin/notifications">
                <i class="bi bi-people"></i>
                <span><?= __('Notifications') ?></span>
            </a>
        </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#audit-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span><?= __('Audit Log') ?></span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="audit-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/audits/index">
                            <i class="bi bi-circle"></i><span><?= __('All') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/audits/web">
                            <i class="bi bi-circle"></i><span><?= __('Web') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="/audits/api">
                            <i class="bi bi-circle"></i><span><?= __('API') ?></span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        <?php endif; ?>
    </ul>
    <div class="p-3 text-center">
        <a href="#" class="d-block" data-bs-toggle="modal" data-bs-target="#reportissue">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span><?= __('Report an Issue') ?></span>
        </a>
    </div>
</aside><!-- End Sidebar-->
<div class="w-100" role="group" aria-label="Basic outlined example">
    <div class="modal fade" id="reportissue" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report an Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $this->Form->create(null, ['url' => ['controller' => 'Support', 'action' => 'reportIssue'], 'id' => 'issueForm']) ?>
                    <div class="form-group">
                        <?= $this->Form->control('issueSubject', ['class' => 'form-control', 'label' => 'Subject']) ?>
                    </div>
                    <div class="form-group pt-3">
                        <?= $this->Form->control('issue', ['class' => 'form-control no-tinymce', 'label' => 'Issue', 'type' => 'textarea', 'placeholder' => 'Please describe your issue...']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                    <!--<div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-personal" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <code class="text-black">What personal information is sent?</code>
                                </button>
                            </h2>
                            <div id="flush-personal" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                <div class="accordion-body text-sm-start"><code class="text-black">To help provide support and communicate updates, some personal information is sent to our support system.  These are listed below.</code></div>
                                <div><code class="text-black">Name:</code> <code><?php echo h($currentUser->first_name); ?> <?php echo h($currentUser->last_name); ?></code></div>
                                <div><code class="text-black">Email:</code> <code><?php echo h($currentUser->email); ?></code></div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-technical" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <code class="text-black">What technical information is sent?</code>
                                </button>
                            </h2>
                            <div id="flush-technical" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                <div class="accordion-body text-sm-start"><code class="text-black">To help provide support, certain technical details are sent to our support system.  These are listed below.</code></div>
                                <div><code class="text-black">Browser:</code> <code><?php echo h($browser); ?></code></div>
                                <div><code class="text-black">IP Address:</code> <code><?php echo h($ipAddress); ?></code></div>
                                <div><code class="text-black">Request URI:</code> <code><?php echo h($requestURI); ?></code></div>
                                <div><code class="text-black">Request Method:</code> <code><?php echo h($requestMethod); ?></code></div>
                            </div>
                        </div>
                    </div>
                </div>
-->
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary', 'type' => 'submit', 'form' => 'issueForm']) ?></div>
            </div>
        </div>
    </div>
</div>

<main id="main" class="main">

    <div class="pagetitle">
        <?php if ($currentUser->active == 0): ?>
            <div class="message success">You are currently part of the beta group with free access through June 2024!</div>
        <?php endif; ?>

        <?= $this->Flash->render() ?>
        <h1><?= $this->getName() ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door"></i></a></li>
                <li class="breadcrumb-item"><?= $this->Html->link(__($this->getName()), ['action' => 'index']) ?></li>
                <li class="breadcrumb-item active"><?= ucfirst($this->request->getParam('action')) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
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

<!-- SUPPORT CHAT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://support.wulterkens.tech/assets/chat/chat.min.js"></script>
<script>
$(function() {
  new ZammadChat({
    title: '<strong>Chat With Us!</strong>',
    background: '#4da1e5',
    fontSize: '12px',
    flat: true,
    chatId: 1
  });
});
</script>

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
