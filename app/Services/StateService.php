<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class StateService
{
    /**
     * get states from country
     */
    public function getStates(
        $countryId
    ) {
        $query = DB::table('states')->where('country_id', $countryId);

        return $query;
    }
}
