<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nomor Antrian Disdukcapil</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        .container {
            background-color: #ffffff;
            border: 3px solid #000000; /* Border utama */
            max-width: 480px;
            margin: auto;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Shadow agar terlihat lebih elegan */
        }

        .logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            margin: 10px 0;
            color: #333;
        }

        .header p {
            font-size: 14px;
            margin: 5px 0;
            color: #555;
        }

        .divider {
            margin: 30px 0;
            border-top: 2px solid #000000;
        }

        .nomor-antrian {
            font-size: 50px;
            font-weight: bold;
            margin-top: 30px;
            padding: 20px 0;
            border: 3px solid #333;
            background-color: #e9ecef; /* Warna latar belakang untuk nomor */
            margin-bottom: 30px;
            color: #333;
        }

        .tanggal-kedatangan {
            font-size: 18px;
            font-weight: 600;
            color: #444;
        }

        .note {
            margin-top: 40px;
            font-size: 14px;
            color: #888;
        }

        .footer {
            margin-top: 50px;
            font-size: 12px;
            color: #555;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            <img src="{{ public_path('storage/logo/logo.png') }}" alt="Logo" width="120">
        </div>

        <div class="header">
            <h1>Dinas Kependudukan dan Pencatatan Sipil</h1>
            <p>Kabupaten Klaten, Jawa Tengah</p>
        </div>

        <div class="divider"></div>

        <h2>Nomor Antrian</h2>
        <div class="nomor-antrian">
            {{ $cetakKodeAntrian->kode }}
        </div>

        <div class="tanggal-kedatangan">
            Tanggal Kedatangan: {{ date('d-m-Y', strtotime($cetakKodeAntrian->tanggal)) }}
        </div>

        <div class="note">
            Harap datang tepat waktu sesuai jadwal yang telah dipilih.
        </div>

        <div class="footer">
            &copy; 2025 Dinas Kependudukan dan Pencatatan Sipil Klaten
        </div>

    </div>

</body>
</html>
