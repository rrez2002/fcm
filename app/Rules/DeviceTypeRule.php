<?php

namespace App\Rules;

use App\Enums\DeviceTypeEnum;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class DeviceTypeRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        if (empty(DeviceTypeEnum::tryFrom($value))) {
            $fail(__("validation.in_array", ["attribute" => __("device type"), "other" => __("device types")]));
        }
    }
}
