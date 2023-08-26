<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class invoices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
      'invoices_number',
      'invoices_Date',
      'Due_date',
      'product',
      'section_id',
      'Amount_collection',
      'Amount_commission',
      'discount',
      'Value_VAT',
      'Rate_VAT',
      'total',
      'status',
      'value_Status',
      'note',
      'Payment_Date'
    ];
    public function pro_section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
    protected $dates = ['deleted_at'];
  
}
