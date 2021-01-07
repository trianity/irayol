<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('media')->delete();

        DB::table('media')->insert(array(

            array(
                'user_id' => 11, //User admin
                'file' => '165ff489b3d66f2.jpg',
                'path' => '/storage/uploads/165ff489b3d66f2.jpg',
                'extension' => 'jpg'
            ),

            array(
                'user_id' => 11, //User admin
                'file' => '185ff488e12389d.jpg',
                'path' => '/storage/uploads/185ff488e12389d.jpg',
                'extension' => 'jpg'
            ),

            array(
                'user_id' => 11, //User admin
                'file' => '205ff3d35b08911.jpg',
                'path' => '/storage/uploads/205ff3d35b08911.jpg',
                'extension' => 'jpg'
            ),

            array(
                'user_id' => 11, //User admin
                'file' => '205ff48ac49889c.jpg',
                'path' => '/storage/uploads/205ff48ac49889c.jpg',
                'extension' => 'jpg'
            ),

            array(
                'user_id' => 11, //User admin
                'file' => '155ff48ac3e77ba.png',
                'path' => '/storage/uploads/155ff48ac3e77ba.png',
                'extension' => 'jpg'
            ),

            array(
                'user_id' => 11, //User admin
                'file' => '165ff48ac4382c3.png',
                'path' => '/storage/uploads/165ff48ac4382c3.png',
                'extension' => 'jpg'
            ),

            array(
                'user_id' => 11, //User admin
                'file' => '175ff48ac414122.png',
                'path' => '/storage/uploads/175ff48ac414122.png',
                'extension' => 'jpg'
            ),

            array(
                'user_id' => 11, //User admin
                'file' => '205ff48ac47f97f.png',
                'path' => '/storage/uploads/205ff48ac47f97f.png',
                'extension' => 'jpg'
            ),

        ));
    }
}
