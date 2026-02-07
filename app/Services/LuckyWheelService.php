<?php

namespace App\Services;

use App\Models\LuckyWheelHistory;
use App\Models\User;
use App\Types\ServiceResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LuckyWheelService
{
    protected array $prizes = [
        10000 => 41,   // 41%
        20000 => 30,   // 30%
        50000 => 7,   // 7%
        100000 => 2,   // 2%
        200000 => 0,   // 0%    
        0 => 20,       // 20% (No prize)
    ];

    public function __construct(
        protected LuckyWheelHistory $luckyWheelHistory,
        protected WalletService $walletService
    ) {}

    /**
     * Spin the lucky wheel
     */
    public function spin(int $userId): ServiceResult
    {
        try {
            DB::beginTransaction();

            $user = User::find($userId);

            if (!$user) {
                DB::rollBack();
                return ServiceResult::error('Người dùng không tồn tại');
            }

            // Check if user has spins available
            if ($user->lucky_wheel_spins <= 0) {
                DB::rollBack();
                return ServiceResult::error('Bạn đã hết lượt quay. Mua hàng từ 300,000đ để nhận thêm lượt quay!');
            }

            // Calculate prize
            $prizeAmount = $this->calculatePrize();
            $prizeLabel = $prizeAmount > 0
                ? 'Phần thưởng ' . number_format($prizeAmount) . 'đ'
                : 'Chúc bạn may mắn lần sau';

            // Decrement spin count
            $user->decrement('lucky_wheel_spins');

            // Add prize to wallet if won
            if ($prizeAmount > 0) {
                $depositResult = $this->walletService->deposit($userId, $prizeAmount);
                if ($depositResult->isError()) {
                    DB::rollBack();
                    return $depositResult;
                }
            }

            // Record history
            $this->luckyWheelHistory::create([
                'user_id' => $userId,
                'prize_amount' => $prizeAmount,
                'prize_label' => $prizeLabel,
            ]);

            DB::commit();

            return ServiceResult::success([
                'prize_amount' => $prizeAmount,
                'prize_label' => $prizeLabel,
                'spins_left' => $user->lucky_wheel_spins - 1
            ], 'Quay thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('LuckyWheelService::spin error: ' . $e->getMessage());
            return ServiceResult::error('Đã có lỗi xảy ra, vui lòng thử lại', null, $e);
        }
    }

    /**
     * Calculate prize based on probability
     */
    protected function calculatePrize(): int
    {
        // Create weighted array for random selection
        $weightedPrizes = [];
        foreach ($this->prizes as $amount => $weight) {
            $weightedPrizes = array_merge(
                $weightedPrizes,
                array_fill(0, $weight, $amount)
            );
        }

        // Select random prize
        return $weightedPrizes[array_rand($weightedPrizes)];
    }

    /**
     * Get user's remaining spins
     */
    public function getSpinsLeft(int $userId): ServiceResult
    {
        try {
            $user = User::find($userId);

            if (!$user) {
                return ServiceResult::error('Người dùng không tồn tại');
            }

            return ServiceResult::success(['spins_left' => $user->lucky_wheel_spins]);
        } catch (\Exception $e) {
            Log::error('LuckyWheelService::getSpinsLeft error: ' . $e->getMessage());
            return ServiceResult::error('Không thể lấy số lượt quay', null, $e);
        }
    }
}
