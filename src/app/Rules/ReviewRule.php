<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReviewRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     * @link http://pgcafe.moo.jp/Regex/main_4.htm
     */
    public function passes($attribute, $value)
    {
        // 0.0 ~ 5.0 (0.1 step only)
        return preg_match('/^5$|^5.0$|^([0-4])(\.[0-9]{0,1})?$/', $value) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The input value is invalid. Please input a number between 0.0 ~ 5.0';
    }
}
