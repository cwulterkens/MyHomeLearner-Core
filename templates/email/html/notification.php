<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Email</title>
    <style>
        body, p {
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #eef2f7;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }
        .email-wrapper {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            padding: 20px;
            background-color: #eeeeee;
            color: #333333;
            text-align: center;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content p {
            margin-bottom: 15px;
            line-height: 1.5;
        }
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
        .footer {
            padding: 20px;
            background-color: #f2f2f2;
            text-align: center;
            font-size: 12px;
            line-height: 1.5;
        }
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
<div style="display: none; max-height: 0; overflow: hidden; line-height: 0; opacity: 0; color: #ffffff;">
    You have a new notification waiting for you on MyHomeLearner.
</div>
<div class="email-wrapper">
    <div class="header">
        <img src="https://www.myhomelearner.com/phoenix/img/logo.png" alt="MyHomeLearner Logo" style="max-width: 100%; height: auto;">
        <h1>New Notification</h1>
    </div>
    <div class="content">
        <p>Hello <?= $first_name ?? 'there' ?>,</p>
        <p><?= $subject ?></p>
        <p><?= $content ?></p>
        <p>
            <a href="https://www.myhomelearner.com/notifications" class="button">
                🔔 View My Notifications
            </a>
        </p>
    </div>
    <div class="footer">
        <p>&copy; <?= date('Y') ?> MyHomeLearner. All rights reserved.</p>
        <p>If you no longer wish to receive these notifications, <a href="https://www.myhomelearner.com/unsubscribe" style="color: #007bff;">click here to unsubscribe</a>.</p>
    </div>
</div>
</body>
</html>
