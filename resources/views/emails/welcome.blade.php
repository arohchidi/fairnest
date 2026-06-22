<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        /* Email styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f7f6;
            color: #2d3748;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .email-wrapper {
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, #0A1928 0%, #0D2A3A 40%, #1B4D3E 100%);
            padding: 40px 30px;
            text-align: center;
        }
        
        .header-logo {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .header-logo span {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .header-logo .accent {
            color: #2D6A4F;
        }
        
        .header h1 {
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin: 20px 0 10px;
            line-height: 1.2;
        }
        
        .header p {
            color: #a8d5ba;
            font-size: 16px;
            margin: 0;
        }
        
        /* Body */
        .body-content {
            padding: 40px 35px;
        }
        
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 15px;
        }
        
        .greeting span {
            color: #2D6A4F;
        }
        
        .message {
            color: #4a5568;
            line-height: 1.8;
            margin-bottom: 25px;
        }
        
        .message strong {
            color: #2D6A4F;
        }
        
        /* Features Section */
        .features {
            background: #f7fafc;
            border-radius: 12px;
            padding: 25px 20px;
            margin: 25px 0;
            border-left: 4px solid #2D6A4F;
        }
        
        .features h3 {
            color: #1a202c;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 12px 0;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            padding: 6px 0;
            color: #4a5568;
        }
        
        .feature-item i {
            color: #2D6A4F;
            margin-right: 12px;
            font-weight: 700;
        }
        
        .feature-item .check {
            display: inline-block;
            width: 18px;
            height: 18px;
            background: #2D6A4F;
            border-radius: 50%;
            color: white;
            text-align: center;
            line-height: 18px;
            font-size: 11px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        
        /* CTA Button */
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #2D6A4F, #1B4D3E);
            color: #ffffff;
            padding: 14px 40px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin: 10px 0 20px;
            box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);
            transition: all 0.3s ease;
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(45, 106, 79, 0.4);
        }
        
        .button-center {
            text-align: center;
        }
        
        /* Divider */
        .divider {
            border: none;
            border-top: 2px solid #e2e8f0;
            margin: 30px 0;
        }
        
        /* Footer */
        .footer {
            background: #f7fafc;
            padding: 30px 35px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }
        
        .footer p {
            color: #718096;
            font-size: 13px;
            line-height: 1.6;
            margin: 5px 0;
        }
        
        .footer .social-links {
            margin: 15px 0;
        }
        
        .footer .social-links a {
            display: inline-block;
            width: 36px;
            height: 36px;
            background: #e2e8f0;
            border-radius: 50%;
            margin: 0 5px;
            text-align: center;
            line-height: 36px;
            color: #4a5568;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        
        .footer .social-links a:hover {
            background: #2D6A4F;
            color: #ffffff;
        }
        
        .footer .footer-links a {
            color: #2D6A4F;
            text-decoration: none;
            margin: 0 8px;
            font-size: 13px;
        }
        
        .footer .footer-links a:hover {
            text-decoration: underline;
        }
        
        .footer .copyright {
            color: #a0aec0;
            font-size: 12px;
            margin-top: 12px;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .header h1 {
                font-size: 22px;
            }
            
            .body-content {
                padding: 25px 20px;
            }
            
            .footer {
                padding: 20px 20px;
            }
            
            .cta-button {
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-wrapper">
            
            <!-- ============================================ -->
            <!-- HEADER -->
            <!-- ============================================ -->
            <div class="header">
                <div class="header-logo">
                    <span>{{ config('app.name') }}</span>
                </div>
                <h1>{{$subject}} 🎉</h1>
                <p>We're thrilled to have you on board</p>
            </div>
            
            <!-- ============================================ -->
            <!-- BODY -->
            <!-- ============================================ -->
            <div class="body-content">
                
                <p class="greeting">Hello <span>{{ $user->username ?? 'there' }}</span>,</p>
                
                <p class="message">
                    Thank you for joining <strong>{{ config('app.name') }}</strong>! We're excited to help you find 
                    your perfect home. Whether you're looking for a cozy apartment, a luxury villa, or anything in between, 
                    we've got you covered.
                </p>
                
                <p class="message">
                  {!! $messageBody !!}
                </p>
                
                <!-- Features -->
                <div class="features">
                    <h3>Here's what you can do with your account:</h3>
                    
                    <div class="feature-item">
                        <span class="check">✓</span>
                        Browse hundreds of verified properties
                    </div>
                    <div class="feature-item">
                        <span class="check">✓</span>
                        Save your favorite listings
                    </div>
                    <div class="feature-item">
                        <span class="check">✓</span>
                        Book properties instantly
                    </div>
                    <div class="feature-item">
                        <span class="check">✓</span>
                        Connect with property owners
                    </div>
                    <div class="feature-item">
                        <span class="check">✓</span>
                        Leave reviews and ratings
                    </div>
                </div>
                
                <!-- CTA Button -->
                <div class="button-center">
                    <a href="{{ route('property.listings') }}" class="cta-button">
                        Explore Properties
                    </a>
                </div>
                
                <p class="message" style="text-align: center; font-size: 14px; color: #718096;">
                    Need help? We're here for you 24/7.
                </p>
                
                <hr class="divider">
                
                <p class="message" style="font-size: 14px; text-align: center; color: #718096;">
                    <strong>Your account details:</strong><br>
                    Email: {{ $user->email }}<br>
                    <span style="font-size: 12px; color: #a0aec0;">
                        If you didn't create this account, please ignore this email.
                    </span>
                </p>
            </div>
            
            <!-- ============================================ -->
            <!-- FOOTER -->
            <!-- ============================================ -->
            <div class="footer">
                <div class="social-links">
                    <a href="#" style="background: #1877F2; color: #fff;">f</a>
                    <a href="#" style="background: #1DA1F2; color: #fff;">🐦</a>
                    <a href="#" style="background: #E4405F; color: #fff;">📷</a>
                    <a href="#" style="background: #0A66C2; color: #fff;">in</a>
                    <a href="#" style="background: #FF0000; color: #fff;">▶</a>
                </div>
                
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
                
                <p class="copyright">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
            
        </div>
    </div>
</body>
</html>