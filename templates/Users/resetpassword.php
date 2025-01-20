<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link href="/phoenix/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/phoenix/css/style.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .password-reset-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 30px;
            padding: 10px 15px;
        }

        .password-criteria {
            margin-top: 15px;
            font-size: 10px;
            list-style: none;
            padding-left: 0;
            text-align: center;
        }

        .password-criteria li {
            margin-bottom: 3px;
            color: #dc3545; /* Red for unmet criteria */
            transition: color 0.3s ease;
        }

        .password-criteria li.valid {
            color: #28a745; /* Green for met criteria */
        }

        .btn-outline-primary {
            border-radius: 30px;
        }

        .return-login {
            text-align: center;
            margin-top: 10px;
        }

        .return-login a {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .return-login a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<main>
    <section class="d-flex min-vh-100 align-items-center justify-content-center">
        <div class="password-reset-container">
            <div class="text-center mb-4">
                <a href="/" class="logo d-flex align-items-center justify-content-center">
                    <img src="/phoenix/img/logo.png" alt="MyHomeLearner Logo" style="width: 50px; height: auto;">
                    <span class="ms-2 fw-bold">MyHomeLearner</span>
                </a>
            </div>

            <div class="card p-4">
                <div class="card-body">
                    <?= $this->Flash->render() ?>
                    <h5 class="text-center mb-4">Set Your New Password</h5>

                    <?= $this->Form->create(null, [
                        'class' => 'needs-validation',
                        'id' => 'resetPasswordForm'
                    ]) ?>

                    <div class="mb-3">
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control',
                            'id' => 'newPassword',
                            'placeholder' => 'Enter new password',
                            'required' => true,
                            'error' => 'Please enter your password!',
                            'autocomplete' => 'off'
                        ]); ?>
                    </div>

                    <ul class="password-criteria">
                        <li id="uppercase">Contains an uppercase letter (A-Z)</li>
                        <li id="lowercase">Contains a lowercase letter (a-z)</li>
                        <li id="number">Contains a number (0-9)</li>
                        <li id="special">Contains a special character</li>
                        <li id="length">Is at least 8 characters long</li>
                    </ul>

                    <div class="d-grid">
                        <?= $this->Form->button(__('Update Password'), ['class' => 'btn btn-outline-primary']) ?>
                    </div>

                    <?= $this->Form->end() ?>

                    <div class="return-login">
                        <p><a href="/users/login">Return to Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/phoenix/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    // Password validation logic
    const passwordInput = document.getElementById('newPassword');
    const criteria = {
        uppercase: /[A-Z]/,
        lowercase: /[a-z]/,
        number: /[0-9]/,
        special: /[!@#\$%\^&\*]/,
        length: /.{8,}/,
    };

    passwordInput.addEventListener('input', () => {
        Object.keys(criteria).forEach(id => {
            const element = document.getElementById(id);
            if (criteria[id].test(passwordInput.value)) {
                element.classList.add('valid');
            } else {
                element.classList.remove('valid');
            }
        });
    });
</script>

</body>

</html>
