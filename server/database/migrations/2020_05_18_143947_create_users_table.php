
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('username');
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_lab')->default(0);
            $table->boolean('is_pharm')->default(0);
            $table->boolean('is_reserve')->default(0);
            $table->boolean('is_active')->default(1);
            $table->text('api_token')->nullable();
            $table->integer('managed_by');
            $table->string('gender');
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
        Schema::dropIfExists('users');
    }
}
