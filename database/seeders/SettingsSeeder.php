<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        DB::table('settings')->insert(array (

            array (
                'id' => 1,
                'key' => 'site_name',
                'value' => env('APP_NAME', 'IRAYOL'),
            ),

            array (
                'id' => 2,
                'key' => 'theme_active',
                'value' => env('APP_THEME', 'default'),
            ),

            array (
                'id' => 3,
                'key' => 'site_logo',
                'value' => null,
            ),

            array (
                'id' => 4,
                'key' => 'site_url',
                'value' => '/',
            ),

            array (
                'id' => 5,
                'key' => 'email_address',
                'value' => '',
            ),

            array(
                'id' => 6,
                'key' => 'keyword_seo',
                'value' => '',
            ),

            array(
                'id' => 7,
                'key' => 'desc_seo',
                'value' => '',
            ),

            array(
                'id' => 8,
                'key' => 'favicon',
                'value' => '',
            ),

            array(
                'id' => 9,
                'key' => 'googleanalytic_key',
                'value' => '',
            ),

            array(
                'id' => 10,
                'key' => 'revistafter',
                'value' => '',
            ),

            array(
                'id' => 11,
                'key' => 'robots',
                'value' => '',
            ),

            array(
                'id' => 12,
                'key' => 'main_page',
                'value' => '',
            ),

            array(
                'id' => 13,
                'key' => 'main_menu',
                'value' => '',
            ),

            array(
                'id' => 14,
                'key' => 'app_lang',
                'value' => env('APP_LANG', 'es'),
            ),
        ));
    }
}
