<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class FileTypeRule implements InvokableRule
{
    public function __construct(protected string $type){}

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        match ($this->type) {
            "image" => $this->imageValidate($value, $fail),
            "icon" => $this->iconValidate($value, $fail),
            "song" => $this->songValidate($value, $fail),
        };
    }

    /**
     * @param $value
     * @param $fail
     * @return void
     */
    private function imageValidate($value, $fail): void
    {
        $mimes = ['jpeg', 'png', 'jpg', 'webp'];
        if (!in_array($value->getClientOriginalExtension(), $mimes)) {
            $fail(':attribute must be image!');
        }
    }

    /**
     * @param $value
     * @param $fail
     * @return void
     */
    private function iconValidate($value, $fail): void
    {
        if ($value->getClientOriginalExtension() != 'ico') {
            $fail(':attribute must be icon');
        }
    }

    /**
     * @param $value
     * @param $fail
     * @return void
     */
    private function songValidate($value, $fail): void
    {
        $mimes = ['audio/mpeg', 'mpga', 'mp3', 'wav'];
        if (!in_array($value->getClientOriginalExtension(), $mimes)) {
            $fail(':attribute must be song!');
        }
    }
}
