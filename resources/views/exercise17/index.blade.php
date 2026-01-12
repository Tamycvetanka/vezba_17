<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Exercise 17</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #0f1115;
            color: #e8eaed;
            margin: 0;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 24px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .card {
            background: #151922;
            border: 1px solid #232a38;
            border-radius: 12px;
            padding: 16px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #232a38;
        }

        .row:last-child {
            border-bottom: none;
        }

        .temp {
            font-weight: bold;
        }

        .muted {
            color: #9aa0aa;
        }

        button {
            background: #2a0f14;
            color: #ffb4b4;
            border: 1px solid #4a1a22;
            border-radius: 8px;
            padding: 6px 10px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Exercise 17 – Weather favourites</h1>

    <div class="grid">
        <div class="card">
            <h3>All cities</h3>

            @foreach($cities as $city)
                <div class="row">
                    <div>{{ $city->name }}</div>

                    @if($city->weather)
                        <div class="temp">
                            SUN {{ (int) $city->weather->temperature }}°
                        </div>
                    @else
                        <div class="muted">-</div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="card">
            <h3>User favourites</h3>

            @if($favourites->count() === 0)
                <p class="muted">No favourite cities.</p>
            @else
                @foreach($favourites as $city)
                    <div class="row">
                        <div>
                            {{ $city->name }}
                            @if($city->weather)
                                <span class="muted">
                                    ({{ (int) $city->weather->temperature }}°)
                                </span>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('exercise17.favourites.destroy', $city) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">REMOVE</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

</body>
</html>
