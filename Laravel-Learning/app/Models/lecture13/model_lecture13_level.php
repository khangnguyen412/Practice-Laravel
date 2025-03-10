<?php

namespace App\Models\lecture13;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

/**
 * Eloquent relationships Many to Many
 * Bảng account vs level: n-n
 */
class model_lecture13_level extends Model
{
    use HasFactory; // Sử dụng hasfactory để tự động dump db
    protected $table = 'level';
    protected $primaryKey = 'level_id';
    protected $field = [
        'level_id',
        'address',
        'city',
        'cust_type_cd',
        'fed_id',
        'postal_code',
        'state'
    ];
    public $timestamp = false;

    public function account()
    {
        /**
         * belongsToMany($related, $table, $foreignKey, $relatedKey): quan hệ n - n
         * $related: đường dẫn của [namespace hiện tại]\[class liên kết của bảng cha còn lại] hoặc tên class
         * $table: tên bảng trung gian
         * $foreignKey: tên khóa ngoại của bảng n thứ 1
         * $relatedKey: tên khóa ngoại của bảng n thứ 2
         */
        return $this->belongsToMany(model_lecture13_account::class, 'account_level', 'level_id', 'account_id');
    }
}
