@'
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forecast</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 24px; }
        .city { margin-bottom: 24px; padding: 16px; border: 1px solid #ddd; border-radius: 10px; }
        h1 { margin: 0 0 16px; }
        h2 { margin: 0 0 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
        .muted { color: #666; }
    </style>
</head>
<body>
<h1>Forecast</h1>

@forelse ($cities as $city)
    <div class="city">
        <h2>{{ $city->name }}</h2>

        @if ($city->forecasts->count())
            <table>
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Weather</th>
                    <th>Temp</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($city->forecasts as $forecast)
                    <tr>
                        <td>{{ optional($forecast->date)->format('Y-m-d') }}</td>
                        <td>{{ $forecast->icon }} <span class="muted">{{ $forecast->weather_type }}</span></td>
                        <td>{{ rtrim(rtrim(number_format((float)$forecast->temperature, 2, '.', ''), '0'), '.') }}°C</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="muted">No forecasts.</p>
        @endif
    </div>
@empty
    <p class="muted">No cities found.</p>
@endforelse
</body>
</html>



