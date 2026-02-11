<?php

namespace App\Livewire\Auth;

use App\Constants\QuestionAuthenticate;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetSecurityQuestion extends Component
{
    public $showModal = false;
    public $selectedQuestionId = '';
    public $answer = '';

    protected $userService;

    public function boot(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function mount()
    {
        $this->checkSecurityStatus();
    }

    public function checkSecurityStatus()
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Show modal if user has password2 set but no security question
            if (!empty($user->password2) && !$user->hasSecurityQuestion()) {
                $this->showModal = true;
            } else {
                $this->showModal = false;
            }
        }
    }

    public function getQuestions()
    {
        return QuestionAuthenticate::QUESTIONS;
    }

    public function saveAnswer()
    {
        $this->validate(
            [
                'selectedQuestionId' => ['required', 'integer', 'in:1,2,3'],
                'answer' => ['required', 'string', 'min:1', 'max:255'],
            ],
            [
                'selectedQuestionId.required' => 'Vui lòng chọn câu hỏi bảo mật',
                'selectedQuestionId.in' => 'Câu hỏi không hợp lệ',
                'answer.required' => 'Vui lòng nhập câu trả lời',
                'answer.min' => 'Câu trả lời quá ngắn',
                'answer.max' => 'Câu trả lời quá dài',
            ]
        );

        $result = $this->userService->setSecurityAnswer(
            Auth::id(),
            (int) $this->selectedQuestionId,
            $this->answer
        );

        if ($result->isError()) {
            session()->flash('error', $result->getMessage());
            return;
        }

        $this->showModal = false;
        $this->dispatch('security-question-set');
        $this->redirect(request()->header('Referer'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.set-security-question', [
            'questions' => $this->getQuestions(),
        ]);
    }
}
