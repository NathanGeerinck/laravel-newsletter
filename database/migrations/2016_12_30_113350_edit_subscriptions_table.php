<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class EditSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function ($table) {
            $table->integer('mailing_list_id')->unsigned()->nullable();
            $table->foreign('mailing_list_id')->references('id')->on('mailing_lists')->onDelete('cascade');
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
//            $table->dropIndex(['mailing_list_id']);
            $table->dropForeign(['mailing_list_id']);
            $table->dropColumn(['mailing_list_id']);
        });
    }
}
