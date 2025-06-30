<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Certificate of Completion</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            /* Removed to prevent potential offset issues */
            width: 100%;
            height: 100vh;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
        }

        .certificate-container {
            width: calc(100% - 60px);
            height: calc(100% - 60px);
            margin: 30px;
            /* Adjusted for better fit within A4 landscape */
            box-sizing: border-box;
            /* Ensures padding and border are included in the element's total width and height */
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .certificate-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 206, 84, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .decorative-border {
            position: absolute;
            top: 25px;
            left: 25px;
            right: 25px;
            bottom: 25px;
            border: 3px solid;
            border-image: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #f5576c) 1;
            border-radius: 15px;
            pointer-events: none;
        }

        .corner-ornament {
            position: absolute;
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            clip-path: polygon(0 0, 100% 0, 0 100%);
        }

        .corner-ornament.top-left {
            top: 25px;
            left: 25px;
            border-radius: 15px 0 0 0;
        }

        .corner-ornament.top-right {
            top: 25px;
            right: 25px;
            transform: rotate(90deg);
            border-radius: 0 15px 0 0;
        }

        .corner-ornament.bottom-left {
            bottom: 25px;
            left: 25px;
            transform: rotate(-90deg);
            border-radius: 0 0 0 15px;
        }

        .corner-ornament.bottom-right {
            bottom: 25px;
            right: 25px;
            transform: rotate(180deg);
            border-radius: 0 0 15px 0;
        }

        .certificate-header {
            padding: 60px 0 5px 0;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
            letter-spacing: 3px;
        }

        .logo-subtitle {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .certificate-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 80px;
            position: relative;
            z-index: 2;
            margin-bottom: -30px;
        }

        .main-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 1rem;
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .participant-name {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
            position: relative;
            padding: 0 30px;
            /* Adjusted for better fit within the container */
            letter-spacing: 1px;
        }

        .participant-name::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #667eea, #764ba2, transparent);
            border-radius: 2px;
        }

        .completion-text {
            font-size: 1.1rem;
            color: #475569;
            margin-bottom: 1rem;
            font-weight: 400;
        }

        .course-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #1e293b;
            background: rgba(102, 126, 234, 0.05);
            padding: 25px 30px;
            border-radius: 15px;
            border: 2px solid rgba(102, 126, 234, 0.1);
            max-width: 600px;
            line-height: 1.4;
        }

        .certificate-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            /* Aligns items to the bottom */
            padding: 40px 80px 60px 80px;
            position: relative;
            z-index: 2;
        }

        .signature-area,
        .date-area {
            text-align: center;
            position: relative;
            margin: 10px;
        }

        .signature-line {
            width: 220px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, transparent);
            margin: 0 auto 15px auto;
            border-radius: 1px;
        }

        .signature-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .signature-title,
        .date-text {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .date-text {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 8rem;
            font-weight: 900;
            color: rgba(102, 126, 234, 0.04);
            pointer-events: none;
            z-index: 1;
            font-family: 'Playfair Display', serif;
        }

        @media print {
            .certificate-container {
                margin: 0;
                width: 100%;
                /* Ensures full width on print */
                height: 100%;
                /* Ensures full height on print */
                border-radius: 0;
                /* Removes border-radius for print */
                box-shadow: none;
                /* Removes box-shadow for print */
            }

            .decorative-border {
                top: 15px;
                left: 15px;
                right: 15px;
                bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="decorative-border"></div>
        <div class="corner-ornament top-left"></div>
        <div class="corner-ornament top-right"></div>
        <div class="corner-ornament bottom-left"></div>
        <div class="corner-ornament bottom-right"></div>

        <div class="watermark">CERTIFIED</div>

        <div class="certificate-header">
            <div class="logo">R. DOSEN</div>
            <div class="logo-subtitle">Learning Excellence</div>
        </div>

        <div class="certificate-body">
            <h1 class="main-title">Certificate of Completion</h1>

            <p class="subtitle">This certificate is proudly presented to:</p>

            <div class="participant-name">{{ $userName }}</div>

            <p class="completion-text">For successfully completing the online course:</p>

            <div class="course-title">"{{ $courseTitle }}"</div>
        </div>

        <div class="certificate-footer">
            <div class="signature-area">
                <div class="signature-line"></div>
                <div class="signature-name">{{ $authorName }}</div>
                <div class="signature-title">Course Instructor</div>
            </div>
            <div class="date-area">
                <div class="date-text">{{ $completionDate }}</div>
                <div class="signature-title">Date of Completion</div>
            </div>
        </div>
    </div>
</body>

</html>
