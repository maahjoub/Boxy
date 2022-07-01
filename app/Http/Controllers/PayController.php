<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Pay;
use App\Models\Wanted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    public function index()
    {
        $members = Members::
            with('wanted')
        ->get();
        return view('pay.index', compact('members'));
    }

    public function pay($id)
    {
        $member = Members::find($id);
        return view('pay.payment', compact('member'));
    }
    public function store(Request $request)
    {
        $wanted = Wanted::where('member_id', $request->id)->first();
        DB::beginTransaction();
        try {
            $member = Pay::create([
                'member_pay' => $request->money,
                'member_id' => $request->id,
                'pay_date' => $request->date,

            ]);
            $wanted->update([
                'mem_payment' => $request->money,
                'mem_payment_left' => ($wanted->all_wanted - $request->money),
            ]);
            DB::commit();
            return redirect()->route('payment');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
