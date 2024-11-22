<?php

use App\Enums\Insurance\Claim\ClaimStatusEnum;
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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnUpdate();

            $table->foreignId('policy_id')
                ->constrained('policies')
                ->cascadeOnUpdate();

            $table->string('claim_type');
            $table->text('description');
            $table->enum('claim_status', ClaimStatusEnum::values());
            $table->string('claim_payment')->nullable();
            $table->date('claim_report_date');
            $table->date('claim_resolution_date')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
