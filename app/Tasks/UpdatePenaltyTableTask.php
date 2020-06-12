<?php

namespace App\Tasks;

use App\Rent;
use Carbon\Carbon;


const DEADLINE_IN_DAYS = 15;
const PENALTY_PER_DAY_IN_US_DOLLARS = 1;
const DIFF_IN_DAYS_CLEANUP = 1;

class UpdatePenaltyTableTask 
{
    public function __invoke()
    {
        $pastDueRents = Rent::where([
            ['created_at','<', Carbon::now()->subDays(DEADLINE_IN_DAYS)->toDateTimeString()],
            ['returned',false],
        ])->get();
        foreach ($pastDueRents as $rent) {
            $to = Carbon::createFromFormat('Y-m-d H:s:i', $rent->created_at);
            $from = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now()->subDays(14)->toDateTimeString());
            $diffInDays = $to->diffInDays($from);
            $quantity = $rent->quantity;
            $id = $rent->id;
            $rent->penalty()->updateOrCreate(
                ['rent_id' => $id],
                ['penalty' => (($diffInDays+DIFF_IN_DAYS_CLEANUP)*PENALTY_PER_DAY_IN_US_DOLLARS*$quantity)],
            );
        }
    }
}
