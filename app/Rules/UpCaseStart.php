<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UpCaseStart implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value == mb_strtolower($value)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Содержимое дожно начинаться с заглавной буквы.";
    }
}
