<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $city->name }} - Prognoza</title>
    <style>
        :root { color-scheme: dark; }
        body{
            margin:0;
            min-height:100vh;
            padding:24px;
            background:#0f172a;
            color:#e5e7eb;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
        }
        .wrap{ max-width:920px; margin:0 auto; }
        .top{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:12px;
            flex-wrap:wrap;
            margin-bottom:16px;
        }
        h1{ margin:0; font-size:28px; font-weight:900; line-height:1.1; }
        .pill{
            display:inline-block;
            margin-top:10px;
            padding:6px 10px;
            border-radius:999px;
            background: rgba(59,130,246,.16);
            border:1px solid rgba(59,130,246,.22);
            color:#bfdbfe;
            font-weight:800;
            font-size:12px;
        }
        .actions{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            align-items:center;
        }
        .back{
            display:inline-flex;
            align-items:center;
            gap:8px;
            text-decoration:none;
            color:#93c5fd;
            font-weight:800;
            padding:10px 12px;
            border-radius:12px;
            background: rgba(255,255,255,.05);
            border:1px solid rgba(255,255,255,.10);
        }
        .btn{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 12px;
            border-radius:12px;
            border:1px solid rgba(255,255,255,.10);
            background: rgba(255,255,255,.05);
            color:#e5e7eb;
            font-weight:900;
            cursor:pointer;
        }
        .btn-primary{
            background:#2563eb;
            border-color: rgba(37,99,235,.55);
            color:#fff;
        }
        .btn-danger{
            background: rgba(239,68,68,.14);
            border-color: rgba(239,68,68,.30);
            color:#fecaca;
        }
        .card{
            background:#0b1220;
            border:1px solid rgba(255,255,255,.08);
            border-radius:18px;
            padding:18px;
            box-shadow:0 20px 50px rgba(0,0,0,.35);
        }
        .empty{
            padding:14px;
            border-radius:14px;
            background: rgba(255,255,255,.04);
            border:1px solid rgba(255,255,255,.08);
            font-size:14px;
            opacity:.9;
        }
        table{ width:100%; border-collapse:collapse; overflow:hidden; border-radius:14px; }
        th,td{
            text-align:left;
            padding:12px 10px;
            border-bottom:1px solid rgba(255,255,255,.08);
            font-size:14px;
            vertical-align:top;
        }
        th{ font-weight:900; opacity:.9; }
        tr:last-child td{ border-bottom:0; }
        .muted{ opacity:.85; }
        .badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:6px 10px;
            border-radius:999px;
            background: rgba(255,255,255,.05);
            border:1px solid rgba(255,255,255,.10);
            font-weight:800;
            font-size:12px;
        }
        .dot{
            width:8px;height:8px;border-radius:999px;
            background: rgba(59,130,246,.9);
            box-shadow:0 0 0 3px rgba(59,130,246,.18);
        }
        .temp{ font-weight:900; font-size:16px; }
    </style>
</head>
<body>
@php
    $isFav = in_array($city->id, $favoriteCityIds ?? []);
@endphp

<div class="wrap">
    <div class="top">
        <div>
            <h1>{{ $city->name }} @if($isFav) ⭐ @endif</h1>
            <div class="pill">Rezultat pretrage: {{ $q }}</div>
        </div>

        <div class="actions">
            <a class="back" href="{{ route('forecast.search') }}">← Nazad</a>

            @if(!$isFav)
                <form method="POST" action="{{ route('favorites.attach', $city) }}">
                    @csrf
                    <button class="btn btn-primary" type="submit">⭐ Dodaj u favorite</button>
                </form>
            @else
                <form method="POST" action="{{ route('favorites.detach', $city) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">🗑️ Ukloni iz favorita</button>
                </form>
            @endif
        </div>
    </div>

    <div class="card">
        @if ($forecasts->count() === 0)
            <div class="empty">Nema prognoza za ovaj grad u bazi.</div>
        @else
            <table>
                <thead>
                <tr>
                    <th style="width:160px;">Datum</th>
                    <th>Opis</th>
                    <th style="width:160px;">Temperatura</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($forecasts as $f)
                    @php
                        $a = $f->getAttributes();
                        $date = $a['date'] ?? ($a['day'] ?? ($a['datum'] ?? '-'));
                        $desc = $a['description'] ?? ($a['opis'] ?? ($a['weather'] ?? ($a['status'] ?? '-')));
                        $tempVal = $a['temperature'] ?? ($a['temp'] ?? ($a['temp_c'] ?? ($a['degrees'] ?? null)));
                        $temp = is_null($tempVal) ? '-' : $tempVal;

                        $iconText = '☁️';
                        $d = mb_strtolower((string)$desc);
                        if (str_contains($d, 'sun') || str_contains($d, 'sunny') || str_contains($d, 'clear') || str_contains($d, 'vedro') || str_contains($d, 'sunce')) $iconText = '☀️';
                        if (str_contains($d, 'rain') || str_contains($d, 'kiša') || str_contains($d, 'kisa') || str_contains($d, 'pljusak')) $iconText = '🌧️';
                        if (str_contains($d, 'snow') || str_contains($d, 'sneg') || str_contains($d, 'snijeg')) $iconText = '❄️';
                        if (str_contains($d, 'storm') || str_contains($d, 'oluja') || str_contains($d, 'grmljavina')) $iconText = '⛈️';
                    @endphp
                    <tr>
                        <td class="muted">{{ $date }}</td>
                        <td>
                            <span class="badge"><span class="dot"></span><span>{{ $iconText }} {{ $desc }}</span></span>
                        </td>
                        <td class="temp">@if ($temp !== '-') {{ $temp }}° @else - @endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>
