<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f7f6;
            color: #2d3748;
        }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .email-wrapper {
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: linear-gradient(135deg, #0A1928 0%, #0D2A3A 40%, #1B4D3E 100%);
            padding: 30px 30px 20px;
            text-align: center;
        }
        .header-logo {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 18px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 10px;
        }
        .header-logo span {
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .header-logo .accent { color: #2D6A4F; }
        .header h2 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 600;
            margin: 10px 0 5px;
        }
        .body-content { padding: 35px 30px; }
        .greeting {
            font-size: 17px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 15px;
        }
        .greeting span { color: #2D6A4F; }
        .content-area {
            color: #4a5568;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .content-area p { margin-bottom: 15px; }
        .divider {
            border: none;
            border-top: 2px solid #e2e8f0;
            margin: 25px 0;
        }
        .footer {
            background: #f7fafc;
            padding: 25px 30px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }
        .footer p {
            color: #718096;
            font-size: 13px;
            line-height: 1.6;
            margin: 3px 0;
        }
        .footer .footer-links a {
            color: #2D6A4F;
            text-decoration: none;
            margin: 0 8px;
            font-size: 13px;
        }
        .footer .footer-links a:hover { text-decoration: underline; }
        .footer .copyright {
            color: #a0aec0;
            font-size: 12px;
            margin-top: 10px;
        }
        @media (max-width: 480px) {
            .body-content { padding: 20px; }
            .footer { padding: 15px 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-wrapper">

            <!-- HEADER -->
            <div class="header">
                <div class="header-logo">
                    <span>{{ config('app.name') }}</span>
                </div>
                <h2>{{ $subject }}</h2>
            </div>

            <!-- BODY -->
            <div class="body-content">

                <p class="greeting">Hello <span>{{ $user->name ?? 'there' }}</span>,</p>

                <div class="content-area">
                    {!! nl2br(e($content)) !!}
                </div>

                <hr class="divider">

                <p style="font-size: 14px; text-align: center; color: #718096;">
                    This email was sent to you by {{ config('app.name') }}.
                </p>
            </div>

            <!-- FOOTER -->
            <div class="footer">
                <div class="footer-links">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('property.listings') }}">Properties</a>
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>
                <p>
                    <a href="{{ route('terms') }}" style="color: #2D6A4F; text-decoration: none;">Terms of Service</a>
                    •
                    <a href="{{ route('privacy-policy') }}" style="color: #2D6A4F; text-decoration: none;">Privacy Policy</a>
                </p>
                <p class="copyright">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>

        </div>
    </div>
</body>
</html>