<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', '') }}</title>
    <style>
        table{
            width: 100%;
        }
        .fondo {
            background-image: url("{{ public_path('img/fondo-amarillo.jpg') }}");
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #004AAD;
            text-align: center;
            line-height:25px;

        }
    </style>
</head>
<body>

    <table class="fondo">
        <thead>
            <tr>
                <td scope="col"><small>{{ config('app.name','') }}</small></td>
                <td scope="col">www.credimundo.com</td>
                <td scope="col">Salcedo-Ecuador</td>
                <td scope="col">(+593) 997374263</td>
            </tr>
        </thead>
    </table>
</body>
</html>