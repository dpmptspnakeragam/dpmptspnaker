<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link rel="icon" href="assets/img/vectoragam.png" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 0;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: maroon;
            background-image: url('assets/img/maintenance.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {
            max-width: 90%;
            /* Menggunakan persentase agar lebih responsif */
            padding: 20px;
            border-radius: 8px;
            background: rgba(0, 0, 0, 0.5);
            /* Menambahkan latar belakang semi-transparan untuk konten */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .spinner {
            border: 8px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            border-top: 8px solid yellow;
            width: 80px;
            height: 80px;
            animation: spin 1.5s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        h1 {
            font-size: 2.5em;
            margin: 10px 0;
            font-weight: bold;
            color: white;
        }

        h2 {
            font-size: 1.7em;
            margin: 10px 0;
            font-weight: bold;
            color: white;
        }

        p {
            font-size: 1.2em;
            color: whitesmoke;
            line-height: 1.5;
            margin: 0;
        }

        .maintenance-image {
            max-width: 120px;
            margin: 20px 0;
        }

        /* Media Query untuk Responsif */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
                max-width: 95%;
            }

            h1 {
                font-size: 2em;
            }

            h2 {
                font-size: 1.5em;
            }

            p {
                font-size: 1em;
            }

            .spinner {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="spinner"></div>
        <h1>Oops!</h1>
        <h2>Maaf, Situs Sedang Dalam Perawatan!</h2>
        <p>Kami sedang melakukan pemeliharaan. Kami akan segera kembali. Terima kasih atas kesabaran Anda!</p>
    </div>
</body>

</html>