
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baggage_items', function (Blueprint $table) {
          
            $table->id();

           
            $table->foreignId('passenger_id')
                ->constrained('passengers')
                ->onDelete('restrict');

        
            $table->foreignId('flight_id')
                ->constrained('flights')
                ->onDelete('restrict');

          
            $table->string('bag_tag_number', 50)->unique();
            $table->decimal('bag_weight_kg', 8, 2);

          
            $table->boolean('heavy_cargo')->default(false);

            $table->timestamps();

            $table->index('bag_weight_kg');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baggage_items');
    }
};
