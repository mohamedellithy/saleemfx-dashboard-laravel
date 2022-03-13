<?php

namespace App\ModelWordpress;

use Corcel\Model\Post as Corcel;

class ForexCompany extends Corcel
{
    protected static $aliases = [
        'ar_post_title' => 'post_title',
    ];

    public function scopeTranslate($query, $language)
    {
      $models = $query->taxonomy('language', $language);
      return $models;
    }

}
