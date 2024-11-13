<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Visitas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        h3 {
            margin-top: 30px;
            color: #007bff;
        }
        hr {
            border: 1px solid #007bff;
            margin-bottom: 20px;
        }
        .metrics {
            padding: 20px;
            background-color: #e9f7fd;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .metrics p {
            font-size: 18px;
            margin: 5px 0;
        }
        .detailed-report {
            margin-top: 20px;
        }
        .detailed-report table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .detailed-report th, .detailed-report td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }
        .detailed-report th {
            background-color: #f1f1f1;
            font-weight: bold;
            color: #333;
        }
        .detailed-report tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .detailed-report tr:hover {
            background-color: #d1ecf1;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Registro de Visitas</h2>
        <hr>
        <div class="metrics">
            <h3>Métricas Mensuales</h3>
            <p><strong>Total de Visitas:</strong> <span style="color: #28a745;">{{ $total_visitas }}</span></p>
            <p><strong>Total de Alumnos:</strong> <span style="color: #28a745;">{{ $total_alumnos }}</span></p>
            <p><strong>Total de Maestros:</strong> <span style="color: #28a745;">{{ $total_maestros }}</span></p>
            <p><strong>Visitas a Acervo:</strong> <span style="color: #28a745;">{{ $visitas_acervo }}</span></p>
            <p><strong>Visitas a Computo:</strong> <span style="color: #28a745;">{{ $visitas_computo }}</span></p>
            <p><strong>Total de Préstamos Externos:</strong> <span style="color: #28a745;">{{ $prestamos_externos }}</span></p>
            <p><strong>Carrera que Más Visita:</strong> <span style="color: #28a745;">{{ $carrera_mas_visitas }}</span></p>
        </div>

        <div class="detailed-report">
            <h3>Reporte Detallado por Carrera, Tipo de Usuario y Sexo</h3>
            <table>
                <thead>
                    <tr>
                        <th>Carrera</th>
                        <th>Tipo de Usuario</th>
                        <th>Sexo</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos_carreras as $carrera => $items)
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $carrera }}</td>
                                <td>{{ ucfirst($item->tipo_usuario) }}</td>
                                <td>{{ ucfirst($item->sexo) }}</td>
                                <td>{{ $item->cantidad }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Registro de Visitas. Todos los derechos reservados.</p>
        </div>
    </div>

</body>
</html>
