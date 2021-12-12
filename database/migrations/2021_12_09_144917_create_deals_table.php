<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('startup_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('deal_name')->collation("utf8_general_ci");
            $table->longText('deal_description')->collation("utf8_general_ci");
            $table->string('deal_value')->collation("utf8_general_ci");
            $table->string('deal_logo');
            $table->boolean('status')->default(0)->comment('0 pending , 1 approval , 2 rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
