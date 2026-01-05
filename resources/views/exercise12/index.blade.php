<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>12. vežba – Vremenska prognoza</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">🌤 Vremenska prognoza – 12. vežba</h1>

    @foreach($cities as $city)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <strong>{{ $city->name }}</strong>
                <span>
                    Trenutno: {{ $city->weather->temperature ?? 'N/A' }} °C
                </span>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Datum</th>
                        <th>Temperatura</th>
                        <th>Vreme</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($city->forecasts as $forecast)
                        <tr>
                            <td>{{ $forecast->date->format('d.m.Y') }}</td>
                            <td>{{ $forecast->temperature }} °C</td>
                            <td>{{ ucfirst($forecast->weather_type ?? 'sunčano') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>

