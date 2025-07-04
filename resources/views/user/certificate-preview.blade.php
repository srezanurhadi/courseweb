<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Certificate of Completion</title>
    <style>
        @page {
            margin: 0;
            size: A4 landscape;
        }

        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap');

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Inter', sans-serif;
            background-color: #290d6e;
        }

        .certificate-container {
            width: calc(100% - 70px);
            height: 725px;
            margin: 35px auto;
            box-sizing: border-box;
            background: #290d6e;
            position: relative;
            color: #ffffff;
            border: 10px double #e0d03b;
            border-radius: 15px;
            box-shadow: 0 0 0 3px #290d6e, 0 0 20px rgba(0, 0, 0, 0.5);
        }

        /* Hapus media print karena dompdf tidak support dengan baik */

        .corner-ornament {
            position: absolute;
            width: 80px;
            height: 80px;
            border-style: solid;
            border-color: #e0d03b;
        }

        .corner-ornament.top-left {
            top: -2px;
            left: -2px;
            border-width: 4px 0 0 4px;
            border-top-left-radius: 10px;
        }

        .corner-ornament.top-right {
            top: -2px;
            right: -2px;
            border-width: 4px 4px 0 0;
            border-top-right-radius: 10px;
        }

        .corner-ornament.bottom-left {
            bottom: -2px;
            left: -2px;
            border-width: 0 0 4px 4px;
            border-bottom-left-radius: 10px;
        }

        .corner-ornament.bottom-right {
            bottom: -2px;
            right: -2px;
            border-width: 0 4px 4px 0;
            border-bottom-right-radius: 10px;
        }

        .certificate-header {
            padding: 40px 0 20px 0;
            text-align: center;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 0px;
            margin-bottom: 1rem;
            color: #ffffff;
        }

        .logo-subtitle {
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #e0d03b;
        }

        .certificate-body {
            text-align: center;
            padding: 10px 80px;
        }

        .main-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #e0d03b;
            margin-bottom: 1rem;
        }

        .subtitle {
            font-size: 1.1rem;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .participant-name {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1rem;
            border-bottom: 2px solid #e0d03b;
            display: inline-block;
            padding-bottom: 10px;
        }

        .completion-text {
            font-size: 1.1rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #ffffff;
        }

        .course-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #ffffff;
            border-radius: 10px;
            padding: 15px 30px;
            max-width: 600px;
            margin: 0 auto;
            font-style: italic;
        }

        .certificate-footer {
            padding: 80px 80px 40px 80px;
            position: relative;
            height: 100px;
        }

        .signature-area {
            width: 45%;
            position: absolute;
            left: 80px;
            top: 80px;
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid #e0d03b;
        }

        .date-area {
            width: 45%;
            position: absolute;
            right: 80px;
            top: 80px;
            text-align: center;
        }

        .signature-name,
        .date-text {
            font-weight: 600;
            color: #ffffff;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .signature-title {
            color: #e0d03b;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="corner-ornament top-left"></div>
        <div class="corner-ornament top-right"></div>
        <div class="corner-ornament bottom-left"></div>
        <div class="corner-ornament bottom-right"></div>

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
