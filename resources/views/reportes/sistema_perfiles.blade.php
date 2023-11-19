<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SistemaPerfiles</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1.5cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 3px;
        }

        table thead tr th,
        tbody tr td {
            font-size: 0.75em;
            word-wrap: break-word;
        }

        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            width: 150px;
            height: 60px;
            top: -20px;
            left: -20px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 400px;
            text-align: center;
            margin: auto;
            margin-top: 0;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.75em;
            text-align: left;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td.franco {
            background: red;
            color: white;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .p_cump {
            color: red;
            font-size: 1.2em;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }

        .sistema {
            font-size: 0.8em;
            margin-bottom: 0px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="{{ asset('imgs/logo.png') }}" alt="Logo">
    </div>
    <div class="encabezado">
        <h4 class="texto">SISTEMA Y PERFILES DEL SISTEMA</h4>
        <h4 class="fecha">Expedido: {{ date('d-m-Y') }}</h4>
    </div>
    @foreach ($sistemas as $sistema)
        <p class="sistema"><strong>Nombre del sistema:</strong> {{ $sistema->nombre }}</p>
        <table border="1">
            <thead>
                <tr>
                    <th class="centreado">Perfiles</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <ol>
                            @foreach ($sistema->perfiles as $perfil)
                                <li>{{ $perfil->perfil->nombre }}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>

</html>
