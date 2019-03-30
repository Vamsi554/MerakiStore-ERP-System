<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryRequirements extends Model
{
    protected $fillable = ['status', 'product', 'quality', 'quantity', 'colour', 'designAttachment', 'customizationDetails'];

    public function enquiry() {

        return $this->belongsTo('App\Enquiry');
    }
}
