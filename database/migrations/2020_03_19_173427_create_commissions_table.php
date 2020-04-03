<?php

use App\Commission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique();
            $table->float('percentage_amount');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->string('level');
            $table->tinyInteger('status')->default(Commission::$status['active']['code'])->comment('0: Inactive, 1: Active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_commission', function(Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->unsignedBigInteger('commission_id')->nullable();
            $table->foreign('commission_id')->references('id')->on('commissions')->onDelete('set null');
            $table->float('flat_amount');
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
        Schema::dropIfExists('user_commission');
        Schema::dropIfExists('commissions');
    }
}
