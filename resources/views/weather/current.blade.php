<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Trenutno vreme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Trenutno vreme</h2>

    <form method="GET" action="{{ route('weather.current') }}" class="row g-2 mb-4">
        <div class="col-8">
            <input class="form-control" name="q" value="{{ $q }}" placeholder="Grad (npr. Skopje)">
        </div>
        <div class="col-4">
            <button class="btn btn-primary w-100">Prikaži</button>
        </div>
    </form>

    @if ($error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    @if ($data)
        <div class="card">
            <div class="card-body">
                <h4>{{ $data['location']['name'] }}, {{ $data['location']['country'] }}</h4>

                <div class="display-4">
                    {{ $data['current']['temp_c'] }}°C
                </div>

                <div class="text-muted mb-3">
                    {{ $data['current']['condition']['text'] }}
                </div>

                <ul class="list-group">
                    <li class="list-group-item">Osećaj: {{ $data['current']['feelslike_c'] }}°C</li>
                    <li class="list-group-item">Vlažnost: {{ $data['current']['humidity'] }}%</li>
                    <li class="list-group-item">Vetar: {{ $data['current']['wind_kph'] }} km/h</li>
                    <li class="list-group-item">Pritisak: {{ $data['current']['pressure_mb'] }} mb</li>
                </ul>
            </div>
        </div>
    @endif
</div>

</body>
</html>
