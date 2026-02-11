<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'security_question_id')) {
                $table->unsignedTinyInteger('security_question_id')->nullable()->after('password2');
            }
            if (!Schema::hasColumn('users', 'security_answer')) {
                $table->text('security_answer')->nullable()->after('security_question_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'security_question_id')) {
                $table->dropColumn('security_question_id');
            }
            if (Schema::hasColumn('users', 'security_answer')) {
                $table->dropColumn('security_answer');
            }
        });
    }
};
