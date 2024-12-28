<?php

namespace App\Http\Controllers;

use App\Services\StateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    /**
     * get states based on country
     */
    public function getStates(
        int $countryId,
        StateService $stateService
    ) {
        try {
            $states = $stateService
                ->getStates($countryId)
                ->get();
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'States fetched successfully',
            'data' => $states
        ];
    }
}
