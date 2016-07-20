<?php

use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 7/20/2016
 * Time: 9:34 AM
 */
class MktgMaterialTableSeeder extends Seeder
{
    public function run()
    {
        //DB::table('mktg_material')->truncate();
        DB::table('mktg_material')->delete();

        $materials = array(
            array('Agency Stationary Material','#ASM','glyphicon glyphicon-paperclip','open'),
            array('Agency / Agent Marketing', '#AAM','glyphicon glyphicon-user','open'),
            array('Property Marketing','#PM','glyphicon glyphicon-home','open')
        );

        foreach($materials as $item) {
            \App\MktgMaterial::insert(array(
                'title' => $item[0],
                'slug' => $item[1],
                'icon' => $item[2],
                'status' => $item[3],
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ));
        }
    }
}