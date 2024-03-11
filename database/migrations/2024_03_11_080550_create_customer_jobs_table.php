<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Occupation');
            $table->string('Position');
            $table->string('NatureOfBusiness');
            $table->string('CompanyName');
            $table->string('IncomePerAnnum');
            $table->string('FundSource');
            $table->string('NatureOfBusinessText');
            $table->string('PositionText');
            $table->string('NPWPReason');
            $table->string('NPWPNumber');
            $table->string('QuestionNPWP');
            $table->string('CompanyCity');
            $table->string('CompanyAddress');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_jobs');
    }
};
