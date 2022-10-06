<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo_web.png') }}">
    <title>Password Reset</title>
</head>
<body>
    <div class="container-fluid">
        <div class="card shadow">
                <div class="card-header">
                <h3>Token reset password sispendik</h3>
            </div>
            <div class="card-body">
                <h2>Hallo sobat sispendik</h2>
    <p>Kamu telah mengirim permintaan untuk Lupa Password</p>
    <p>Ini token anda <strong>{{ $token }}</strong></p>
    <img src="https://drive.google.com/file/d/1DNkv7GsZMG8LS1XHpqJnJRx0rWXsv6FZ" alt="">
    <p>note:
        <ul>
            <li><strong>Jangan beritahu token ini kesiapapun</strong></li>
            <li><strong>Masukan token ke form token validate</strong></li>
        </ul>
    </p>
    <p>Bila anda tidak pernah meminta proses ini, maka kami berharap anda mengabaikan email ini.</p>
    <p>Terima Kasih</p>
    <strong>Salam Team Sispendik</strong>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
