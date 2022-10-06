<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Hallo {{ $name }}
    <p>Terima kasih sudah mendaftarkan sekolah anda ke dalam sistem kami</p><br>
    <strong>Silahkan lengkapi data sekolah <a href="{{ url('/completedDataRegistration/'.$activation_code) }}">
        Di sini
        </a></strong>
        <br>
    <strong>Salam Team Sispendik</strong>
</body>
</html>