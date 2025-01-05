<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- For more projects: Visit    -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SNV's System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-image: url(assets/img/theme/restro00.jpg);
            font-family: cursive, sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            color:chartreuse;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
            font-colour="white";
        }

        .links>a {
            color: #ffff;
            padding: 0 25px;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<!-- For more projects: Visit    -->
<body >
    <div style="background-image: url(theme/restro00.jpg);">
    <div class="flex-center position-ref full-height" >
        <div class="content">
            <div class="title m-b-md">
                SNV's Restaurant
            </div>

            <div class="links">
			<!-- For more projects: Visit    -->
                <a href="Restro/admin/">Admin Log In</a>
                <!-- <a href="">Cashier Log In</a>Restro/cashier/ -->
                <a href="Restro/customer">Customer Log In</a>
            </div>
        </div>
    </div>
    </div>
</body>
<!-- For more projects: Visit    -->
</html>