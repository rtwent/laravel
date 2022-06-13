<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement(
            'CREATE SEQUENCE profiles_id_seq START 1;'
        );

        \Illuminate\Support\Facades\DB::statement(
            'CREATE TABLE "profiles" (
"id" int4 NOT NULL DEFAULT nextval(\'profiles_id_seq\'),
"user_id" int4 NOT NULL,
"lang" varchar(3) DEFAULT \'UA\' NOT NULL,
"timezone" text NOT NULL CHECK (now() AT TIME ZONE timezone IS NOT NULL),
PRIMARY KEY ("id"),
FOREIGN KEY ("user_id") REFERENCES "users" ("id") ON DELETE CASCADE ON UPDATE CASCADE
)
WITH (OIDS=FALSE)
;'
        );

        \Illuminate\Support\Facades\DB::statement(
            'CREATE UNIQUE INDEX  ON "profiles" ("user_id");'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
