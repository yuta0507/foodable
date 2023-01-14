<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    /**
     * Display a listing of restaurants
     */
    public function index()
    {
        $restaurants = Restaurant::byUserId()->paginate(15);

        return view('restaurant.index', compact('restaurants'));
    }

    /**
     * Show the form to create a new restaurant
     */
    public function create()
    {
        return view('restaurant.create');
    }

    /**
     * Store a new restaurant
     */
    public function store(RestaurantRequest $request)
    {
        try {
            DB::beginTransaction();

            Restaurant::create(
                array_merge(
                    ['user_id' => Auth::id()],
                    $request->validated()
                )
            );

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e, ['request' => $request->all()]);

            return redirect()
                ->route('restaurants.create')
                ->with('internal_error', config('message.internal_error'))
                ->withInput()
                ;
        }

        return redirect()
            ->route('restaurants.index')
            ->with('message', config('message.store.success'))
            ;
    }

    /**
     * Show the form to edit the restaurant
     */
    public function edit(int $id)
    {
        $restaurant = Restaurant::byUserId()->where('id', '=', $id)->first();

        return view('restaurant.edit', compact('restaurant'));
    }

    /**
     * Update the restaurant
     */
    public function update(int $id, RestaurantRequest $request)
    {
        try {
            DB::beginTransaction();

            Restaurant::where('id', '=', $id)->update($request->validated());

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e, ['request' => $request->all()]);

            return redirect()
                ->route('restaurants.edit')
                ->with('internal_error', config('restaurants.internal_error'))
                ->withInput()
                ;
        }

        return redirect()
            ->route('restaurants.index')
            ->with('message', config('message.update.success'));
            ;
    }

    /**
     * Delete the restaurant
     */
    public function destroy(int $id, Request $request)
    {
        try {
            DB::beginTransaction();

            Restaurant::destroy($id);

            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error($e, ['request' => $request->all()]);

            return redirect()
                ->route('restaurants.index')
                ->with('internal_error', config('restaurants.internal_error'))
                ;
        }

        return redirect()->route('restaurants.index');
    }
}
