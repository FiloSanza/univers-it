<?php

namespace App\Rules;

use App\Models\University;
use Illuminate\Contracts\Validation\Rule;

class DomainValidation implements Rule
{
    /**
     * Determine if the email is an university's email.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $domain = explode('@', $value)[1];

        $domains = University::select('domain')->get()->toArray();
        $domains = array_map(fn($v) => array_values($v)[0], $domains);
        
        if (!in_array($domain, $domains)) {
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
        return 'The email must be an university\'s email.';
    }
}
