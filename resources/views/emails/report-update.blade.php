<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Update - {{ config('app.name') }}</title>
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
        .report-details {
            background: #f7fafc;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            border: 1px solid #e2e8f0;
        }
        .report-details h3 {
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
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        .status-badge.resolved { background: #22c55e; color: white; }
        .status-badge.dismissed { background: #6b7280; color: white; }
        .status-badge.in_progress { background: #3b82f6; color: white; }
        .status-badge.pending { background: #eab308; color: white; }
        .note-box {
            background: #fef3c7;
            border-radius: 8px;
            padding: 15px 20px;
            margin: 20px 0;
            border-left: 4px solid #f59e0b;
        }
        .note-box p {
            color: #92400e;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
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
                <h1>Report Update 📋</h1>
                <p>Your property report has been reviewed</p>
            </div>

            <!-- BODY -->
            <div class="body-content">

                <p class="greeting">Hello <span>{{ $report->name ?? 'there' }}</span>,</p>

                <p class="message">
                    We have reviewed the report you submitted regarding <strong>{{ $report->property->title }}</strong>.
                    Thank you for helping us maintain the quality of our platform.
                </p>

                <!-- Report Details -->
                <div class="report-details">
                    <h3>📋 Report Details</h3>

                    <div class="detail-row">
                        <span class="label">Report ID</span>
                        <span class="value">#{{ $report->id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Property</span>
                        <span class="value">{{ $report->property->title }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Category</span>
                        <span class="value">{{ Str::title(str_replace('_', ' ', $report->category)) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Submitted</span>
                        <span class="value">{{ $report->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="detail-row" style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #e2e8f0;">
                        <span class="label">Status</span>
                        <span class="value">
                            <span class="status-badge {{ $report->status }}">
                                {{ Str::title(str_replace('_', ' ', $report->status)) }}
                            </span>
                        </span>
                    </div>
                </div>

                <!-- Admin Note (if any) -->
                @if($report->admin_note ?? false)
                <div class="note-box">
                    <p><strong>📝 Admin Note:</strong><br>{{ $report->admin_note }}</p>
                </div>
                @endif

                <!-- Status-specific Message -->
                @if($report->status == 'resolved')
                <div style="background: #dcfce7; border-radius: 8px; padding: 15px 20px; margin: 20px 0; border-left: 4px solid #22c55e;">
                    <p style="color: #166534; font-size: 14px; margin: 0; line-height: 1.6;">
                        <strong>✅ Issue Resolved</strong><br>
                        The issue you reported has been addressed. The property has been reviewed and necessary actions have been taken.
                    </p>
                </div>
                @elseif($report->status == 'dismissed')
                <div style="background: #f3f4f6; border-radius: 8px; padding: 15px 20px; margin: 20px 0; border-left: 4px solid #6b7280;">
                    <p style="color: #374151; font-size: 14px; margin: 0; line-height: 1.6;">
                        <strong>ℹ️ Report Dismissed</strong><br>
                        After careful review, we found that this report does not warrant further action. Thank you for your concern.
                    </p>
                </div>
                @elseif($report->status == 'in_progress')
                <div style="background: #dbeafe; border-radius: 8px; padding: 15px 20px; margin: 20px 0; border-left: 4px solid #3b82f6;">
                    <p style="color: #1e40af; font-size: 14px; margin: 0; line-height: 1.6;">
                        <strong>🔄 In Progress</strong><br>
                        We are actively investigating this issue and will provide another update once resolved.
                    </p>
                </div>
                @endif

                <!-- CTA Button -->
                <div class="button-center">
                    <a href="{{ route('property.details', $report->property) }}" class="cta-button">
                        View Property
                    </a>
                </div>

                <hr class="divider">

                <p class="message" style="font-size: 14px; text-align: center; color: #718096;">
                    <strong>Thank you for being a responsible member of our community.</strong><br>
                    Your reports help us keep our platform safe and trustworthy.
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