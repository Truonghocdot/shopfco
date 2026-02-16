<?php

namespace App\Console\Commands;

use App\Constants\UserRole;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddBonusCredit extends Command
{
    protected $signature = 'bonus:add-credit';

    protected $description = 'Cộng tiền thưởng cho tất cả khách hàng (9.999đ), top 5 chi tiêu cao nhất (99.999đ). Ghi nhận vào coupon_usage.';

    const BONUS_AMOUNT = 9999;
    const TOP_SPENDER_BONUS_AMOUNT = 99999;
    const TOP_SPENDER_COUNT = 5;

    public function handle(): int
    {
        $this->info('🎁 Bắt đầu cộng tiền thưởng cho khách hàng...');
        $this->newLine();

        // 1. Xác định top 5 chi tiêu cao nhất
        $topSpenderIds = Order::where('status', Order::STATUS_COMPLETED)
            ->select('user_id', DB::raw('SUM(final_amount) as total_spent'))
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->limit(self::TOP_SPENDER_COUNT)
            ->pluck('total_spent', 'user_id');

        if ($topSpenderIds->isNotEmpty()) {
            $this->info('🏆 Top ' . self::TOP_SPENDER_COUNT . ' khách hàng chi tiêu cao nhất:');
            $topTable = [];
            foreach ($topSpenderIds as $userId => $totalSpent) {
                $user = User::find($userId);
                $topTable[] = [
                    $userId,
                    $user ? $user->name : 'N/A',
                    number_format($totalSpent, 0, ',', '.') . 'đ',
                    number_format(self::TOP_SPENDER_BONUS_AMOUNT, 0, ',', '.') . 'đ',
                ];
            }
            $this->table(['ID', 'Tên', 'Tổng chi tiêu', 'Thưởng'], $topTable);
            $this->newLine();
        }

        // 2. Lấy tất cả khách hàng active
        $customers = User::where('role', UserRole::CLIENT->value)
            ->where('status', 1)
            ->get();

        if ($customers->isEmpty()) {
            $this->warn('Không có khách hàng nào để cộng tiền.');
            return self::SUCCESS;
        }

        // 3. Tạo system coupon cho lần bonus này
        $bonusDate = now()->format('Y-m-d');
        $couponCode = 'BONUS_' . $bonusDate;

        $systemCoupon = Coupon::firstOrCreate(
            ['code' => $couponCode],
            [
                'description' => 'Thưởng khách hàng ngày ' . $bonusDate,
                'discount_type' => 2, // fixed_amount
                'discount_value' => 0,
                'max_discount' => null,
                'min_order_amount' => 0,
                'usage_limit' => null,
                'usage_count' => 0,
                'usage_per_user' => 999999,
                'start_date' => now(),
                'end_date' => now()->addDay(),
                'status' => 0, // inactive - không cho dùng trực tiếp
            ]
        );

        $this->info("📋 System coupon: {$couponCode} (ID: {$systemCoupon->id})");
        $this->newLine();

        // 4. Cộng tiền cho từng khách hàng trong DB transaction
        $totalBonusGiven = 0;
        $processedCount = 0;
        $errorCount = 0;

        $bar = $this->output->createProgressBar($customers->count());
        $bar->start();

        foreach ($customers as $customer) {
            try {
                DB::transaction(function () use ($customer, $topSpenderIds, $systemCoupon, &$totalBonusGiven, &$processedCount) {
                    $isTopSpender = $topSpenderIds->has($customer->id);
                    $bonusAmount = $isTopSpender ? self::TOP_SPENDER_BONUS_AMOUNT : self::BONUS_AMOUNT;

                    // Đảm bảo khách hàng có ví
                    $wallet = Wallet::firstOrCreate(
                        ['user_id' => $customer->id],
                        ['balance' => 0]
                    );

                    // Cộng tiền vào ví
                    $wallet->addBalance($bonusAmount);

                    // Ghi nhận vào coupon_usage
                    CouponUsage::insert([
                        'coupon_id' => $systemCoupon->id,
                        'user_id' => $customer->id,
                        'transaction_id' => null,
                        'discount_amount' => $bonusAmount,
                        'used_at' => now(),
                    ]);

                    // Cập nhật usage_count của coupon
                    $systemCoupon->increment('usage_count');

                    $totalBonusGiven += $bonusAmount;
                    $processedCount++;
                });
            } catch (\Exception $e) {
                $errorCount++;
                Log::error("AddBonusCredit: Lỗi cộng tiền cho user #{$customer->id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // 5. Tổng kết
        $this->info('✅ Hoàn tất cộng tiền thưởng!');
        $this->table(
            ['Thông tin', 'Giá trị'],
            [
                ['Tổng khách hàng xử lý', $processedCount],
                ['Trong đó top 5', min($topSpenderIds->count(), $processedCount)],
                ['Lỗi', $errorCount],
                ['Tổng tiền đã cộng', number_format($totalBonusGiven, 0, ',', '.') . 'đ'],
                ['System coupon', $couponCode],
            ]
        );

        return self::SUCCESS;
    }
}
