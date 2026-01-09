<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pronađi svoj grad</title>
    <style>
        :root { color-scheme: dark; }
        body{
            margin:0;
            min-height:100vh;
            display:grid;
            place-items:center;
            padding:24px;
            background:#0f172a;
            color:#e5e7eb;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
        }
        .wrap{ width:100%; max-width:560px; }
        .card{
            width:100%;
            background:#0b1220;
            border:1px solid rgba(255,255,255,.08);
            border-radius:18px;
            padding:28px;
            box-shadow:0 20px 50px rgba(0,0,0,.45);
        }
        .icon{
            width:52px;
            height:52px;
            margin:0 auto 10px;
            display:grid;
            place-items:center;
            opacity:.95;
        }
        h1{
            margin:0 0 18px;
            text-align:center;
            font-size:28px;
            line-height:1.1;
            font-weight:900;
        }
        .alert{
            margin:0 0 14px;
            padding:10px 12px;
            border-radius:12px;
            background: rgba(239,68,68,.12);
            border:1px solid rgba(239,68,68,.25);
            color:#fecaca;
            font-size:14px;
        }
        form{ display:grid; gap:12px; }
        input{
            width:100%;
            box-sizing:border-box;
            padding:12px 14px;
            border-radius:12px;
            border:1px solid rgba(255,255,255,.14);
            background: rgba(255,255,255,.05);
            color:#e5e7eb;
            outline:none;
            font-size:14px;
        }
        input:focus{
            border-color: rgba(59,130,246,.65);
            box-shadow:0 0 0 4px rgba(59,130,246,.18);
        }
        button{
            width:100%;
            padding:12px 14px;
            border:0;
            border-radius:12px;
            background:#2563eb;
            color:#fff;
            font-weight:800;
            font-size:14px;
            cursor:pointer;
        }
        button:hover{ background:#1d4ed8; }

        .cities{
            margin-top:18px;
            padding-top:16px;
            border-top:1px solid rgba(255,255,255,.08);
        }
        .cities-title{
            font-size:14px;
            font-weight:900;
            opacity:.9;
            margin:0 0 12px;
            letter-spacing:.2px;
        }
        .grid{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
        }
        .chip{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:8px 10px;
            border-radius:999px;
            text-decoration:none;
            color:#e5e7eb;
            background: rgba(255,255,255,.05);
            border:1px solid rgba(255,255,255,.10);
            font-size:13px;
            font-weight:800;
        }
        .chip:hover{
            border-color: rgba(59,130,246,.35);
            background: rgba(59,130,246,.10);
        }
        .dot{
            width:8px;
            height:8px;
            border-radius:999px;
            background: rgba(59,130,246,.9);
            box-shadow:0 0 0 3px rgba(59,130,246,.18);
        }
        .empty{
            margin-top:10px;
            font-size:12px;
            opacity:.75;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <div class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="36" height="36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 10.5L12 3l9 7.5V21a.75.75 0 0 1-.75.75H3.75A.75.75 0 0 1 3 21V10.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                    <path d="M9.5 21V14.5A2.5 2.5 0 0 1 12 12a2.5 2.5 0 0 1 2.5 2.5V21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>

            <h1>Pronađi<br>svoj grad</h1>

            @if (session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif

            <form method="GET" action="{{ route('forecast.show') }}">
                <input type="text" name="q" placeholder="Unesite ime grada" autocomplete="off" required>
                <button type="submit">Pronađi</button>
            </form>

            <div class="cities">
                <div class="cities-title">Svi gradovi</div>

                @if (isset($cities) && $cities->count())
                    <div class="grid">
                        @foreach ($cities as $c)
                            <a class="chip" href="{{ route('forecast.show', ['q' => $c->name]) }}">
                                <span class="dot" aria-hidden="true"></span>
                                <span>{{ $c->name }}</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty">Nema gradova za prikaz.</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
