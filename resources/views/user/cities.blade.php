<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cities</title>
</head>
<body>

<h1>Gradovi korisnika: {{ $user->name }}</h1>

@if($user->cities->count())
    @foreach($user->cities as $city)

        <h2>{{ $city->name }}</h2>

        <p>
            Trenutna temperatura:
            {{ $city->weather ? $city->weather->temperature : 'nema' }}
        </p>

        @if($city->forecasts->count())
            <h4>Prognoza</h4>
            <ul>
                @foreach($city->forecasts as $forecast)
                    <li>
                        {{ $forecast->date }} :
                        {{ $forecast->temperature }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Nema prognoze.</p>
        @endif

        <hr>

    @endforeach
@else
    <p>Korisnik nema dodeljene gradove.</p>
@endif

</body>
</html>
