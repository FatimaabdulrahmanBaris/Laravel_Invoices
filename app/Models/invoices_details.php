<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_Invoice',
        'invoice_number',
        'product',
        'section',
        'status',
        'value_status',
        'payment_Date',
        'note',
        'user',
      ];
   
}
