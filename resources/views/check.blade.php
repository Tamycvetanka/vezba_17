<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Check</title>
</head>
<body>

@foreach ($cities as $city)
    <h2>{{ $city->name }}</h2>

    <p>
        Weather:
        {{ $city->weather ? $city->weather->temperature : 'nema' }}
    </p>

    <h4>Forecasts</h4>
    <ul>
        @foreach ($city->forecasts as $forecast)
            <li>{{ $forecast->date }} : {{ $forecast->temperature }}</li>
        @endforeach
    </ul>

    <h4>Users</h4>
    <ul>
        @foreach ($city->users as $user)
            <li>
                {{ $user->name }}
                ({{ $user->pivot->temperature }},
                {{ $user->pivot->date }})
            </li>
        @endforeach
    </ul>

    <hr>
@endforeach

</body>
</html>
