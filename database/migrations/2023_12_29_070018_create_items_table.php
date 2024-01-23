<?php

use App\Models\Technology;
use App\Models\Type;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('image',50)->nullable();
            $table->string('name',50)->nullable();
            $table->string('description');
            $table->integer('price');
            $table->foreignIdFor(Type::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->smallInteger('capacity')->nullable();
            $table->smallInteger('voltage')->nullable();
            $table->foreignIdFor(Technology::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger('plates')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
