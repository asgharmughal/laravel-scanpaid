<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    use HasFactory;
    protected $fillable = [
        'studentname', 'studentid', 'challanid', 'grade', 'paymentdate', 'amount', 'status', 'verify_image', 'payment_mode', 'payment_info'
    ];

    protected $hidden = array('verify_image');


}