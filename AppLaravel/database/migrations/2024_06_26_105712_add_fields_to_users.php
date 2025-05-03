<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //             $table->integer('amount')->after('email');
// $table->string('plan_type')->after('amount');
// // $table->string('status')->after('plan_type');
// $table->enum('status',['pending','paid','reject','expired'])->after('plan_type');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['amount', 'plan_type', 'status']);
        });
    }
};
