<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{   
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('slug')
                    ->label('Đường dẫn')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('category.title')
                    ->label('Danh mục')
                    ->searchable(),
                TextColumn::make('sell_price')
                    ->label('Giá bán')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('sale_price')
                    ->label('Giá sau giảm giá')
                    ->searchable()
                    ->limit(50),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
        ;
    }
}
