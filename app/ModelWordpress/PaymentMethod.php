<?php

namespace App\ModelWordpress;

use Corcel\Model\Post as Corcel;

class PaymentMethod extends Corcel
{
    protected $postType = 'payments-methods';

    protected static $aliases = [
        'ar_payment_name' => 'post_title',
        'en_payment_name' => '_wp_saleemfx_payments_methods_en_title',
    ];

    # public function scopeTranslate($query, $language)
    # {
    #   $models = $query->taxonomy('language', $language);
    #   return $models;
    # }

}
