<?php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('username')->unique()->after('id');
        $table->string('verification_token')->nullable()->unique();
        $table->date('dob')->nullable();
        $table->json('languages')->nullable();
        $table->string('country')->nullable();
        $table->string('state')->nullable();
        $table->string('city')->nullable();
    });
}
?>