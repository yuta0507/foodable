<?php

namespace App\Http\Requests;

use App\Enums\TakeawayFlag;
use App\Rules\ReviewRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestaurantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'genre' => ['required', 'max:255'],
            'user_review' => [new ReviewRule],
            'google_review' => [new ReviewRule],
            'takeaway_flag' => ['required', Rule::in(array_column(TakeawayFlag::cases(), 'value'))],
            'url' => ['max:255'],
        ];
    }
}
