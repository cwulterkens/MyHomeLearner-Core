<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        /* Reset styles */
        body, p {
            margin: 0;
            padding: 0;
        }

        /* Email wrapper */
        .email-wrapper {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f2f2f2;
        }

        /* Header */
        .header {
            padding: 20px;
            background-color: #ffffff;
            text-align: center;
        }

        /* Content */
        .content {
            padding: 20px;
            background-color: #ffffff;
            text-align: center;
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
        }

        /* Footer */
        .footer {
            padding: 20px;
            background-color: #f2f2f2;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <div style="height: 120px;">
                <img src="https://www.myhomelearner.com/phoenix/img/logo.png" alt="" style="max-height: 100%; max-width: 100%;">
            </div>
            <h1>Welcome to MyHomeLearner!</h1>
        </div>
        <div class="content">
            <p>Hello <?= $first_name?>,</p>
            <p>Thank you for registering with MyHomeLearner. We're excited to have you on board!</p>
            <p>To confirm your registration, please click the button below:</p>
            <p> </p>
            <p>
                <a href="https://www.myhomelearner.com/users/verification/<?= $token?>" style="display: inline-block; padding: 10px 20px; font-size: 16px; text-decoration: none; background-color: #007bff; color: #ffffff; border-radius: 4px;">
                    Confirm Registration
                </a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; 2023 MyHomeLearner. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
