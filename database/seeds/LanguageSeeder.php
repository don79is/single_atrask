<?php

use App\Models\VRLanguageCodes;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ["name" => "Lietuvių", "id" => "LT","language_code" => "LT"],
            ["name" => "English", "id" => "EN","language_code" => "EN"],
            ["name" => "Русский", "id" => "RU","language_code" => "RU"],
            ["name" => "Deutsch", "id" => "DE","language_code" => "DE"],
            ["name" => "Francais", "id" => "FR","language_code" => "FR"],


        ];
        DB::beginTransaction();
        try {
            foreach ($languages as $lang) {
                $record = VRLanguageCodes::find($lang['id']);
                if (!$record) {
                    VRLanguageCodes::create($lang);
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            echo 'Point of failure '. $e->getCode() . ' ' . $e->getMessage();
            throw new Exception($e);
        }
        DB::commit();
    }
}
