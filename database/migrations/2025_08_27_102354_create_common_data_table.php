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
        Schema::create('common_data', function (Blueprint $table) {
            $table->id(); // Id INT IDENTITY(1,1) PRIMARY KEY
            $table->integer('pid')->nullable();
            $table->char('type', 5); // CHAR(3) NOT NULL
            $table->string('name', 128); // NVARCHAR(128) NOT NULL
            $table->string('description', 256)->nullable(); // NVARCHAR(256) NULL
            $table->string('is_active'); // BIT NOT NULL
            $table->integer('int_value')->nullable(); // INT NULL
            $table->text('string_value')->nullable(); // NVARCHAR(MAX) NULL
            $table->decimal('latitude', 18, 7)->nullable(); // DECIMAL(18,7) NULL
            $table->decimal('longitude', 18, 7)->nullable(); // DECIMAL(18,7) NULL

            $table->unsignedBigInteger('parent_id')->nullable(); // INT NULL
                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_data');
    }
};
