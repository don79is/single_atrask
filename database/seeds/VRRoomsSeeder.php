<?php

use App\Models\VRCategories;
use App\Models\VRCategoriesTranslations;
use Illuminate\Database\Seeder;

class VRRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $categories = [

                ["id" => "vr_rooms"],
            ];
            $categoriestrans = [
                ["name" => "VR-kambariai", "record_id" => "vr_rooms", "language_code" => "lt"],
                ["name" => "VR-rooms", "record_id" => "vr_rooms", "language_code" => "en"],
                ["name" => "VR-kомнаты", "record_id" => "vr_rooms", "language_code" => "ru"],
                ["name" => "VR-zimmer", "record_id" => "vr_rooms", "language_code" => "de"],
                ["name" => "VR-chambre", "record_id" => "vr_rooms", "language_code" => "fr"],

            ];

            DB::beginTransaction();
            try {
                foreach ($categories as $single) {
                    $categorie = VRCategories::where('id', $single['id'])->first();
                    if (!$categorie)
                        VRCategories::create($single);
                }
                foreach ($categoriestrans as $categoriestran) {
                    $record = VRCategoriesTranslations::where('record_id',$categoriestran['record_id'])->where('language_code',$categoriestran['language_code'] )->first();


                    if (!$record)
                        VRCategoriesTranslations::create($categoriestran);
                }
            } catch (\Exception $e) {
                DB::rollback();
                throw new Exception($e->getMessage());
            }
            DB::commit();
        }
    }
}
