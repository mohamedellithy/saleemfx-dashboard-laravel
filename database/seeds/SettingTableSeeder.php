<?php

use Illuminate\Database\Seeder;
use App\Setting;
class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::insert([
            [
                'name' =>'min_cashback_withdraw',
                'value' => 25
            ],
            [
                'name' =>'max_cashback_withdraw',
                'value' => 2500
            ],
            [
                'name' =>'max_date_cashback_withdraw',
                'value' => 3
            ],
            [
                'name' =>'currency',
                'value' => 'USD'
            ],
            [
                'name' =>'affiliate_value',
                'value' => 10
            ],
            [
                'name' =>'telegram_channel_link',
                'value' => "https://t.me/AhmedYahay"
            ],
            [
                'name' =>'link_home',
                'value' => '#'
            ],
            [
                'name' =>'link_services',
                'value' => '#'
            ],
            [
                'name' =>'link_about_us',
                'value' => '#'
            ],
            [
                'name' =>'link_videos',
                'value' => '#'
            ],
            [
                'name' =>'link_technichal_analysis',
                'value' => '#'
            ],
            [
                'name' =>'link_blogs',
                'value' => '#'
            ],
            [
                'name' =>'link_courses',
                'value' => '#'
            ],
            [
                'name' =>'link_economic_news',
                'value' => '#'
            ],
            [
                'name' =>'link_contact_us',
                'value' => '#'
            ],
            [
                'name' =>'link_be_partner',
                'value' => '#'
            ]
        ]);
    }
}
