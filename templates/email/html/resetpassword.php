<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Email</title>
    <style>
        /* Reset styles */
        body, p {
            margin: 0;
            padding: 0;
        }

        /* Global styles */
        body {
            background-color: #eef2f7;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }

        /* Email wrapper */
        .email-wrapper {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .header {
            padding: 20px;
            background-color: #eeeeee;
            color: #333333;
            text-align: center;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        /* Content */
        .content {
            padding: 20px;
            text-align: center;
        }

        .content p {
            margin-bottom: 15px;
            line-height: 1.5;
        }

        /* Button styles */
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            background-color: #007bff;
            color: #ffffff;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Footer */
        .footer {
            padding: 20px;
            background-color: #f2f2f2;
            text-align: center;
            font-size: 12px;
            line-height: 1.5;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        /* Mobile responsiveness */
        @media only screen and (max-width: 600px) {
            .email-wrapper {
                padding: 10px;
            }

            .content {
                font-size: 14px;
            }

            .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<!-- Preheader for email preview in inbox -->
<div style="display: none; max-height: 0; overflow: hidden; line-height: 0; opacity: 0; color: #ffffff;">
    Reset your MyHomeLearner password with the link provided.
</div>

<!-- Email content -->
<div class="email-wrapper">
    <!-- Header section -->
    <div class="header">
        <img src="https://www.myhomelearner.com/phoenix/img/logo.png" alt="MyHomeLearner Logo">
        <h1>Password Reset Request</h1>
    </div>

    <!-- Main content section -->
    <div class="content">
        <p>Hello <?= $first_name ?? 'there' ?>,</p>
        <p>Please use the link below to reset your password.</p>
        <p>If you did not request this password, you may ignore this email.</p>
        <p>
            <a href="https://www.myhomelearner.com/users/resetpassword/<?= $token ?>" class="button">
                Reset Password
            </a>
        </p>
    </div>

    <!-- Footer section -->
    <div class="footer">
        <p>&copy; <?= date('Y') ?> MyHomeLearner. All rights reserved.</p>
        <p>If you have any questions, <a href="https://www.myhomelearner.com/contact">contact us</a>.</p>
    </div>
</div>
</body>
</html>
