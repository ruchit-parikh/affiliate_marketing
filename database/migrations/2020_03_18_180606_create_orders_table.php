<?php

use App\Order;
use App\Package;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('set null');
            $table->string('package_name');
            $table->float('amount');
            $table->integer('allowed_children')->default(Package::$allowed_default_children);
            $table->string('order_type');
            $table->string('payment_type')->default(Order::$payment_type['paypal']['slug']);
            $table->tinyInteger('status')->default(Order::$status['pending']['code'])->comment('Discarded: 0, Completed: 1, Pending: 2');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
