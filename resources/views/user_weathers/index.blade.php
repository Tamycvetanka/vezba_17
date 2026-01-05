<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>User Weathers</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Vremenski podaci korisnika</h1>

@if ($userWeathers->isEmpty())
    <p>Nema podataka u tabeli <strong>user_weathers</strong>.</p>
@else
    <table>
        <thead>
        <tr>
            <th>Korisnik</th>
            <th>Grad</th>
            <th>Temperatura</th>
            <th>Datum</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($userWeathers as $userWeather)
            <tr>
                <td>{{ $userWeather->user?->name ?? 'N/A' }}</td>
                <td>{{ $userWeather->city?->name ?? 'N/A' }}</td>
                <td>{{ $userWeather->temperature }} °C</td>
                <td>{{ $userWeather->date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

</body>
</html>
