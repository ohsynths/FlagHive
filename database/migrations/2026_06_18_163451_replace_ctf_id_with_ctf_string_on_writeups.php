<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('writeups', function (Blueprint $table) {
            $table->dropForeign(['ctf_id']);
            $table->dropColumn('ctf_id');
            $table->string('ctf')->after('category_id');
        });
    }

    public function down(): void
    {
        Schema::table('writeups', function (Blueprint $table) {
            $table->dropColumn('ctf');
            $table->foreignId('ctf_id')->constrained()->cascadeOnDelete();
        });
    }
};
