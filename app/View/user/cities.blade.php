<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Cities</title>
</head>
<body>

<h1>My Cities</h1>

@foreach ($user->cities as $city)
    <h3>{{ $city->name }}</h3>

    <ul>
        @foreach ($city->forecasts as $forecast)
            <li>{{ $forecast->date }} — {{ $forecast->temperature }} °C</li>
        @endforeach
    </ul>

    <hr>
@endforeach

</body>
</html>
