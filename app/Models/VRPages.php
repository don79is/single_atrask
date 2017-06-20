<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VRPages extends CoreModel
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'vr_pages';

    /**
     * Fields which will be manipulated
     * @var array
     */
    protected $fillable = ['id','category_id','cover_id'];

    public function translation()
    {
        $language = request('language_code');
        if ($language == null) {
            $language = app()->getLocale();
        }
        return $this->hasOne(VRPagesTranslations::class, 'record_id', 'id')->where('language_code', $language);
    }
    protected $with = ['translation'];
}
