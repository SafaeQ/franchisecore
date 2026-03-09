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
            $table->foreignId('store_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->after('store_id')->constrained()->nullOnDelete();
            $table->string('first_name')->nullable()->after('brand_id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('role')->nullable()->after('email');
            $table->string('user_code')->nullable()->unique()->after('role');
            $table->boolean('is_active')->default(true)->after('user_code');
            $table->date('hired_at')->nullable()->after('is_active');
            $table->date('terminated_at')->nullable()->after('hired_at');
            $table->string('termination_reason')->nullable()->after('terminated_at');
            $table->boolean('is_work_stoppage')->default(false)->after('termination_reason');
            $table->date('work_stoppage_start_date')->nullable()->after('is_work_stoppage');
            $table->date('work_stoppage_end_date')->nullable()->after('work_stoppage_start_date');
            $table->date('birth_date')->nullable()->after('work_stoppage_end_date');
            $table->string('locale')->default('fr')->after('birth_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->dropForeign(['brand_id']);

            $table->dropColumn([
                'store_id',
                'brand_id',
                'first_name',
                'last_name',
                'role',
                'user_code',
                'is_active',
                'hired_at',
                'terminated_at',
                'termination_reason',
                'is_work_stoppage',
                'work_stoppage_start_date',
                'work_stoppage_end_date',
                'birth_date',
                'locale',
            ]);
        });
    }
};
