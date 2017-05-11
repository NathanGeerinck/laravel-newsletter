<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignMailingListPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_mailing_list', function (Blueprint $table) {
            $table->integer('campaign_id')->unsigned()->index();
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

            $table->integer('mailing_list_id')->unsigned()->index();
            $table->foreign('mailing_list_id')->references('id')->on('mailing_lists')->onDelete('cascade');

            $table->primary(['campaign_id', 'mailing_list_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function ($table) {
            $table->dropIndex('mailing_list_id');
            $table->dropIndex('campaign_id');
        });

        Schema::drop('campaign_mailing_list');
    }
}
