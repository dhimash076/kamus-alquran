<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Re-create the categories table
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        // Re-add category_id to vocabularies if it was dropped
        if (!Schema::hasColumn('vocabularies', 'category_id')) {
            Schema::table('vocabularies', function (Blueprint $table) {
                $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade')->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('vocabularies', 'category_id')) {
            Schema::table('vocabularies', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }

        Schema::dropIfExists('categories');
    }
};
