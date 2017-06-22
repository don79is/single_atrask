<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRMenu extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_menu';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','new_window','sequence','vr_parent_id'];

    public function translation()
    {
        $language = request('language_code');
        if ($language == null) {
            $language = app()->getLocale();
        }
        return $this->hasOne(VRMenuTranslations::class, 'record_id', 'id')->where('language_code', $language);
    }
    public function children()
    {

        return $this->hasMany( VRMenu:: class, 'vr_parent_id', 'id')->with('children')->orderByDesc('sequence');

    }
    protected $with = ['translation'];
}
