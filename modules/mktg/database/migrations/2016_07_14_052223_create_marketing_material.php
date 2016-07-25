<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // mktg_material
        Schema::create('mktg_material', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->nullable();
            $table->string('slug', 64)->unique();
            $table->string('icon', 255)->unique();
            $table->enum('status',array('open','close'))->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        // mktg_material
        Schema::create('mktg_artwork', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128)->nullable();
            $table->string('slug', 128)->unique();
            $table->float('price')->nullable();
            $table->enum('field_type',array('description','file'))->nullable();
            $table->enum('status',array('open','close'))->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        // mktg_material
        Schema::create('mktg_menu_item', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mktg_material_id')->nullable();
            $table->string('title', 64)->nullable();
            $table->string('slug', 64)->unique();
            $table->text('description')->nullable();
            $table->enum('status',array('open','close'))->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('mktg_menu_item', function($table) {
            /*if table  exists */
            if(Schema::hasTable('mktg_material'))
            {
                $table->foreign('mktg_material_id')->references('id')->on('mktg_material');
            }
        });

        // mktg_menu_item_img
        Schema::create('mktg_menu_item_img', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mktg_menu_item_id')->nullable();
            $table->string('image', 128)->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('mktg_menu_item_img', function($table) {
            /*if table  exists */
            if(Schema::hasTable('mktg_menu_item'))
            {
                $table->foreign('mktg_menu_item_id')->references('id')->on('mktg_menu_item');
            }
        });

        // item_option
        Schema::create('mktg_item_option', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mktg_menu_item_id')->nullable();
            $table->enum('type', array(
                'single', 'multiple'
            ))->nullable();

            $table->string('title', 64)->nullable();
            $table->string('slug', 64)->unique();
            $table->string('image', 128)->nullable();
            $table->string('image_thumb', 128)->nullable();
            $table->enum('status',array('open','close'))->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('mktg_item_option', function($table) {
            /*if table  exists */
            if(Schema::hasTable('mktg_menu_item'))
            {
                $table->foreign('mktg_menu_item_id')->references('id')->on('mktg_menu_item');
            }
        });

        // item_value
        Schema::create('mktg_item_value', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mktg_item_option_id')->nullable();
            $table->string('title', 64)->nullable();
            $table->string('slug', 64)->unique();
            $table->float('price')->nullable();
            $table->string('image', 128)->nullable();
            $table->enum('status',array('open','close'))->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('mktg_item_value', function($table) {
            /*if table  exists */
            if(Schema::hasTable('mktg_item_option'))
            {
                $table->foreign('mktg_item_option_id')->references('id')->on('mktg_item_option');
            }
        });

        // mktg_order
        Schema::create('mktg_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no', 16)->unique();
            $table->timestamp('date')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->float('amount')->nullable();
            $table->float('gst')->nullable();
            $table->float('total_amount')->nullable();

            $table->enum('status',array(
                'open', 'close', 'cancel', 'oder-confirmed', 'invoiced'
            ))->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('mktg_order', function($table) {
            /*if table  exists */
            if(Schema::hasTable('user'))
            {
                $table->foreign('user_id')->references('id')->on('user');
            }
        });

        // mktg_order_detail
        Schema::create('mktg_order_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('mktg_order_id')->nullable();
            $table->unsignedInteger('mktg_item_value_id')->nullable();

            $table->float('amount')->nullable();

            $table->unsignedInteger('mktg_artwork_id')->nullable();
            $table->text('artwork_comment')->nullable();
            $table->float('artwork_amount')->nullable();

            $table->float('total_amount')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('mktg_order_detail', function($table) {
            /*if table  exists */
            if(Schema::hasTable('mktg_order')){
                $table->foreign('mktg_order_id')->references('id')->on('mktg_order');
            }
            if(Schema::hasTable('mktg_item_value')){
                $table->foreign('mktg_item_value_id')->references('id')->on('mktg_item_value');
            }
            if(Schema::hasTable('mktg_artwork')){
                $table->foreign('mktg_artwork_id')->references('id')->on('mktg_artwork');
            }
        });

        // mktg_artwork_image
        Schema::create('mktg_artwork_image', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('mktg_order_detail_id')->nullable();
            $table->string('image', 128)->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('mktg_artwork_image', function($table) {
            /*if table  exists */
            if(Schema::hasTable('mktg_order_detail')){
                $table->foreign('mktg_order_detail_id')->references('id')->on('mktg_order_detail');
            }
        });


        // mktg_invoice
        Schema::create('mktg_invoice', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('mktg_order_id')->nullable();
            $table->enum('invoice_type', array(
                'INV-', 'MR--'
            ))->nullable();
            $table->string('invoice_no', 16)->unique();
            $table->timestamp('date')->nullable();
            $table->float('amount')->nullable();
            $table->text('reference')->nullable();
            $table->enum('status', array(
                'invoiced', 'paid', 'cancel'
            ))->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('mktg_invoice', function($table) {
            /*if table  exists */
            if(Schema::hasTable('mktg_order')){
                $table->foreign('mktg_order_id')->references('id')->on('mktg_order');
            }
        });


        // mktg_settings
        Schema::create('mktg_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 100);
            $table->string('code', 10);
            $table->integer('last_number');
            $table->integer('increment');
            $table->enum('status',array('open','close'))->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mktg_material');
        Schema::drop('mktg_artwork');
        Schema::drop('mktg_menu_item');
        Schema::drop('mktg_menu_item_img');
        Schema::drop('mktg_item_option');
        Schema::drop('mktg_item_value');
        Schema::drop('mktg_order');
        Schema::drop('mktg_order_detail');
        Schema::drop('mktg_artwork_image');
        Schema::drop('mktg_invoice');
        Schema::drop('mktg_settings');

    }



}
