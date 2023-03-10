<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Members;
use App\Models\Pay;
use App\Models\Wanted;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function checkOut(Request $request)
    {
        CheckOut::create([
           'member_id' => $request->id,
           'hand_number' => 1
        ]);
        return redirect()->back();
    }

    public function unCheckOut(Request $request)
    {
        $unCheck = CheckOut::where('member_id', $request->id)->first()->delete();
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $hands = Members::get();
        $wanteds = Wanted::get();
        $checouts = CheckOut::get();
        $pays = Pay::get();
        foreach ($hands as $hand) { $hand->update([ 'hands' => 0 ]); }
        foreach ($wanteds as $wanted) { $wanted->update([ 'all_wanted' => 0,'mem_payment' => 0,'mem_payment_left' => 0, ]); }
        foreach ($checouts as $checout) {$checout->delete(); }
        foreach ($pays as $pay) {$pay->delete(); }
        return redirect()->back();
    }
}
