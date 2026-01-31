<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Danh mục')
                    ->relationship('category', 'title')
                    ->required()
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ])
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', str($state)->slug());
                    }),
                FileUpload::make('images')
                    ->label('Hình ảnh')
                    ->multiple()
                    ->image()
                    ->disk('public')
                    ->required()
                    ->panelLayout('grid')
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ]),
                TextInput::make('title')
                    ->label('Tiêu đề')
                    ->required()
                    ->maxLength(255)
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                        'max_length' => 'Trường này không được vượt quá :max ký tự',
                    ])
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', str($state)->slug());
                    }),
                TextInput::make('slug')
                    ->label('Đường dẫn')
                    ->required()
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ]),
                TextInput::make('phone')
                    ->label('Số điện thoại')
                    ->required()
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ]),
                TextInput::make('password')
                    ->label('Mật khẩu')
                    ->required()
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ]),
                RichEditor::make('content')
                    ->label('Nội dung')
                    ->required()
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ]),
                TextInput::make('sell_price')
                    ->label('Giá bán')
                    ->required()
                    ->maxLength(255)
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                        'max_length' => 'Trường này không được vượt quá :max ký tự',
                    ]),
                TextInput::make('sale_price')
                    ->label('Giá sau giảm giá')
                    ->required()
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ]),
                TextInput::make('meta_title')
                    ->label('Meta title')
                    ->required()
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ]),
                TextInput::make('meta_description')
                    ->label('Meta description')
                    ->required()
                    ->validationMessages([
                        'required' => 'Trường này không được để trống',
                    ]),
            ]);
    }
}
