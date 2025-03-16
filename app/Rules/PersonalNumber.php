<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PersonalNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) != 11 || !ctype_digit($value)) {
            $fail('Podany numer PESEL jest niepoprawny.');
            return;
        }

        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += (int)$value[$i] * $weights[$i];
        }

        $controlDigit = (10 - ($sum % 10)) % 10;

        if ($controlDigit !== (int)$value[10]) {
            $fail('Podany numer PESEL jest niepoprawny.');
        }
    }
}
