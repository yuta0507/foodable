<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->user()->update($request->validated());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e, ['request' => $request->all()]);

            return Redirect::route('profile.edit')
                ->with('alert', config('message.internal_error'))
                ->withInput()
                ;
        }

        return Redirect::route('profile.edit')
            ->with('message', config('message.update.success'))
            ;
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e, ['request' => $request->all()]);

            return Redirect::route('login')
                ->with('alert', config('message.internal_error'))
                ;
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('login');
    }
}
