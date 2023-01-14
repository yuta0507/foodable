<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakerRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::byUserId()->paginate(15);

        return view('restaurant.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurant.create');
    }

    public function store(MakerRequest $request)
    {
        try {
            DB::beginTransaction();

            Restaurant::create($request->all());

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return redirect()
                ->route('restaurants.create')
                ->with('internal_error', config('message.internal_error'))
                ->withInput()
                ;
        }

        return redirect()->route('restaurants.index');
    }

    public function edit(int $id)
    {

    }

    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();

            Restaurant::destroy($id);

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return redirect()
                ->route('restaurants.index')
                ->with('internal_error', config('restaurants.internal_error'))
                ;
        }

        return redirect()->route('restaurants.index');
    }
}
