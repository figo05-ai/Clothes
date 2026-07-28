<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('support_ticket_id')->constrained('support_tickets')->cascadeOnDelete();
            $table->foreignUlid('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('message');
            $table->boolean('is_admin_reply')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ticket_replies'); }
};
