<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->uuid()->primary()->unique();
            $table->uuid('targetRecordId')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('model');
            $table->string('eventType');
            $table->json('recordBeforeOperation')->nullable();
            $table->json('recordAfterOperation')->nullable();
            $table->string('observations')->nullable();
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
            $table->timestamp('deletedAt')->nullable();

            $table->index(['uuid', 'targetRecordId', 'eventType']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
