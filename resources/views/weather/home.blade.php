<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Home</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;margin:0;background:#0f1115;color:#e8eaed}
        .wrap{max-width:1100px;margin:0 auto;padding:24px}
        .card{background:#151922;border:1px solid #232a38;border-radius:14px;padding:16px}
        .grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .row{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #232a38}
        .row:last-child{border-bottom:none}
        .muted{color:#aab0bc}
        .pill{display:inline-flex;align-items:center;gap:10px}
        .btn{border:0;border-radius:10px;padding:8px 10px;cursor:pointer}
        .btn-danger{background:#2a0f14;color:#ffb4b4;border:1px solid #4a1a22}
        .btn-danger:hover{filter:brightness(1.1)}
        .trash{font-size:16px;line-height:1}
        .top{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:16px}
        .search{display:flex;gap:10px;align-items:center;flex:1}
        input{width:100%;padding:10px 12px;border-radius:10px;border:1px solid #232a38;background:#0f1115;color:#e8eaed}
        .title{margin:0;font-size:20px}
        .temp{font-weight:700}
    </style>
</head>
<body>
<div class="wrap">

    <div class="card" style="margin-bottom:16px">
        <div class="top">
            <h1 class="title">Weather</h1>

            <form class="search" method="GET" action="#">
                <input type="text" name="q" placeholder="Pretraga grada...">
            </form>
        </div>

        <div class="muted">Lista svih gradova sa ikonicom (emoji) i temperaturom.</div>
    </div>

    <div class="grid">
        <div class="card">
            <h2 class="title" style="font-size:16px;margin-bottom:10px">Svi gradovi</h2>

            @foreach($cities as $city)
                <div class="row">
                    <div>{{ $city->name }}</div>

                    <div class="pill">
                        @if($city->weather)
                            <span>☀️</span>
                            <span class="temp">{{ (int) $city->weather->temperature }}°</span>
                        @else
                            <span class="muted">—</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <h2 class="title" style="font-size:16px;margin-bottom:10px">User favourites</h2>

            @if($favourites->count() === 0)
                <div class="muted">Nema omiljenih gradova.</div>
            @else
                @foreach($favourites as $city)
                    <div class="row">
                        <div class="pill">
                            <div>{{ $city->name }}</div>

                            @if($city->weather)
                                <span class="muted">{{ (int) $city->weather->temperature }}°</span>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('weather.favourites.destroy', $city) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" title="Remove from favourites">
                                <span class="trash">🗑️</span>
                            </button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

</div>
</body>
</html>
