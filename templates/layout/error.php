<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Error 404</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/phoenix/img/favicon.png" rel="icon">
    <link href="/phoenix/img/apple-touch-icon.png" rel="apple-touch-icon">

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
    * Template Name: NiceAdmin
    * Updated: May 30 2023 with Bootstrap v5.3.0
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

<main>
    <div class="container">

        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>404</h1>
            <h2>The page you are looking for doesn't exist.</h2>
            <?= $this->Html->link(__('Back'), 'javascript:history.back()', ['class' => 'btn']) ?>
            <img src="/phoenix/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">

        </section>

    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<?= $this->Html->script(['/phoenix/vendor/apexcharts/apexcharts.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/bootstrap/js/bootstrap.bundle.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/chart.js/chart.umd']) ?>
<?= $this->Html->script(['/phoenix/vendor/echarts/echarts.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/quill/quill.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/simple-datatables/simple-datatables']) ?>
<?= $this->Html->script(['/phoenix/vendor/tinymce/tinymce.min']) ?>
<?= $this->Html->script(['/phoenix/vendor/php-email-form/validate']) ?>

<!-- Template Main JS File -->
<?= $this->Html->script(['/phoenix/js/main']) ?>

</body>

</html>
