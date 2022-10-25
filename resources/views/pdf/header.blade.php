<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
    table, th, td {
        border: 0px solid white;
        border-collapse: collapse;
    }
    .fondo {
        background-image: url("{{ public_path('img/fondo-amarillo.jpg') }}");
        background-size: cover;
        margin: 0;
        padding: 0;
        color: #004AAD;
    }
    </style>
</head>
<body>

    <div style="padding-bottom: 20px;">
        <table style="width:100%">
            <tr>
              <th style="text-align: left; width: 50%;">
                  
                  <img src="{{ public_path('img/logo_largo.png') }}" alt="" width="350px">
              </th>
              <th class="fondo" style="width: 50%;"><strong>{{ $title??config('app.name','') }}</strong></th>
            </tr>
          </table>
    </div>

</body>
</html>
