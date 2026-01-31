<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $revenue = Transaction::where('status', 1)->sum('amount');
        $newUsers = User::where('role', 0)->whereMonth('created_at', now()->month)->count();
        $pendingTransactions = Transaction::where('status', 0)->count();
        $soldProducts = Product::where('status', 1)->count();

        return [
            Stat::make('Tổng doanh thu', Number::currency($revenue, 'VND'))
                ->description('Tổng tiền giao dịch thành công')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Người dùng mới (Tháng này)', $newUsers)
                ->description('Khách hàng mới đăng ký')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
            Stat::make('Giao dịch chờ', $pendingTransactions)
                ->description('Cần xử lý ngay')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color($pendingTransactions > 0 ? 'warning' : 'gray'),
            Stat::make('Sản phẩm đã bán', $soldProducts)
                ->description('Tổng số acc đã bán ra')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),
        ];
    }
}
