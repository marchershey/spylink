<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lid');

            $table->string('ip');
            $table->string('ip_type');
            $table->string('country_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('region_code')->nullable();
            $table->string('region_name')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('browser')->nullable();
            $table->String('browser_version')->nullable();
            $table->string('platform')->nullable();
            $table->string('referrer')->nullable();
            $table->string('visited_at')->nullable();
            $table->timestamps();

            /*
             * https://ipstack.com/
             *
             */

            // ip:
            // type:
            // continent_code:
            // continent_name:
            // country_code:
            // country_name:
            // region_code:
            // region_name:
            // city:
            // zip:
            // latitude:
            // longitude:
            // location
            // geoname_id
            // capital
            // languages
            // code
            // name
            // native
            // country_flag
            // country_flag_emoji
            // country_flag_emoji_unicode
            // calling_code
            // is_eu
            // time_zone: Object{}
            //     id:
            //     current_time:
            //     gmt_offset:
            //     code:
            //     is_daylight_saving:
            // currency: Object{}
            //     code:
            //     name:
            //     plural:
            //     symbol:
            //     symbol_native:
            // connection: Object{}
            //     asn:
            //     isp:
            // security: Object{}
            //     is_proxy:
            //     proxy_type:
            //     is_crawler:
            //     crawler_name:
            //     crawler_type:
            //     is_tor:
            //     threat_level:
            //     threat_types:
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_visits');
    }
}
