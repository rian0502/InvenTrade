<?php

namespace App\Helper;

use App\Models\ItemModel;
use App\Models\PartnerModel;


class CodeGenerator
{
    public static function generatePartnerCode($is_supplier)
    {
        $count = PartnerModel::count() + 1;
        $code = 'PRT' . sprintf('%05d', $count);
        $code .= $is_supplier ? 'V' : 'C';
        $code .= '-' . date('y');
        return $code;
    }

    public static function generateItemCode()
    {
        $count = ItemModel::count() + 1;
        $code = 'ITM' . sprintf('%05d', $count);
        $code .= '-' . date('y');
        return $code;
    }
}