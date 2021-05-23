<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Error &bullet; myITS SSO</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{ $provider }}/assets/media/favicons/favicon-web.png">
        <link rel="stylesheet" type="text/css" href="{{ $provider }}/assets/css/its-login.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <img srcset="{{ $provider }}/assets/media/img/@2x/logo.png 2x, {{ $provider }}/assets/media/img/logo.png 1x"
                     src="{{ $provider }}/assets/media/img/logo.png" alt="Logo ITS" class="logo">
                <div class="description">
                    <img srcset="{{ $provider }}/assets/media/img/@2x/myits-sso-white.png 2x, {{ $provider }}/assets/media/img/myits-sso-white.png 1x"
                         src="{{ $provider }}/assets/media/img/myits-sso-white.png" alt="myITS" class="myits">
                </div>
                <div class="alert alert-danger">Anda tidak memiliki hak akses untuk aplikasi ini.</div>

                <a href="{{ url('sso/force-logout') }}" class="btn btn-block bg-orange text-center">
                    <small style="color: #013880">Keluar dari aplikasi</small>
                </a>
            </div>

            <footer class="m-t-30">&copy; 2021 Institut Teknologi Sepuluh Nopember.</footer>
        </div>
    </body>
</html>
