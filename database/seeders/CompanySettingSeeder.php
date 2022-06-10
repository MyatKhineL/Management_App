<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!CompanySetting::exists()){
            $setting = new CompanySetting();
            $setting->company_name = 'MAH Company';
            $setting->company_email = 'mah@gmail.com';
            $setting->company_phone = '09201345';
            $setting->company_address = 'No(123),Bahan,Yangon';
            $setting->office_start_time = '09:00:00';
            $setting->office_end_time = '18:00:00';
            $setting->break_start_time = '12:00:00';
            $setting->break_end_time = '13:00:00';
            $setting->save();
        }


    }
}
