<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Constants\UserRole;
use Filament\Forms\Components\Select;
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
                TextInput::make('password')
                    ->label('Mật khẩu')
                    ->password()    
                    ->required()
                    ->columnSpanFull(),
                Select::make('role')
                    ->label('Vai trò')
                    ->required()
                    ->options(UserRole::getRoleOptions())
                    ->default(UserRole::CLIENT->value),
                Select::make('status')
                    ->label('Trạng thái')
                    ->required()
                    ->options(UserRole::getRoleOptions())
                    ->default(UserRole::CLIENT->value),
            ]);
    }
}
