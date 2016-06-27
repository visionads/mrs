<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Solution Type
        Schema::create('solution_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->nullable();
            $table->string('description',128)->nullable();
            $table->unsignedInteger('business_id')->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('solution_type', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });

        //Photography Package
        Schema::create('photography_package', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->nullable();
            $table->float('price')->nullable();
            $table->unsignedInteger('business_id')->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('photography_package', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });


        //Photography Options
        Schema::create('photography_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('photography_package_id')->nullable();
            $table->string('items', 64)->nullable();
            $table->string('description',128)->nullable();
            $table->unsignedInteger('business_id')->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('photography_options', function($table) {
            /*if 'photography_package' table  exists */
            if(Schema::hasTable('photography_package'))
            {
                $table->foreign('photography_package_id')->references('id')->on('photography_package');
            }
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });




        //print_material
        Schema::create('print_material', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->nullable();
            $table->string('image_path', 128)->nullable();
            $table->string('image_thumb', 128)->nullable();
            $table->boolean('is_distribution')->nullable();
            $table->unsignedInteger('business_id')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('print_material', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });


        //print_material_size
        Schema::create('print_material_size', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('print_material_id')->nullable();
            $table->string('title', 64)->nullable();
            $table->float('price')->nullable();
            $table->string('description',128)->nullable();
            $table->unsignedInteger('business_id')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('print_material_size', function($table) {
            /*if 'print_material' table  exists */
            if(Schema::hasTable('print_material'))
            {
                $table->foreign('print_material_id')->references('id')->on('print_material');
            }
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });


        //signboard_package
        Schema::create('print_material_distribution', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('quantity')->nullable();
            $table->boolean('is_surrounded')->nullable();
            $table->text('other_address')->nullable();
            $table->dateTime('date_of_distribution')->nullable();
            $table->string('note', 128)->nullable();
            $table->unsignedInteger('business_id')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('print_material_distribution', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });



        //signboard_package
        Schema::create('signboard_package', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->nullable();
            $table->string('image_path', 128)->nullable();
            $table->string('image_thumb', 128)->nullable();
            $table->unsignedInteger('business_id')->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('signboard_package', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });


        //signboard_package_size
        Schema::create('signboard_package_size', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('signboard_package_id')->nullable();
            $table->string('title', 64)->nullable();
            $table->float('price')->nullable();
            $table->string('description',128)->nullable();
            $table->unsignedInteger('business_id')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('signboard_package_size', function($table) {
            /*if 'signboard_package' table  exists */
            if(Schema::hasTable('signboard_package'))
            {
                $table->foreign('signboard_package_id')->references('id')->on('signboard_package');
            }
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });



        //digital_media
        Schema::create('digital_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->nullable();
            $table->string('url', 128)->nullable();
            $table->unsignedInteger('business_id')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('digital_media', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });


        //local_media
        Schema::create('local_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->nullable();
            $table->string('description', 128)->nullable();
            $table->unsignedInteger('business_id')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('local_media', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });


        //signboard_package_size
        Schema::create('local_media_option', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('local_media_id')->nullable();
            $table->string('title', 64)->nullable();
            $table->float('price')->nullable();
            $table->unsignedInteger('business_id')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('local_media_option', function($table) {
            /*if 'local_media' table  exists */
            if(Schema::hasTable('local_media'))
            {
                $table->foreign('local_media_id')->references('id')->on('local_media');
            }
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });
//
//
//
//
        //property_detail
        Schema::create('property_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_name', 64)->nullable();
            $table->text('address')->nullable();
            $table->string('vendor_name', 64)->nullable();

            $table->string('vendor_email', 64)->nullable();
            $table->string('vendor_phone', 64)->nullable();
            $table->string('vendor_signature_path', 128)->nullable();

            $table->dateTime('signature_date')->nullable();
            $table->string('agent_signature_path', 128)->nullable();

            $table->string('main_selling_line', 256)->nullable();
            $table->text('property_description')->nullable();
            $table->dateTime('inspection_date')->nullable();
            $table->text('inspection_features')->nullable();
            $table->text('other_features')->nullable();
            $table->float('selling_price')->nullable();
            $table->dateTime('auction_time')->nullable();
            $table->string('offer', 64)->nullable();
            $table->text('note')->nullable();
            $table->unsignedInteger('business_id')->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('property_detail', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });


        //quote
        Schema::create('quote', function (Blueprint $table) {
            $table->increments('id');

            $table->string('quote_number', 16)->unique();
            $table->unsignedInteger('solution_type_id')->nullable();
            $table->unsignedInteger('property_detail_id')->nullable();
            $table->unsignedInteger('photography_package_id')->nullable();
            $table->text('photography_package_comments')->nullable();

            $table->unsignedInteger('signboard_package_id')->nullable();
            #$table->unsignedInteger('signboard_package_size_id')->nullable();
            $table->text('signboard_package_comments')->nullable();

            $table->unsignedInteger('print_material_id')->nullable();
            #$table->unsignedInteger('print_material_size_id')->nullable();
            $table->text('print_material_comments')->nullable();
            $table->smallInteger('is_distributed')->nullable();


            $table->unsignedInteger('print_material_distribution_id')->nullable();

            $table->unsignedInteger('digital_media_id')->nullable();
            $table->text('digital_media_note')->nullable();

            $table->unsignedInteger('local_media_id')->nullable();
            #$table->unsignedInteger('local_media_option_id')->nullable();
            $table->text('local_media_note')->nullable();

            $table->unsignedInteger('business_id')->nullable();

            /*$table->enum('status', ['open', 'quote_confirmed', 'placed_order', 'invoiced'])->nullable();*/
            $table->string('status', 32)->default('open');;

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('quote', function($table) {
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });



        //transaction
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quote_id');
            $table->string('invoice_no',20)->unique();
            $table->string('currency',5)->nullable();
            $table->float('amount')->nullable();
            $table->float('gst')->nullable();
            $table->float('total_amount')->nullable();
            $table->string('status',20)->nullable();
            $table->unsignedInteger('business_id')->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('transaction', function($table) {
            /*if 'quote' table  exists */
            if(Schema::hasTable('quote'))
            {
                $table->foreign('quote_id')->references('id')->on('quote');
            }
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });


        //payment
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('transaction_id');
            $table->string('money_receipt_no', 16)->unique();
            $table->string('payment_trans',20)->nullable();
            $table->string('type',40)->nullable();
            $table->float('amount')->nullable();
            $table->string('status',20)->nullable();
            $table->unsignedInteger('business_id')->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('payment', function($table) {
            /*if 'transaction' table  exists */
            if(Schema::hasTable('transaction'))
            {
                $table->foreign('transaction_id')->references('id')->on('transaction');
            }
            if(Schema::hasTable('business'))
            {
                $table->foreign('business_id')->references('id')->on('business');
            }
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('solution_type');
        Schema::drop('photography_package');
        Schema::drop('photography_options');
        Schema::drop('print_material');
        Schema::drop('print_material_size');
        Schema::drop('print_material_distribution');
        Schema::drop('signboard_package');
        Schema::drop('signboard_package_size');
        Schema::drop('digital_media');
        Schema::drop('local_media');
        Schema::drop('local_media_option');
        Schema::drop('property_detail');
        Schema::drop('quote');

        Schema::drop('transaction');
        Schema::drop('payment');
    }
}