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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name', 100);
            $table->text('project_description')->nullable();
            $table->string("project_image", 100)->nullable();
            $table->string("invite_code", 4)->unique();
            $table->foreignId("author")->constrained("users");
            $table->enum("status",["Selesai","Dalam Progress"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
