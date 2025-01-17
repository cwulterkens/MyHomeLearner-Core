<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicons -->
    <link href="/phoenix/img/favicon.png" rel="icon">
    <link href="/phoenix/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/phoenix/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/phoenix/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/phoenix/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/phoenix/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/phoenix/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/phoenix/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/phoenix/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/phoenix/css/style.css" rel="stylesheet">

</head>

<body>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="/" class="logo d-flex align-items-center w-auto">
                                <img src="/phoenix/img/logo.png" alt="">
                                <span class="d-none d-lg-block">MyHomeLearner</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <?= $this->Flash->render() ?>
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>

                                <?= $this->Form->create(null, [
                                    'class' => 'row g-3 needs-validation'
                                ]) ?>
                                    <?= $this->Form->control('first_name', [
                                        'label' => [
                                            'class' => 'form-label',
                                            'text' => 'First Name'
                                        ],
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' => 'first_name',
                                        'required' => true,
                                        'error' => 'Please enter your first name.'
                                    ]); ?>

                                    <?= $this->Form->control('last_name', [
                                        'label' => [
                                            'class' => 'form-label',
                                            'text' => 'Last Name'
                                        ],
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' => 'last_name',
                                        'required' => true,
                                        'error' => 'Please enter your last name.'
                                    ]); ?>

                                    <?= $this->Form->control('email', [
                                        'label' => [
                                            'class' => 'form-label',
                                            'text' => 'Email'
                                        ],
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'required' => true,
                                        'error' => 'Please enter your email!'
                                    ]); ?>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                            <div class="invalid-feedback">You must agree before submitting.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <?= $this->Form->button(__('Create Account'), ['class' => 'w-100 btn btn-outline-primary']) ?>
                                    </div>
                                    <?= $this->Form->end() ?>
                                    <div class="col-12">
                                        <p class="small mb-0">Already have an account? <a href="/users/login">Log in</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/phoenix/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/phoenix/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/phoenix/vendor/chart.js/chart.umd.js"></script>
<script src="/phoenix/vendor/echarts/echarts.min.js"></script>
<script src="/phoenix/vendor/quill/quill.min.js"></script>
<script src="/phoenix/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/phoenix/vendor/tinymce/tinymce.min.js"></script>
<script src="/phoenix/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/phoenix/js/main.js"></script>

</body>

</html>

