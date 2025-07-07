<?php
/**
 * Created By: JISHNU T K
 * Date: 2025/07/07
 * Time: 13:01:52
 * Description: Payment.php
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = ['payment_id', 'order_id', 'status', 'amount', 'currency', 'method', 'email', 'contact', 'raw_response'];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
