<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionHistory extends Component
{
    use WithPagination;

    public $filterType = '';
    public $filterStatus = '';

    public function render()
    {
        $query = Transaction::where('user_id', Auth::id());

        if ($this->filterType !== '') {
            $query->where('service_type', $this->filterType);
        }

        if ($this->filterStatus !== '') {
            $query->where('status', $this->filterStatus);
        }

        $transactions = $query->latest()->paginate(10);

        return view('livewire.user.transaction-history', [
            'transactions' => $transactions
        ]);
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }
}
