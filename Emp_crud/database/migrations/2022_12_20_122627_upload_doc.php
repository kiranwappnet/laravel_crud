<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UploadDoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('upload_doc', function (Blueprint $table) {
            $table->id('up_id');
            $table->foreignId("emp_id")->constrained("employees")->onDelete('cascade');
            $table->string('docno');
            $table->string('docname');
            $table->string('upload_file');
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
        Schema::dropIfExists('upload_doc');
    }
}
