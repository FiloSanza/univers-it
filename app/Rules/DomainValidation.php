<?php

namespace App\Rules;

use App\Models\University;
use Illuminate\Contracts\Validation\Rule;

class DomainValidation implements Rule
{
    /**
     * Determine if the email is a valid university's email.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $domain = explode('@', $value)[1];

        $domains_array = University::select('domain')->get()->toArray();
        $domains_array = array_map(fn($v) => array_values($v)[0], $domains_array);
        
        if (!in_array($domain, $domains_array)) {
            return False;
        }

        return True;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The email must be a valid university\'s email.';
    }
}
