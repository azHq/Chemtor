<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
            $table->unsignedBigInteger('paymenttype_id');
            $table->foreign('paymenttype_id')
                ->references('id')
                ->on('paymenttypes')
                ->onDelete('cascade');
                
            $table->decimal('payable_amount', 8, 2);
            $table->decimal('amount_payed', 8, 2);
            $table->decimal('due_amount', 8, 2)->default(0);
            $table->date('payment_date');
            $table->enum('payment_status', ['Paid', 'Unpaid', 'Partial'])->default('Paid');
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
        Schema::dropIfExists('payments');
    }
};
