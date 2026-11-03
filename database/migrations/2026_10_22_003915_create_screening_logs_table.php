
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('screening_logs', function (Blueprint $table) {
     
            $table->id();

            
            $table->foreignId('baggage_item_id')
                ->constrained('baggage_items')
                ->onDelete('restrict');

        
            $table->foreignId('screening_gate_id')
                ->constrained('screening_gates')
                ->onDelete('restrict');

           
            $table->string('screener_officer', 150);

            
            $table->string('screening_result', 20);

           
            $table->text('flagged_reason')->nullable();

       
            $table->string('clearance_status', 30)
                ->default('Pending');

         
            $table->timestamps();

          
            $table->index('screening_result');
            $table->index('clearance_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('screening_logs');
    }
};
