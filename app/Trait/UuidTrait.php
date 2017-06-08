<?php
/**
 * Created by PhpStorm.
 * User: Donatas Tumanas
 * Date: 2017-06-08
 * Time: 08:58
 */

namespace App;



use Ramsey\Uuid\Uuid;
/**
 * Class Uuid.
 *
 * Manages the usage of creating UUID values for primary keys. Drop into your models as
 * per normal to use this functionality. Works right out of the box.
 *
 * Taken from: http://garrettstjohn.com/entry/using-uuids-laravel-eloquent-orm/
 */
trait UuidTrait
{
    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {

            if (!isset($model->attributes['id'])) {
                $model->attributes['id'] = Uuid::uuid4();
            } else {
                //TODO check if code will work without else statement
                $model->{$model->getKeyName()} = $model->attributes['id'];
            }
        });
    }
}