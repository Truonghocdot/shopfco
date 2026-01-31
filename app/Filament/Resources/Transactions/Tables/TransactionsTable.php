<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("user.name")
                    ->label("Người mua"),
                TextColumn::make("total_amount")
                    ->label("Tổng tiền"),
                TextColumn::make("status")
                    ->formatStateUsing(fn($state) => $state->label())
                    ->label("Trạng thái"),
                TextColumn::make("created_at")
                    ->label("Ngày tạo"),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
