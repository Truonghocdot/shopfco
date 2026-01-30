<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Tên')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Số điện thoại')
                    ->tel(),
                Textarea::make('password')
                    ->label('Mật khẩu')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('role')
                    ->label('Vai trò')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('status')
                    ->label('Trạng thái')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
