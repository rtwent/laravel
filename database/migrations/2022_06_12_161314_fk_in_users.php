<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Извините долго не пользовался BluePrint
 * Поэтому миграции пишу в сыром виде
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE "personal_access_tokens"
ADD FOREIGN KEY ("tokenable_id") REFERENCES "public"."users" ("id") ON DELETE CASCADE ON UPDATE CASCADE;');
        \Illuminate\Support\Facades\DB::statement('CREATE UNIQUE INDEX  ON "users" ("email");');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
