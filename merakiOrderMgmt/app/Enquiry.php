<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\UserActions;


class Enquiry extends Model
{

    protected $fillable = ['concernedLeadPerson', 'enquiryCreDttm', 'leadSource', 'documentNumber',
                           'eventName', 'eventPlace', 'organizationName', 'eventDate',
                           'name', 'phone', 'designation', 'email',
                           'quotationGenerated', 'quotationDocumentNumber',
                           'quotationResponse', 'quotationCounterAction',
                           'sampleDetailsSent', 'sampleDetailsComments', 'sampleReceivedByCustomer', 'samplesCustomerFeedback'];

    public function enquiryRequirements() {

        return $this->hasMany('App\EnquiryRequirements');
    }

    public function enquiryQuotations() {

        return $this->hasMany('App\EnquiryQuotations');
    }

    public static function addNotificationEntry($data, $link) {

        $users = User::where('email', '!=', \Auth::user()->email)->get();
        Notification::send($users, new UserActions($data, $link));
    }
}
