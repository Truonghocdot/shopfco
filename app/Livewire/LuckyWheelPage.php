<?php

namespace App\Livewire;

use App\Services\LuckyWheelService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Cây Hái Lộc - Nhận Quà May Mắn')]
class LuckyWheelPage extends Component
{
    public $prizeAmount = null;
    public $prizeLabel = '';
    public $showResult = false;
    public $spinning = false;

    protected $luckyWheelService;

    public function boot(LuckyWheelService $luckyWheelService)
    {
        $this->luckyWheelService = $luckyWheelService;
    }

    public function spin()
    {
        $result = $this->luckyWheelService->spin(Auth::id());

        if ($result->isError()) {
            session()->flash('error', $result->getMessage());
            return;
        }

        $data = $result->getData();
        $this->prizeAmount = $data['prize_amount'];
        $this->prizeLabel = $data['prize_label'];
        $this->spinning = true;

        // Dispatch browser event for animation
        $this->dispatch('shake-tree', [
            'prizeAmount' => $this->prizeAmount
        ]);
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
