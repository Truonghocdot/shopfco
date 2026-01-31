<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        $transactions = collect(); // Empty collection for guest users

        if (Auth::check()) {
            $transactions = Transaction::where('user_id', Auth::id())
                ->where('service_type', 0) // topup only
                ->latest()
                ->take(10)
                ->get();
        }

        $bankBin = \App\Models\Setting::get(\App\Constants\SettingName::BIN_BANK->value);
        $bankNumber = \App\Models\Setting::get(\App\Constants\SettingName::ACCOUNT_NUMBER->value);
        $bankName = \App\Models\Setting::get(\App\Constants\SettingName::ACCOUNT_NAME->value);
        $banking = \App\Models\Setting::get(\App\Constants\SettingName::BANKING->value);

        return view('deposit', compact('transactions', 'bankBin', 'bankNumber', 'bankName', 'banking'));
    }
}
