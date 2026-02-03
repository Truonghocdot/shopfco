<?php

namespace App\Livewire;

use App\Models\LuckyWheelHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Vòng Quay May Mắn')]
class LuckyWheelPage extends Component
{
    public $prizeAmount = null;
    public $prizeLabel = '';
    public $showResult = false;
    public $spinning = false;

    // Prize probabilities
    protected $prizes = [
        10000 => 30,   // 30%
        20000 => 20,   // 20%
        50000 => 10,   // 10%
        100000 => 5,   // 5%
        200000 => 0,   // 1%    
        0 => 35,       // 34% (No prize)
    ];

    public function spin()
    {
        $user = Auth::user();

        // Check if user has spins available
        if ($user->lucky_wheel_spins <= 0) {
            session()->flash('error', 'Bạn đã hết lượt quay. Mua hàng từ 300,000đ để nhận thêm lượt quay!');
            return;
        }

        // Create weighted array for random selection
        $weightedPrizes = [];
        foreach ($this->prizes as $amount => $weight) {
            $weightedPrizes = array_merge(
                $weightedPrizes,
                array_fill(0, $weight, $amount)
            );
        }

        // Select random prize
        $this->prizeAmount = $weightedPrizes[array_rand($weightedPrizes)];
        $this->prizeLabel = $this->prizeAmount > 0
            ? 'Phần thưởng ' . number_format($this->prizeAmount) . 'đ'
            : 'Chúc bạn may mắn lần sau';

        try {
            DB::beginTransaction();

            // Decrement spin count
            $user->decrement('lucky_wheel_spins');

            // Add prize to wallet if won
            if ($this->prizeAmount > 0) {
                $user->wallet->deposit($this->prizeAmount);
            }

            // Record history
            LuckyWheelHistory::create([
                'user_id' => $user->id,
                'prize_amount' => $this->prizeAmount,
                'prize_label' => $this->prizeLabel,
            ]);

            DB::commit();


            // Do not show result immediately, wait for animation
            // $this->showResult = true; 
            $this->spinning = true;

            // Dispatch browser event for animation
            $this->dispatch('spin-wheel', [
                'prizeAmount' => $this->prizeAmount
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lucky wheel spin error: ' . $e->getMessage());
            session()->flash('error', 'Đã có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function resetResult()
    {
        $this->showResult = false;
        $this->spinning = false;
        $this->prizeAmount = null;
        $this->prizeLabel = '';
    }

    public function getSpinsLeftProperty()
    {
        return Auth::user()->lucky_wheel_spins;
    }

    public function getWalletBalanceProperty()
    {
        return Auth::user()->wallet->balance;
    }

    public function render()
    {
        return view('livewire.lucky-wheel-page');
    }
}
