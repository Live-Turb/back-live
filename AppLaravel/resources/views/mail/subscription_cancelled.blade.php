<!DOCTYPE html>
<html>
<head>
    <title>Subscription Cancelled</title>
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            /*align-items: center;*/
   
            color: #333;
        }

        .email-container {
            background-color: #080e35;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            width: 100%;
           
        }

         .email-header img {
            width: 30%;
            text-align:center;
        }
 .email-header{
     text-align:center;
 }
        .email-body h1 {
            font-weight: 600;
            font-size: 24px;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .email-body p {
            font-weight: 300;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .email-footer {
            font-size: 14px;
            color: #ffffff;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="https://sty1.devmail-sty.online/LiveStreaming/public/storage/sitelogo/logo_dark.png" alt="Company Logo">
        </div>
        <div class="email-body">
            <h1>Subscription Cancelled</h1>
            <p>Dear {{ $data['user_name'] }},</p>
            <p>Your subscription for the plan: <strong>{{ $data['plan_name'] }}</strong> has been cancelled.</p>
            <p>If you have any questions or need further assistance, feel free to contact us.</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Live Turb. All rights reserved.
        </div>
    </div>
</body>
</html>
