<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Tiêu đề')
                    ->required()
                    ->maxLength(255)
                    ->validationMessages([
                        'required' => 'Tiêu đề không được để trống',
                        'max_length' => 'Tiêu đề không được vượt quá 255 ký tự',
                    ])
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', str($state)->slug());
                    }),
                TextInput::make('slug')
                    ->label('Đường dẫn')
                    ->required()
                    ->maxLength(255)
                    ->validationMessages([
                        'required' => 'Đường dẫn không được để trống',
                        'max_length' => 'Đường dẫn không được vượt quá 255 ký tự',
                    ])
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', str($state)->slug());
                    }),
                Textarea::make('description')
                    ->label('Mô tả')
                    ->required()
                    ->validationMessages([
                        'required' => 'Mô tả không được để trống',
                        'max_length' => 'Mô tả không được vượt quá 255 ký tự',
                    ]),
                FileUpload::make('image')
                    ->required()
                    ->label('Hình ảnh')
                    ->disk('public')
                    ->directory('categories')
                    ->validationMessages([
                        'required' => 'Hình ảnh không được để trống',
                    ]),
                TextInput::make('meta_title')
                    ->label('Tiêu đề SEO')
                    ->required()
                    ->maxLength(255),
                TextInput::make('meta_description')
                    ->label('Mô tả SEO')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
