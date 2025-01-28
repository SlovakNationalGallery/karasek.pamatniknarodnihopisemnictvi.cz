<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RenameAboutArticleSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('articles')
            ->where('slug', 'o-vystave')
            ->update(['slug' => 'o-projektu']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('articles')
            ->where('slug', 'o-projektu')
            ->update(['slug' => 'o-vystave']);
    }
}
