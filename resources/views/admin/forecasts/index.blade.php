@extends('admin.layout')

@section('title', 'Prognoze')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-1">Prognoze</h1>
            <div class="text-muted">Admin pregled prognoza</div>
        </div>
    </div>

    <div class="card p-3 mb-4">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Filter po gradu</label>
                <select name="city_id" class="form-select">
                    <option value="">Svi gradovi</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" @selected($cityId == $city->id)>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-dark w-100">
                    <i class="fa-solid fa-filter me-1"></i> Filter
                </button>
            </div>

            <div class="col-md-3">
                <a class="btn btn-outline-secondary w-100" href="{{ route('admin.forecasts.index') }}">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>Datum</th>
                    <th>Grad</th>
                    <th>Vreme</th>
                    <th class="text-end">Temperatura</th>
                </tr>
                </thead>
                <tbody>
                @forelse($forecasts as $f)
                    <tr>
                        <td class="fw-semibold">{{ $f->date->format('d.m.Y') }}</td>
                        <td>{{ $f->city->name }}</td>
                        <td>
                            <i class="{{ \App\Models\Forecast::iconFor($f->weather_type) }} me-2"></i>
                            <span class="text-capitalize">{{ $f->weather_type }}</span>
                        </td>
                        <td class="text-end fw-bold">{{ $f->temperature }}°C</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted p-4">Nema prognoza.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
