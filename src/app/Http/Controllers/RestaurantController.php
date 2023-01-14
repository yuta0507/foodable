<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
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

    public function store(RestaurantRequest $request)
    {
        try {
            DB::beginTransaction();

            Restaurant::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'genre' => $request->genre,
                'user_review' => $request->user_review,
                'google_review' => $request->google_review,
                'takeaway_flag' => $request->takeaway_flag,
                'url' => $request->url,
            ]);

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

        return redirect()
            ->route('restaurants.index')
            ->with('message', config('message.store.success'));
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
