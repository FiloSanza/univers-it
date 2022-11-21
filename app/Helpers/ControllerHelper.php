<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class ControllerHelper {

    /**
     * Check if a required field is missing.
     *
     * @param \Illuminate\Http\Request  $request.
     * @param array array of fields that need to be in $request.
     * @return string name of the first missing field, null if none is found.
     */
    public static function checkRequiredFields(Request $request, array $fields): ?string {
        foreach ($fields as $field) {
            if (!$request->has($field)) {
                return $field;
            }
        }
        return null;
    }
}

?>