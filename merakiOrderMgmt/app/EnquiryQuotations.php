<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryQuotations extends Model
{

    protected $fillable = ['quoteCreDttm', 'validity_date', 'product_code', 'product_description',
                           'quantity', 'cost_per_unit', 'gst_tax', 'total_amount', 'additional_details'];

    public function enquiry() {

        return $this->belongsTo('App\Enquiry');
    }
}
