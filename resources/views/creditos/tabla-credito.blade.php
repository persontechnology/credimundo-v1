<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead>
            <tr style="text-align: left;">
                <td scope="col">
                    <strong>N° de Crédito: </strong> {{ $credito->numero }} <br>
                    <strong>N° de Cuenta: </strong> {{ $credito->cuentaUser->numero }} {{ $credito->cuentaUser->tipoCuenta->nombre }}<br>
                    <strong>Socio: </strong> {{ $credito->cuentaUser->user->identificacion }} {{ $credito->cuentaUser->user->apellidos_nombres }} <br>
                    <strong>Tipo de Crédito: </strong> {{ $credito->tipoCredito->nombre }} <br>
                    <strong>Asesor: </strong> {{ $credito->creadoPor->apellidos_nombres }} <br>
                    <strong>Monto de Financiado: </strong> {{ number_format($credito->monto,2) }} <br>
                    <strong>Actividad: </strong> <small>{{ $credito->tipoCredito->descripcion }}</small> <br>
                </td>
                <td scope="col">
                    <strong>Día de Pago: </strong>{{ Carbon\Carbon::parse($credito->dia_pago)->format('d'); }} <br>
                    <strong>Fecha de Vencimiento: </strong>{{ $credito->fecha_vencimiento_c }} <br>
                    <strong>Tasa Efectiva Anual: </strong>{{ $credito->tasa_efectiva_anual }}% <br>
                    <strong>Ahorro programado: </strong>{{ $credito->ahorro_programado }} <br>
                    <strong>Plazo:</strong> {{ $credito->plazo }}<br>
                    <strong>Adjudicación: </strong>{{ $credito->created_at->format('Y-m-d') }} <br>
                    <strong>Tasa nominal: </strong>{{ $credito->tasa_nominal }}% <br>

                </td>
            </tr>
        </thead>
    </table>
</div>

<div class="table-responsive" style="margin-top: 5px;">
    <table class="table table-sm table-bordered">
        
        <tbody>
            <tr>
                <td>
                    <strong>Pago Mensual: </strong> <br>{{ number_format($credito->pago_mensual,2) }}
                </td>
                <td>
                    <strong>Número de Pagos: </strong> <br>{{ $credito->numero_cuotas }}
                </td>
                <td>
                    <strong>Pagos Totales: </strong> <br>{{ number_format($credito->pagos_totales,2) }}
                </td>
                <td>
                    <strong>Interés Total: </strong> <br>{{ number_format($credito->interes_totales,2) }}
                </td>
                <td>
                    <strong>Total Ahorro Programado </strong> <br>{{ number_format($credito->total_ahorro_programado,2) }}
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="table-responsive mt-2" style="margin-top: 5px;">
    <table class="table table-sm table-bordered">
        
        <tbody>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha de pago</th>
                <th scope="col">Monto de pago</th>
                <th scope="col">Ahorro Programado</th>
                <th scope="col">Interés total</th>
                <th scope="col">Pagos totales</th>
                <th scope="col">Saldo capital</th>
                <th scope="col">Total a pagar</th>
                <th scope="col">Estado</th>
            </tr>
            @foreach ($credito->tablaCreditos as $tc)
            <tr class="">
                <td scope="col">{{ $tc->numero }}</td>
                <td scope="col" style="text-align: left;">{{ $tc->fecha_pago_c }}</td>
                <td scope="col">{{ number_format($tc->monto_pago,2) }}</td>
                <td scope="col">{{ number_format($credito->ahorro_programado,2) }}</td>
                <td scope="col">{{ number_format($tc->interes_total,2) }}</td>
                <td scope="col">{{ number_format($tc->pagos_total,2) }}</td>
                <td scope="col">{{ number_format($tc->saldo_capital,2) }}</td>
                <td scope="col">{{ number_format($tc->total_pagar,2) }}</td>
                <td scope="col">
                    <small>{{ $tc->estado }}</small>
                </td>
            </tr>    
            @endforeach
            
        </tbody>
    </table>
</div>

