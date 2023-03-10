<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Wanted;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $allHands = Members::sum('hands');
        $allMoney = Wanted::sum('all_wanted');
        $memMoney = Wanted::sum('mem_payment');
        $leftMoney = $allMoney - $memMoney ;
//        return $allHands;
        return view('invoice.index', compact(['allHands', 'allMoney', 'memMoney', 'leftMoney']));
    }
}
