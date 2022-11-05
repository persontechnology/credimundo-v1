<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Recibo N° '.$trans->numero }}</title>
    <style>
        html {
            font-size: x-small;
        }
    </style>
</head>
<body>
    <div>
        <table style="width: 100%;">
            <tr>
                <td style="width: 30%;">
                    
                </td>
                <td>
                    <table>
                        <tr>
                            <td colspan="2">
                                <p>
                                    {{ Str::limit($trans->tipoTransaccion->nombre,30,'.') }} <br>
                                    {{ $trans->cuentaUser->tipoCuenta->nombre }} <br>
                                    CUENTA: {{ $trans->cuentaUser->numero }} <br>
                                    NOMBRE: {{ Str::limit($trans->cuentaUser->user->apellidos_nombres,30,'.') }} <br>
                                    IDENTIFICACIÓN: {{ Str::limit($trans->cuentaUser->user->identificacion,30,'.') }} <br>
                                    DOCUMENTO: {{ $trans->numero }} <br>
                                    OFICINA: {{ $trans->creadoPor->canton }} <br>
                                    FECHA: {{ $trans->created_at->toDateString() }} <br>
                                    VALOR DISPONIBLE: {{ $trans->cuentaUser->valor_disponible }} <br>
                                    USUARIO: {{ Str::limit($trans->creadoPor->name,30,'') }} <br>
                                </p>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                EFECTIVO:
                            </td>
                            <td style="text-align: right;">
                                {{ $trans->valor_efectivo }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                CHEQUE:
                            </td>
                            <td style="text-align: right;">
                                {{ $trans->valor_cheque }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                TOTAL:
                            </td>
                            <td style="text-align: right;">
                                {{ $trans->total_efectivo_cheque }}
                            </td>
                        </tr>
                        @if ($ultimos_trans->count()>0)
                            <tr>
                                <td>FECHA/DESC</td>
                                <td>VALOR</td>
                                <td>DISPONIBLE</td>
                            </tr>
                            @foreach ($ultimos_trans as $ultr)
                                <tr>
                                    <td>{{ $trans->created_at->toDateString() }} {{ Str::limit($ultr->tipoTransaccion->nombre,30,'.') }}</td>
                                    <td style="text-align: center;">{{ $ultr->total_efectivo_cheque }}</td>
                                    <td style="text-align: center;">{{ $ultr->valor_disponible }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>    
                </td>
            </tr>
        </table>
    </div>
</body>
</html>