<?php
public function up(): void
{
    Schema::create('password_resets', function (Blueprint $table) {
        $table->id();
        $table->string('email');
        $table->string('otp');
        $table->timestamp('expires_at');
        $table->timestamps();
    });
}
?>