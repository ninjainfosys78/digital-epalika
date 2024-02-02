<?php

namespace Modules\Grant\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait UniqueIdTrait
{
    public function generateUniqueId($type, $table = 'farmers', $code = 'FM'): string
    {
        generateUniqueId:
        $unique_id = $code.'-'.Str::padLeft(random_int(1, 999999), 6, 0);
        if (DB::table($table)->where('unique_id', $unique_id)->count() > 0) {
            goto generateUniqueId;
        }

        return $unique_id;
    }
}
