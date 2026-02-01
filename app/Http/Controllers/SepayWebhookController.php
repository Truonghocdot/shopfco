<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SepayWebhookController extends Controller
{
    /**
     * Handle Sepay webhook
     */
    public function handle(Request $request)
    {
        try {
            // Log webhook request for debugging
            Log::info('Sepay Webhook Received', $request->all());

            // Validate required fields
            if (!$request->has(['transferAmount', 'content', 'referenceCode'])) {
                Log::error('Sepay Webhook: Missing required fields');
                return response()->json(['error' => 'Missing required fields'], 400);
            }

            $amount = $request->input('transferAmount');
            $content = $request->input('content');
            $transactionId = $request->input('referenceCode');

            // Extract user ID from content
            // Expected format: "vanhfco 123" or "VANHFCO 123"
            if (!preg_match('/vanhfco\s+(\d+)/i', $content, $matches)) {
                Log::warning('Sepay Webhook: Invalid content format', ['content' => $content]);
                return response()->json(['error' => 'Invalid content format'], 400);
            }

            $userId = (int) $matches[1];

            // Check if transaction already processed
            $existingTransaction = Transaction::where('request_id', $transactionId)->first();
            if ($existingTransaction) {
                Log::info('Sepay Webhook: Transaction already processed', ['transaction_id' => $transactionId]);
                return response()->json(['message' => 'Transaction already processed'], 200);
            }

            // Get user wallet or create if not exists
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $userId],
                ['balance' => 0]
            );

            // Process transaction
            DB::transaction(function () use ($wallet, $amount, $transactionId, $request) {
                // Create transaction record
                Transaction::create([
                    'user_id' => $wallet->user_id,
                    'service_type' => 0, // topup
                    'amount' => $amount,
                    'status' => 1, // success
                    'request_id' => $transactionId,
                    'provider' => 'sepay',
                ]);

                // Update wallet balance
                $wallet->increment('balance', $amount);

                Log::info('Sepay Webhook: Transaction processed successfully', [
                    'user_id' => $wallet->user_id,
                    'amount' => $amount,
                    'new_balance' => $wallet->balance,
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Transaction processed successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Sepay Webhook Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => 'Internal server error'
            ], 500);
        }
    }
}
