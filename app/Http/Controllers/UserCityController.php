<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;

class UserCityController extends Controller
{
    public function attach(City $city)
    {
        $user = User::findOrFail(1);
        $user->cities()->syncWithoutDetaching([$city->id]);

        return redirect()->back();
    }

    public function detach(City $city)
    {
        $user = User::findOrFail(1);
        $user->cities()->detach($city->id);

        return redirect()->back();
    }
}
