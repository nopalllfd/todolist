<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFinishedTasksTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('finished_tasks');
    }

    public function down()
    {
        Schema::create('finished_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->text('description')->nullable();
            $table->string('priority');
            $table->date('due_date');
            $table->timestamps();
        });
    }
}