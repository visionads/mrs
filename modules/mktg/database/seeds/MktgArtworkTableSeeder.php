<?php
use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 7/20/2016
 * Time: 10:34 AM
 */
class MktgArtworkTableSeeder extends Seeder
{
    public function run()
    {
        //DB::table('mktg_material')->truncate();
        DB::table('mktg_artwork')->delete();

        $artwork = array(
            array('Use existing file (RE ORDER NO CHANGES)','check1','100','open'),
            array('Use existing file (CHANGES REQ UIRED DETAILS ONLY) Please write below the changes, eg Name: John Smith, Phone 0234565...', 'check3','110','open'),
            array('Artwork and design required (one of our friendly graphics designers will be in touch with you)','check5','120','open'),
            array('Upload Artwork (file)','check2','130','open'),
            array('Use existing file (CHANGES REQ UIRED DETAILS ONLY) Please write below the changes, eg Name: John Smith, Phone 0234565...','check4','140','open')
        );

        foreach($artwork as $item) {
            \App\MktgArtwork::insert(array(
                'title' => $item[0],
                'slug' => $item[1],
                'price' => $item[2],
                'status' => $item[3],
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ));
        }
    }
}