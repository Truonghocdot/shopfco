<?php

namespace App\Filament\Pages;

use App\Common\Constants\Language;
use App\Services\AuthService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Throwable;

class Login extends BaseLogin
{
    protected AuthService $authService;

    public function boot()
    {
        $this->authService = app(AuthService::class);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('email')
                ->label('Email')
                ->string()
                ->required()
                ->autocomplete('email')
                ->extraInputAttributes(['tabindex' => 1])
                ->validationMessages([
                    'required' => 'Không được để trống',
                ]),
            TextInput::make('password')
                ->label('Mật khẩu')
                ->password()
                ->revealable()
                ->autocomplete('current-password')
                ->required()
                ->extraInputAttributes(['tabindex' => 2])
                ->validationMessages([
                    'required' => 'Không được để trống',
                ]),
        ]);
    }


    /**
     * @throws ValidationException
     */
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::auth/pages/login.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => $exception->minutesUntilAvailable,
                ]))
                ->body(array_key_exists('body', __('filament-panels::auth/pages/login.notifications.throttled') ?: []) ? __('filament-panels::auth/pages/login.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => $exception->minutesUntilAvailable,
                ]) : null)
                ->danger()
                ->send();
        }
        $data = $this->form->getState();


        $credentials = [
            'email'          => $data['email'],
            'password'          => $data['password'],
        ];

        $result = $this->authService->handleLoginUser($credentials);

        if ($result->isSuccess()) {
            return app(LoginResponse::class);
        }
        throw $result->getException();
    }

    public function getView(): string
    {
        return 'filament.pages.login';
    }
}
