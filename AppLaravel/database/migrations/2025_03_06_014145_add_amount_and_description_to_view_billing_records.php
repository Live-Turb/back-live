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
        Schema::table('view_billing_records', function (Blueprint $table) {
            if (!Schema::hasColumn('view_billing_records', 'amount')) {
                $table->decimal('amount', 10, 2)->default(0)->after('extra_views_cost');
            }
            
            if (!Schema::hasColumn('view_billing_records', 'description')) {
                $table->string('description')->nullable()->after('notes');
            }
            
            if (!Schema::hasColumn('view_billing_records', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('view_billing_records', function (Blueprint $table) {
            $table->dropColumn(['amount', 'description', 'paid_at']);
        });
    }
};
