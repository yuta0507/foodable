<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class RestaurantsController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::byUserId()->paginate(15);

        return view('restaurants.index', compact('restaurants'));
    }
}
