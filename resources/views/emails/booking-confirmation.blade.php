<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed - {{ config('app.name') }}</title>
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
        .header-logo .accent { color: #2D6A4F; }
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
        .body-content { padding: 40px 35px; }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 15px;
        }
        .greeting span { color: #2D6A4F; }
        .message {
            color: #4a5568;
            line-height: 1.8;
            margin-bottom: 25px;
        }
        .message strong { color: #2D6A4F; }
        .booking-details {
            background: #f7fafc;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            border: 1px solid #e2e8f0;
        }
        .booking-details h3 {
            color: #1a202c;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 15px 0;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 14px;
        }
        .detail-row .label { color: #718096; }
        .detail-row .value { color: #1a202c; font-weight: 500; }
        .status-badge {
            display: inline-block;
            background: #2D6A4F;
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
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
        .button-center { text-align: center; }
        .divider {
            border: none;
            border-top: 2px solid #e2e8f0;
            margin: 30px 0;
        }
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
        .footer .footer-links a:hover { text-decoration: underline; }
        .footer .copyright {
            color: #a0aec0;
            font-size: 12px;
            margin-top: 12px;
        }
        @media (max-width: 480px) {
            .header h1 { font-size: 22px; }
            .body-content { padding: 25px 20px; }
            .footer { padding: 20px 20px; }
            .cta-button { display: block; text-align: center; }
            .detail-row { flex-direction: column; padding: 4px 0; }
            .detail-row .value { margin-top: 2px; }
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
                <h1>Booking Confirmed! ✅</h1>
                <p>Your reservation has been successfully confirmed</p>
            </div>

            <!-- BODY -->
            <div class="body-content">

                <p class="greeting">Hello <span>{{ $booking->username ?? 'Guest' }}</span>,</p>

                <p class="message">
                    Great news! Your booking for <strong>{{ $propertytitle}}</strong> has been 
                    <strong>confirmed</strong> by the property owner. We're excited to have you stay with us!
                </p>

                <!-- Booking Details -->
                <div class="booking-details">
                    <h3>📋 Booking Details</h3>

                    <div class="detail-row">
                        <span class="label">Booking Reference</span>
                        <span class="value">#{{ $booking->reference ?? $booking->id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Property</span>
                        <span class="value">{{ $propertytitle }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Location</span>
                        <span class="value">{{$booking->property->address}},{{$booking->property->city}},{{$booking->property->country}}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Inspection Date</span>
                        <span class="value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, M d, Y') }}</span>
                    </div>
                     <div class="detail-row">
                        <span class="label">Special Requests</span>
                        <span class="value" style="color: #2D6A4F; font-weight: 700;">{{$booking->special_request}}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="label">Total Amount</span>
                        <span class="value" style="color: #2D6A4F; font-weight: 700;">{{App\Helper::formatNaira(number_format($booking->property->rent_fee + $booking->property->mgt_fee + $booking->property->caution_fee + $booking->property->agency_fee + $booking->property->legal_fee))}}</span>
                    </div>
                    <div class="detail-row" style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #e2e8f0;">
                        <span class="label">Status</span>
                        <span class="value"><span class="status-badge">Confirmed</span></span>
                    </div>
                </div>

                <!-- Roommate Info (if applicable) -->
                @if($booking->needs_roommate)
                <div class="booking-details" style="border-left: 4px solid #2D6A4F;">
                    <h3>👥 Roommate Information</h3>
                    <div class="detail-row">
                        <span class="label">Room Mate's Gender</span>
                        <span class="value">{{ $booking->roommate_gender ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Room Mate's Age</span>
                        <span class="value">{{ $booking->roommate_age ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">State of origin</span>
                        <span class="value">{{ $booking->state_of_origin ?? 'N/A' }}</span>
                    </div>
                     <div class="detail-row">
                        <span class="label">Religion</span>
                        <span class="value">{{ $booking->religion ?? 'N/A' }}</span>
                    </div>
                     <div class="detail-row">
                        <span class="label">Note</span>
                        <span class="value">{{ $booking->roommate_note ?? 'N/A' }}</span>
                    </div>
                    
                </div>
                @endif

                

                <p class="message" style="font-size: 14px; text-align: center; color: #718096;">
                    Check-in instructions will be sent to you 48 hours before arrival.
                </p>

                <hr class="divider">

                <p class="message" style="font-size: 14px; text-align: center; color: #718096;">
                    <strong>Need to make changes?</strong><br>
                    Contact our support team for assistance with your booking.
                </p>
            </div>

            <!-- FOOTER -->
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
                <p class="copyright">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>

        </div>
    </div>
</body>
</html>