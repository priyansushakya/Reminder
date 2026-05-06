<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f0f0f0; padding: 20px; border-radius: 5px; }
        .content { padding: 20px 0; }
        .footer { color: #666; font-size: 12px; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>{{ $reminder->title }}</h2>
        </div>
        <div class="content">
            <p>{{ $reminder->message }}</p>
        </div>
        <div class="footer">
            <p>Best regards,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
