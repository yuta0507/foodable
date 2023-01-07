<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::byUserId()->paginate(15);

        return view('restaurant.index', compact('restaurants'));
    }

    public function destroy(int $id)
    {
        Restaurant::destroy($id);

        return redirect()->route('restaurants.index');
    }
}
