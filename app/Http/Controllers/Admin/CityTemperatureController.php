<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CityTemperature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityTemperatureController extends Controller
{
    public function index(): View
    {
        $cities = CityTemperature::orderBy('city')->get();
        return view('admin.cities.index', compact('cities'));
    }

    public function create(): View
    {
        return view('admin.cities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'city' => ['required', 'string', 'max:255'],
            'temperature' => ['required', 'integer', 'between:-50,60'],
        ]);

        CityTemperature::create($validated);

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'Grad je uspešno dodat.');
    }

    public function edit(CityTemperature $cityTemperature): View
    {
        return view('admin.cities.edit', compact('cityTemperature'));
    }

    public function update(Request $request, CityTemperature $cityTemperature): RedirectResponse
    {
        $validated = $request->validate([
            'city' => ['required', 'string', 'max:255'],
            'temperature' => ['required', 'integer', 'between:-50,60'],
        ]);

        $cityTemperature->update($validated);

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'Grad je uspešno izmenjen.');
    }

    public function destroy(CityTemperature $cityTemperature): RedirectResponse
    {
        $cityTemperature->delete();

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'Grad je uspešno obrisan.');
    }
}
