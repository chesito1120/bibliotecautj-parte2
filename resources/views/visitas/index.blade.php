<!DOCTYPE html>
<html lang="en">
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            margin-right: 10px;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .metrics, .detailed-report {
            margin-top: 20px;
        }
        .metrics p, .detailed-report p {
            margin: 5px 0;
        }
        .detailed-report table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .detailed-report th, .detailed-report td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        .detailed-report th {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Registro de Visitas</h2>
        <hr>
        <div class="metrics">
            <h3>Métricas Mensuales</h3>
            <p><strong>Total de Visitas:</strong> {{ $total_visitas }}</p>
            <p><strong>Total de Alumnos:</strong> {{ $total_alumnos }}</p>
            <p><strong>Total de Maestros:</strong> {{ $total_maestros }}</p>
            <p><strong>Visitas a Acervo:</strong> {{ $visitas_acervo }}</p>
            <p><strong>Visitas a Computo:</strong> {{ $visitas_computo }}</p>
            <p><strong>Total de Préstamos Externos:</strong> {{ $prestamos_externos }}</p>
            <p><strong>Carrera que Más Visita:</strong> {{ $carrera_mas_visitas }}</p>
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
    </div>

</body>
</html>
