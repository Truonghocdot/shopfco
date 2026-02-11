<?php

namespace App\Services;

use App\Models\User;
use App\Types\ServiceResult;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct(protected User $user) {}

    /**
     * Update user profile
     */
    public function updateProfile(int $userId, array $data): ServiceResult
    {
        try {
            $user = $this->user::find($userId);

            if (!$user) {
                return ServiceResult::error('Người dùng không tồn tại');
            }

            $updateData = [];

            // Update email if provided
            if (isset($data['email'])) {
                $updateData['email'] = $data['email'];
            }

            // Update phone if provided
            if (isset($data['phone'])) {
                $updateData['phone'] = $data['phone'];
            }

            // Update password if provided
            if (!empty($data['new_password'])) {
                $updateData['password'] = Hash::make($data['new_password']);
            }

            $user->update($updateData);

            return ServiceResult::success($user, 'Cập nhật thông tin thành công');
        } catch (\Exception $e) {
            Log::error('UserService::updateProfile error: ' . $e->getMessage());
            return ServiceResult::error('Không thể cập nhật thông tin', null, $e);
        }
    }

    /**
     * Change password
     */
    public function changePassword(int $userId, string $currentPassword, string $newPassword): ServiceResult
    {
        try {
            $user = $this->user::find($userId);

            if (!$user) {
                return ServiceResult::error('Người dùng không tồn tại');
            }

            if (!Hash::check($currentPassword, $user->password)) {
                return ServiceResult::error('Mật khẩu hiện tại không đúng');
            }

            $user->update(['password' => Hash::make($newPassword)]);

            return ServiceResult::success($user, 'Đổi mật khẩu thành công');
        } catch (\Exception $e) {
            Log::error('UserService::changePassword error: ' . $e->getMessage());
            return ServiceResult::error('Không thể đổi mật khẩu', null, $e);
        }
    }

    /**
     * Set transaction PIN (password2)
     */
    public function setTransactionPin(int $userId, string $pin, ?string $securityAnswer = null): ServiceResult
    {
        try {
            $user = $this->user::find($userId);

            if (!$user) {
                return ServiceResult::error('Người dùng không tồn tại');
            }

            if (!empty($user->password2)) {
                if (empty($securityAnswer)) {
                    return ServiceResult::error('Vui lòng trả lời câu hỏi bảo mật để thay đổi mật khẩu cấp 2');
                }

                $verifyResult = $this->verifySecurityAnswer($userId, $securityAnswer);
                if ($verifyResult->isError()) {
                    return $verifyResult;
                }
            }

            $user->forceFill(['password2' => $pin])->save();

            return ServiceResult::success($user, 'Thiết lập mã PIN thành công');
        } catch (\Exception $e) {
            Log::error('UserService::setTransactionPin error: ' . $e->getMessage());
            return ServiceResult::error('Không thể thiết lập mã PIN', null, $e);
        }
    }

    /**
     * Verify transaction PIN
     */
    public function verifyTransactionPin(int $userId, string $pin): ServiceResult
    {
        try {
            $user = $this->user::find($userId);

            if (!$user) {
                return ServiceResult::error('Người dùng không tồn tại');
            }

            if (!$user->password2) {
                return ServiceResult::error('Bạn chưa thiết lập mật khẩu cấp 2');
            }

            if ($user->password2 !== $pin) {
                return ServiceResult::error('Mật khẩu cấp 2 không đúng');
            }

            return ServiceResult::success(null, 'Xác thực thành công');
        } catch (\Exception $e) {
            Log::error('UserService::verifyTransactionPin error: ' . $e->getMessage());
            return ServiceResult::error('Không thể xác thực mã PIN', null, $e);
        }
    }

    /**
     * Set security question answer
     */
    public function setSecurityAnswer(int $userId, int $questionId, string $answer): ServiceResult
    {
        try {
            $user = $this->user::find($userId);

            if (!$user) {
                return ServiceResult::error('Người dùng không tồn tại');
            }

            $user->update([
                'security_question_id' => $questionId,
                'security_answer' => mb_strtolower(trim($answer)),
            ]);

            return ServiceResult::success($user, 'Thiết lập câu hỏi bảo mật thành công');
        } catch (\Exception $e) {
            Log::error('UserService::setSecurityAnswer error: ' . $e->getMessage());
            return ServiceResult::error('Không thể thiết lập câu hỏi bảo mật', null, $e);
        }
    }

    /**
     * Verify security answer with 80% fuzzy matching
     */
    public function verifySecurityAnswer(int $userId, string $answer): ServiceResult
    {
        try {
            $user = $this->user::find($userId);

            if (!$user) {
                return ServiceResult::error('Người dùng không tồn tại');
            }

            if (!$user->hasSecurityQuestion()) {
                return ServiceResult::error('Bạn chưa thiết lập câu hỏi bảo mật');
            }

            $storedAnswer = mb_strtolower(trim($user->security_answer));
            $inputAnswer = mb_strtolower(trim($answer));

            // Use similar_text for fuzzy matching (≥80% similarity)
            similar_text($storedAnswer, $inputAnswer, $percent);

            if ($percent < 80) {
                return ServiceResult::error('Câu trả lời bảo mật không đúng');
            }

            return ServiceResult::success(null, 'Xác thực câu hỏi bảo mật thành công');
        } catch (\Exception $e) {
            Log::error('UserService::verifySecurityAnswer error: ' . $e->getMessage());
            return ServiceResult::error('Không thể xác thực câu hỏi bảo mật', null, $e);
        }
    }
}