<div class="notas-aclaratorias">
    <p>NOTAS ACLARATORIAS</p>
    <p>
        - Si la fecha de pago coincide con el fin de semana o día festivo, por favor acérquese a pagar un día antes. <br>
    </p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
        
            <tbody>
                <tr>
                    <th colspan="4">CARGA FINANCIERA</th>
                </tr>
                <tr>
                    <th scope="col">Capital</th>
                    <th scope="col">Interés</th>
                    <th scope="col">Ahorro programado</th>
                    <th scope="col">Total</th>
                </tr>
                <tr class="">
                    <td scope="row">{{ number_format($credito->monto,2) }}</td>
                    <td>{{ number_format($credito->interes_totales,2) }}</td>
                    <td>{{ number_format($credito->total_ahorro_programado,2) }}</td>
                    <td>{{ number_format($credito->pagos_totales+$credito->total_ahorro_programado,2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>
        - La siguente tabla esta sujeta a cambios segun las regulaciones emitidas por Banco Central del Ecuador.
    </p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <tbody>
                <tr>
                    <th scope="col">Días de retraso</th>
                    <th scope="col">Recarga por morosidad</th>
                </tr>
                <tr class="">
                    <td scope="row">0</td>
                    <td>0,00%</td>
                </tr>
                <tr class="">
                    <td scope="row">1-60</td>
                    <td>0,00%</td>
                </tr>
                <tr class="">
                    <td scope="row">+61</td>
                    <td>10,00%</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>Según Resolución N° 138-2015-F de la junta de Regulación Monetaría Financiera, donde se indica en el Art. 7.- "Los cargos por servicios de cobranzas extrajudiciales se aplicarán a los créditos que se encuentren en proceso judicial...", al mismo tiempo en el Art.3.- "Las entidades financieras podrán efectuar cargos por servicios financieros que hayan sido aceptados de manera previa y expresa por el cliente y/o usuario"</p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            
            <tbody>
                <tr>
                    <th scope="col">Días vencidos =></th>
                    <th scope="col">De 1 A 30 días</th>
                    <th scope="col">De 31 A 60 días</th>
                    <th scope="col">De 61 A 90 días</th>
                    <th scope="col">Mayor A 90 días</th>
                </tr>
                <tr class="">
                    <td scope="row">Monto Cuota vencida</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="">
                    <td scope="row">Menor a $100</td>
                    <td>$ 6.38</td>
                    <td>$ 16.23</td>
                    <td>$ 23.17</td>
                    <td>$ 25.56</td>
                </tr>
                <tr class="">
                    <td scope="row">Desde $ 100 a $199</td>
                    <td>$ 7.35</td>
                    <td>$ 16.46</td>
                    <td>$ 23.85</td>
                    <td>$ 26.64</td>
                </tr>
                <tr class="">
                    <td scope="row">Desde $ 200 a $299</td>
                    <td>$ 7.92</td>
                    <td>$ 17.83</td>
                    <td>$ 25.27</td>
                    <td>$ 29.03</td>
                </tr>
                <tr class="">
                    <td scope="row">Desde $ 300 a $499</td>
                    <td>$ 8.32</td>
                    <td>$ 20.34</td>
                    <td>$ 27.43</td>
                    <td>$ 32.72</td>
                </tr>
                <tr class="">
                    <td scope="row">Desde $ 500 a $999</td>
                    <td>$ 8.63</td>
                    <td>$ 23.99</td>
                    <td>$ 30.34</td>
                    <td>$ 37.70</td>
                </tr>
                <tr class="">
                    <td scope="row">Desde $ 1000 en adelante</td>
                    <td>$ 8.88</td>
                    <td>$ 28.78</td>
                    <td>$ 34.01</td>
                    <td>$ 43.99</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>
        Nota: A los valores antes indicados se les agregará el valor que corresponde por concepto de IVA. <br>
        Autorizo a {{ config('app.name','CREDIMUNDO') }} a cobrar los valores antes indicados por gestión de cobranzas extrajudiciales.
    </p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered" style="text-align: left;">
            <tbody>
                <tr class="">
                    <td scope="row">CONCEPTO</td>
                    <td>EXPLICACIÓN</td>
                </tr>
                <tr class="">
                    <th scope="row">Monto Finaciado</th>
                    <td>Es la cantidad de dinero que solicita el potencial cliente o cliente.</td>
                </tr>
                <tr class="">
                    <th scope="row">Tasa de interés efectiva</th>
                    <td>Es la tasa de interés que se cobra en función de las condiciones de la operación crediticia al final del periodo.</td>
                </tr>
                <tr class="">
                    <th scope="row">Tasa de interés variable</th>
                    <td>Se utiliza cuando durante la vigencia del crédito se cambia la tasa.</td>
                </tr>
                <tr class="">
                    <th scope="row">Recarga por morosidad</th>
                    <td>Es un porcentaje adicional que se cobra cuando las operaciones de crédito presentan diás de atraso, su aplicación es para el capital de la cuota mora..</td>
                </tr>
                <tr class="">
                    <th scope="row">Gastos - Costos</th>
                    <td>Los gastos/costos de la operación crediticia solo los asociados en la concesión como costos de cobranza extrajudicial.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>Firman:</p>

    <table style="border: none; text-align: center;">
        <tr style="border: none;">
            <td style="border: none;">
                <br><br><br>
                .......................................................................................... <br>
                {{ $credito->cuentaUser->user->apellidos_nombres }} <br>
                {{ $credito->cuentaUser->user->identificacion }} <br>
                <strong>Socio</strong>
            </td>
            @if ($credito->cuentaUser->user->nombre_conyuge)
                <td style="border: none;">
                    <br><br><br>
                    .......................................................................................... <br>
                    {{ $credito->cuentaUser->user->nombre_conyuge }} <br>
                    {{ $credito->cuentaUser->user->identificacion_conyuge }} <br>
                    <strong>CONYUGE</strong>
                </td>  
            @endif
            
        </tr>
    </table>
    <div style="text-align: center;">
    
        <div class="col">
            <br><br><br>
            .......................................................................................... <br>
            {{ $credito->creadoPor->apellidos_nombres }} <br>
            {{ $credito->creadoPor->identificacion }} <br>
            <strong>Asistente de negocio</strong>
        </div>
    
        @foreach ($credito->garantes as $ga)
            <div class="col">
                <br><br><br>
                .......................................................................................... <br>
                {{ $ga->apellidos_nombres }} <br>
                {{ $ga->identificacion }} <br>
                <strong>Garante</strong>
            </div>
        @endforeach
    </div>
</div>