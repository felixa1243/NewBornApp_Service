<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("mothers", function ($table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->date("birth_day");
            // auto-generated columnes
            $table->timestamp("created_at")->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->timestamp("updated_at")->default(DB::raw("CURRENT_TIMESTAMP"));
        });

        Schema::create("infants", function ($table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->enum("gender", ["male", "female"]);
            $table->datetime("birth_day");
            $table->date("gestational_begin");
            $table->uuid("mother_id");
            $table->integer("height");
            $table->integer("weight");
            $table->string("description")->nullable();
            $table->foreign("mother_id")->references("id")->on("mothers");
            // auto-generated columns
            $table->timestamp("created_at")->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->timestamp("updated_at")->default(DB::raw("CURRENT_TIMESTAMP"));
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
