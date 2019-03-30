<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enquiry;
use App\EnquiryRequirements;
use App\ProductDetails;
use App\ProductCatalog;
use App\EnquiryQuotations;
use App\EnquiryQuotationLinkage;
use App\Order;
use App\OrderCycle;
use App\OrderStatusUpdates;

use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\UserActions;
use App\Notifications\UserTasks;


class EnquiryController extends Controller
{

    public function getNextSequence($count) {

        return sprintf("%'.04d", $count + 1);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries = Enquiry::orderBy('created_at', 'DESC')->get();
        $title = "All Enquiries";
        if(count($enquiries) > 0) {
            return view('enquiry.index', compact('enquiries', 'title'));
        }
        else {
            return view('enquiry.dummy', compact('title'));
        }
    }

    public function approvedEnquiry()
    {
        $enquiries = Enquiry::orderBy('created_at', 'DESC')->where('enquiryStatus', 'APPROVED')->get();
        $title = "Approved Enquiries";
        if(count($enquiries) > 0) {
            return view('enquiry.index', compact('enquiries', 'title'));
        }
        else {
            return view('enquiry.dummy', compact('title'));
        }
    }

    public function cancelEnquiry()
    {
        $enquiries = Enquiry::orderBy('created_at', 'DESC')->where('enquiryStatus', 'CANCELLED')->get();
        $title = "Cancelled Enquiries";
        if(count($enquiries) > 0) {
            return view('enquiry.index', compact('enquiries', 'title'));
        }
        else {
            return view('enquiry.dummy', compact('title'));
        }
    }

    public function userLoginEnquiry()
    {
        $enquiries = Enquiry::orderBy('created_at', 'DESC')->where('concernedLeadPerson', \Auth::user()->name)->get();
        $title = "My Enquiries";
        if(count($enquiries) > 0) {
            return view('enquiry.index', compact('enquiries', 'title'));
        }
        else {
            return view('enquiry.dummy', compact('title'));
        }
    }

    public function holdEnquiry()
    {
        $enquiries = Enquiry::orderBy('created_at', 'DESC')->where('enquiryStatus', 'ON HOLD')->get();
        $title = "Hold Enquiries";
        if(count($enquiries) > 0) {
            return view('enquiry.index', compact('enquiries', 'title'));
        }
        else {
            return view('enquiry.dummy', compact('title'));
        }
    }

    public function awaitQuoteEnquiry()
    {
        $enquiryQuoteMatchCriteria = ['REQUEST FOR QUOTATION', 'REQUEST FOR REVISED QUOTATION'];
        $title = "Pending Enquiry Quotations";
        $enquiries = Enquiry::orderBy('created_at', 'DESC')->whereIn('enquiryStatus', $enquiryQuoteMatchCriteria)->get();
        if(count($enquiries) > 0) {
            return view('enquiry.index', compact('enquiries', 'title'));
        }
        else {
            return view('enquiry.dummy', compact('title'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productsDtls = ProductCatalog::select('product_category')->get();
        return view('enquiry.create', compact('productsDtls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $enquiryCount = count(Enquiry::all());
        //validate post data
        $this->validate($request, [
            'leadSource' => 'required',
            'eventName' => 'required',
            'eventPlace' => 'required',
            'organizationName' => 'required',
            'eventDate' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'designation' => 'required',
            'email' => 'required'
        ]);

        $enquiry = new Enquiry();

        $enquiry->concernedLeadPerson = $request->concernedLeadPerson;
        $enquiry->enquiryCreDttm = $request->enquiryCreDttm;
        $enquiry->leadSource = $request->leadSource;
        $documentNumberGen = "MER_";
        $documentNumberGen .= $this->getNextSequence($enquiryCount);
        $enquiry->documentNumber = $documentNumberGen;

        $enquiry->eventName = $request->eventName;
        $enquiry->eventPlace = $request->eventPlace;
        $enquiry->organizationName = $request->organizationName;
        $enquiry->eventDate = $request->eventDate;

        $enquiry->name = $request->name;
        $enquiry->phone = $request->phone;
        $enquiry->alternatePhone = $request->alternatePhone;
        $enquiry->designation = $request->designation;
        $enquiry->email = $request->email;

        $enquiry->enquiryStatus = "IN PROGRESS";
        $enquiry->enquiryComments = $request->organizationName . ' / ' . $request->eventName . " Enquiry Form";

        $enquiry->sampleDetailsSent = $request->sampleDetailsSent;
        $enquiry->sampleDetailsComments = $request->sampleDetailsComments;

        $enquiry->sampleReceivedByCustomer = $request->sampleReceivedByCustomer;
        $enquiry->samplesCustomerFeedback = $request->samplesCustomerFeedback;

        $enquiry->save();

        $productCatArr = $request->productCd;
        $productDescrArr = $request->productDescr;
        $quantityArr = $request->quantity;
        $artWorkNotesArr = $request->artWorkNotes;
        $statusArr = $request->status;

        // Features
        $productStyleArr = $request->productStyleFeatures;
        $materialArr = $request->materialFeatures;
        $qualityArr = $request->qualityFeatures;
        $fabricArr = $request->fabricFeatures;
        $additionalFtArr = $request->additionalFeatures;

        // Customizations
        $colourArr = $request->colourCustomizations;
        $printMethArr = $request->printMethodCustomizations;
        $printPlacementArr = $request->printPlacementCustomizations;
        $printAreaArr = $request->printAreaCustomizations;
        $measurementsArr = $request->measurementsCustomizations;
        $additionalCustArr = $request->additionalCustomizations;

        // Conditions
        $finishingArr = $request->finishing;
        $packagingArr = $request->packaging;
        $inclusiveArr = $request->inclusive;
        $exclusiveArr = $request->exclusive;

        $x = 0;

        while($x < count($productCatArr)) {

            $enquiryReq = new EnquiryRequirements();
            $enquiryReq->product_category = $productCatArr[$x];
            $enquiryReq->product_description = $productDescrArr[$x];
            $enquiryReq->quantity = $quantityArr[$x];
            $enquiryReq->art_work_notes = $artWorkNotesArr[$x];
            $enquiryReq->status = $statusArr[$x];

            // Features
            $enquiryReq->product_style = ((substr($productStyleArr[$x], -1) == ",")?  substr($productStyleArr[$x], 0, -1) : $productStyleArr[$x]);
            $enquiryReq->material = ((substr($materialArr[$x], -1) == ",")?  substr($materialArr[$x], 0, -1) : $materialArr[$x]);
            $enquiryReq->quality = ((substr($qualityArr[$x], -1) == ",")?  substr($qualityArr[$x], 0, -1) : $qualityArr[$x]);
            $enquiryReq->fabric = ((substr($fabricArr[$x], -1) == ",")?  substr($fabricArr[$x], 0, -1) : $fabricArr[$x]);
            $enquiryReq->additional_features = ((substr($additionalFtArr[$x], -1) == ",")?  substr($additionalFtArr[$x], 0, -1) : $additionalFtArr[$x]);

            // Customizations
            $enquiryReq->colour = ((substr($colourArr[$x], -1) == ",")?  substr($colourArr[$x], 0, -1) : $colourArr[$x]);
            $enquiryReq->print_methods = ((substr($printMethArr[$x], -1) == ",")?  substr($printMethArr[$x], 0, -1) : $printMethArr[$x]);
            $enquiryReq->print_placements = ((substr($printPlacementArr[$x], -1) == ",")?  substr($printPlacementArr[$x], 0, -1) : $printPlacementArr[$x]);
            $enquiryReq->print_area = ((substr($printAreaArr[$x], -1) == ",")?  substr($printAreaArr[$x], 0, -1) : $printAreaArr[$x]);
            $enquiryReq->measurements = ((substr($measurementsArr[$x], -1) == ",")?  substr($measurementsArr[$x], 0, -1) : $measurementsArr[$x]);
            $enquiryReq->additional_customizations = ((substr($additionalCustArr[$x], -1) == ",")?  substr($additionalCustArr[$x], 0, -1) : $additionalCustArr[$x]);

            // Conditions
            $enquiryReq->finishing = ((substr($finishingArr[$x], -1) == ",")?  substr($finishingArr[$x], 0, -1) : $finishingArr[$x]);
            $enquiryReq->packaging = ((substr($packagingArr[$x], -1) == ",")?  substr($packagingArr[$x], 0, -1) : $packagingArr[$x]);
            $enquiryReq->inclusive = ((substr($inclusiveArr[$x], -1) == ",")?  substr($inclusiveArr[$x], 0, -1) : $inclusiveArr[$x]);
            $enquiryReq->exclusive = ((substr($exclusiveArr[$x], -1) == ",")?  substr($exclusiveArr[$x], 0, -1) : $exclusiveArr[$x]);

            $enquiry->enquiryRequirements()->save($enquiryReq);
            $x++;
        }

        $enquiryId = $enquiry->id;
        $subjectLine = "Mr. " . $request->concernedLeadPerson . " created merchandise enquiry for " . $request->organizationName;
        $content = $request->organizationName . " is organizing " . $request->eventName . " on " . date('d-M-Y', strtotime($request->eventDate)) . " at " . $request->eventPlace. ". As part of that event, enquiry has been created in the system to track the requirement details. View the Enquiry form below for more details.";
        $additionalInfo = $enquiry->enquiryComments;
        $linkDescr = "View Enquiry";
        $link = "/enquiry/displayEnquiry/" . $enquiryId;
        $statusCd = $enquiry->enquiryStatus;
        OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, $linkDescr, $link, $additionalInfo, $statusCd);

        Enquiry::addNotificationEntry($subjectLine, $link);

        return redirect('/enquiry')->with('success', 'Enquiry Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enquiry = Enquiry::find($id);
        $enquiryRequirements = $enquiry->enquiryRequirements()->get();
        $enquiryQuoteLinkage = EnquiryQuotationLinkage::where('enquiry_id', $id)->get();
        return view('enquiry.display', compact('enquiry', 'enquiryRequirements', 'enquiryQuoteLinkage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $enquiry = Enquiry::find($id);
      $enquiryRequirements = $enquiry->enquiryRequirements()->get();
      $productsDtls = ProductCatalog::select('product_category')->get();
      return view('enquiry.edit', compact('enquiry', 'enquiryRequirements', 'productsDtls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      //validate post data
      $this->validate($request, [
          'leadSource' => 'required',
          'eventName' => 'required',
          'eventPlace' => 'required',
          'organizationName' => 'required',
          'eventDate' => 'required',
          'name' => 'required',
          'phone' => 'required',
          'designation' => 'required',
          'email' => 'required'
      ]);

      $enquiry = Enquiry::find($id);
      $enquiry->leadSource = $request->leadSource;
      $enquiry->eventName = $request->eventName;
      $enquiry->eventPlace = $request->eventPlace;
      $enquiry->organizationName = $request->organizationName;
      $enquiry->eventDate = $request->eventDate;

      $enquiry->name = $request->name;
      $enquiry->phone = $request->phone;
      $enquiry->alternatePhone = $request->alternatePhone;
      $enquiry->designation = $request->designation;
      $enquiry->email = $request->email;

      $enquiry->enquiryStatus = $request->enquiryStatus;
      $enquiry->enquiryComments = $request->enquiryComments;

      $enquiry->sampleDetailsSent = $request->sampleDetailsSent;
      $enquiry->sampleDetailsComments = $request->sampleDetailsComments;

      $enquiry->sampleReceivedByCustomer = $request->sampleReceivedByCustomer;
      $enquiry->samplesCustomerFeedback = $request->samplesCustomerFeedback;

      $enquiry->save();

      $enquiry->enquiryRequirements()->delete();

      $productCatArr = $request->productCd;
      $productDescrArr = $request->productDescr;
      $quantityArr = $request->quantity;
      $artWorkNotesArr = $request->artWorkNotes;
      $statusArr = $request->status;

      // Features
      $productStyleArr = $request->productStyleFeatures;
      $materialArr = $request->materialFeatures;
      $qualityArr = $request->qualityFeatures;
      $fabricArr = $request->fabricFeatures;
      $additionalFtArr = $request->additionalFeatures;

      // Customizations
      $colourArr = $request->colourCustomizations;
      $printMethArr = $request->printMethodCustomizations;
      $printPlacementArr = $request->printPlacementCustomizations;
      $printAreaArr = $request->printAreaCustomizations;
      $measurementsArr = $request->measurementsCustomizations;
      $additionalCustArr = $request->additionalCustomizations;

      // Conditions
      $finishingArr = $request->finishing;
      $packagingArr = $request->packaging;
      $inclusiveArr = $request->inclusive;
      $exclusiveArr = $request->exclusive;

      $x = 0;

      while($x < count($productCatArr)) {

          $enquiryReq = new EnquiryRequirements();
          $enquiryReq->product_category = $productCatArr[$x];
          $enquiryReq->product_description = $productDescrArr[$x];
          $enquiryReq->quantity = $quantityArr[$x];
          $enquiryReq->art_work_notes = $artWorkNotesArr[$x];
          $enquiryReq->status = $statusArr[$x];

          // Features
          $enquiryReq->product_style = ((substr($productStyleArr[$x], -1) == ",")?  substr($productStyleArr[$x], 0, -1) : $productStyleArr[$x]);
          $enquiryReq->material = ((substr($materialArr[$x], -1) == ",")?  substr($materialArr[$x], 0, -1) : $materialArr[$x]);
          $enquiryReq->quality = ((substr($qualityArr[$x], -1) == ",")?  substr($qualityArr[$x], 0, -1) : $qualityArr[$x]);
          $enquiryReq->fabric = ((substr($fabricArr[$x], -1) == ",")?  substr($fabricArr[$x], 0, -1) : $fabricArr[$x]);
          $enquiryReq->additional_features = ((substr($additionalFtArr[$x], -1) == ",")?  substr($additionalFtArr[$x], 0, -1) : $additionalFtArr[$x]);

          // Customizations
          $enquiryReq->colour = ((substr($colourArr[$x], -1) == ",")?  substr($colourArr[$x], 0, -1) : $colourArr[$x]);
          $enquiryReq->print_methods = ((substr($printMethArr[$x], -1) == ",")?  substr($printMethArr[$x], 0, -1) : $printMethArr[$x]);
          $enquiryReq->print_placements = ((substr($printPlacementArr[$x], -1) == ",")?  substr($printPlacementArr[$x], 0, -1) : $printPlacementArr[$x]);
          $enquiryReq->print_area = ((substr($printAreaArr[$x], -1) == ",")?  substr($printAreaArr[$x], 0, -1) : $printAreaArr[$x]);
          $enquiryReq->measurements = ((substr($measurementsArr[$x], -1) == ",")?  substr($measurementsArr[$x], 0, -1) : $measurementsArr[$x]);
          $enquiryReq->additional_customizations = ((substr($additionalCustArr[$x], -1) == ",")?  substr($additionalCustArr[$x], 0, -1) : $additionalCustArr[$x]);

          // Conditions
          $enquiryReq->finishing = ((substr($finishingArr[$x], -1) == ",")?  substr($finishingArr[$x], 0, -1) : $finishingArr[$x]);
          $enquiryReq->packaging = ((substr($packagingArr[$x], -1) == ",")?  substr($packagingArr[$x], 0, -1) : $packagingArr[$x]);
          $enquiryReq->inclusive = ((substr($inclusiveArr[$x], -1) == ",")?  substr($inclusiveArr[$x], 0, -1) : $inclusiveArr[$x]);
          $enquiryReq->exclusive = ((substr($exclusiveArr[$x], -1) == ",")?  substr($exclusiveArr[$x], 0, -1) : $exclusiveArr[$x]);

          $enquiry->enquiryRequirements()->save($enquiryReq);
          $x++;
      }

      if($enquiry->enquiryStatus == 'IN PROGRESS') {

          $enquiryId = $enquiry->id;
          $subjectLine = "Enquiry Updated";
          $content = "Mr. " . $request->concernedLeadPerson . " Updated The Enquiry Details Upon Discussions With Customer And Admin.";
          $additionalInfo = $request->enquiryComments;
          OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, null, null, $additionalInfo, "IN PROGRESS");

          $link = "/enquiry/displayEnquiry/" . $enquiryId;
          Enquiry::addNotificationEntry("Mr. " . \Auth::user()->name . " Updated The Enquiry Details for " . $request->organizationName . "", $link);
      }

      if($enquiry->enquiryStatus == 'REQUEST FOR QUOTATION') {

          $enquiryId = $enquiry->id;
          $subjectLine = "Quotation Requested";
          $content = "Mr. " . $request->concernedLeadPerson . " has requested for quotation price for the merchandise products listed in the enquiry. Awaiting counter action from Admin to review the enquiry and provide the quotation details.";
          $additionalInfo = $request->enquiryComments;
          OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, null, null, $additionalInfo, "REQUEST FOR QUOTATION");

          $link = "/enquiry/displayEnquiry/" . $enquiryId;
          Enquiry::addNotificationEntry("Mr. " . \Auth::user()->name . " has requested for quotation price for the merchandise products listed in the enquiry for " . $request->organizationName . "", $link);
      }

      if($enquiry->enquiryStatus == 'REQUEST FOR REVISED QUOTATION') {

          $enquiryId = $enquiry->id;
          $subjectLine = "Revised Quotation Requested";
          $content = "Mr. " . $request->concernedLeadPerson . " has requested again for quotation price for the merchandise products as customer is not in agreement with the quotation. Awaiting counter action from Admin to provide the revised quotation details.";
          $additionalInfo = $request->enquiryComments;
          OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, null, null, $additionalInfo, "REQUEST FOR REVISED QUOTATION");

          $link = "/enquiry/displayEnquiry/" . $enquiryId;
          Enquiry::addNotificationEntry("Mr. " . \Auth::user()->name . " has requested for revised quotation price for the merchandise products listed in the enquiry for " . $request->organizationName . "", $link);
      }
      if($enquiry->enquiryStatus == 'ON HOLD') {

          $enquiryId = $enquiry->id;
          $subjectLine = "Enquiry ON HOLD";
          $content = "Mr. " . $request->concernedLeadPerson . " has put the enquiry on HOLD.";
          $additionalInfo = $request->enquiryComments;
          OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, null, null, $additionalInfo, "ON HOLD");

          $link = "/enquiry/displayEnquiry/" . $enquiryId;
          Enquiry::addNotificationEntry("Mr. " . \Auth::user()->name . " has put the enquiry on HOLD for " . $request->organizationName . "", $link);
      }
      if($enquiry->enquiryStatus == 'CANCEL') {

          $enquiryId = $enquiry->id;
          $subjectLine = "Enquiry CANCELLED";
          $content = "Mr. " . $request->concernedLeadPerson . " cancelled the enquiry created in the system.";
          $additionalInfo = $request->enquiryComments;
          OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, null, null, $additionalInfo, "CANCEL");

          $link = "/enquiry/displayEnquiry/" . $enquiryId;
          Enquiry::addNotificationEntry("Mr. " . \Auth::user()->name . " cancelled the enquiry created in the system for " . $request->organizationName . "", $link);
      }

      return redirect('/enquiry')->with('success', 'Enquiry Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquiry = Enquiry::find($id);
        $enquiry->enquiryRequirements()->delete();
        $enquiry->delete();
    }

    public function quote($id) {

      $enquiry = Enquiry::find($id);
      $enquiryRequirements = $enquiry->enquiryRequirements()->where('status', 'Approved')->get();
      $enquiryQuoteLinkage = EnquiryQuotationLinkage::where('enquiry_id', $id)->get();
      $hsnCodeArr = array();
      $gstTaxArr = array();

      for($i=0; $i<count($enquiryRequirements); $i++) {
          $prodDtls = $this->getProductTaxDetails($enquiryRequirements[$i]->product_category);
          $hsnCodeArr[$i] = $prodDtls->hsn_code;
          $gstTaxArr[$i] = $prodDtls->gst_tax;
      }
      return view('enquiry.quotation', compact('enquiry', 'enquiryRequirements', 'enquiryQuoteLinkage', 'hsnCodeArr', 'gstTaxArr'));
    }

    public function getProductDetails($prodCode) {

      $productFeatures = ProductCatalog::where('product_category',$prodCode)->get();
      return $productFeatures[0];
    }

    public function getProductTaxDetails($prodCode) {

      $productFeatures = ProductCatalog::where('product_category',$prodCode)->select('hsn_code', 'gst_tax')->get();
      return $productFeatures[0];
    }

    public function saveQuote(Request $request, $id) {

      $enquiryQuotationsCount = count(EnquiryQuotationLinkage::all());
      $enquiry = Enquiry::find($id);

      $quoteCodeGen = "MER_QUOTE_";
      $quoteCodeGen .= $this->getNextSequence($enquiryQuotationsCount);

      // Quotation Requirements
      $prodTblCount = (int) $request->reqCount;
      $prodCatArr = $request->prodCat;
      $prodDescrArr = $request->prodDescr;
      $quantityArr = $request->quantity;
      $hsnArr = $request->hsnCode;
      $costPerUnitArr = $request->costPerUnit;
      $gstTaxArr = $request->gstTax;
      $x = 0;

      while($x < $prodTblCount) {

          $enquiryQuote = new EnquiryQuotations();
          $enquiryQuote->quoteCreDttm = $request->enquiryCreDttm;
          $enquiryQuote->validity_date = $request->enquiryCreDttm;
          $enquiryQuote->quotation_code = $quoteCodeGen;
          $enquiryQuote->product_category = $prodCatArr[$x];
          $enquiryQuote->product_description = $prodDescrArr[$x];
          $enquiryQuote->quantity = $quantityArr[$x];
          $enquiryQuote->hsn = $hsnArr[$x];
          $enquiryQuote->cost_per_unit = $costPerUnitArr[$x];
          $enquiryQuote->gst_tax = $gstTaxArr[$x];
          $enquiry->enquiryQuotations()->save($enquiryQuote);
          $x++;
      }

      $enquiryQuoteLink = new EnquiryQuotationLinkage();
      $enquiryQuoteLink->enquiry_id = $id;
      $enquiryQuoteLink->quotation_code = $quoteCodeGen;
      $enquiryQuoteLink->advance_payment_percentage = $request->advPayPer;
      $enquiryQuoteLink->min_production_days = $request->minProdDays;
      $enquiryQuoteLink->tax_code = $request->gstTaxCd;
      $enquiryQuoteLink->specific_terms_1 = $request->specificTerms1;
      $enquiryQuoteLink->specific_terms_2 = $request->specificTerms2;
      $enquiryQuoteLink->specific_terms_3 = $request->specificTerms3;
      $enquiryQuoteLink->specific_terms_4 = $request->specificTerms4;
      $enquiryQuoteLink->specific_terms_5 = $request->specificTerms5;
      $enquiryQuoteLink->additional_notes = $request->additionalNotes;
      $enquiryQuoteLink->save();

      // Update Quotation Status
      if($enquiry->enquiryStatus == "REQUEST FOR REVISED QUOTATION") {

          $enquiry->enquiryStatus = "REVISED QUOTATION GENERATED";
          $enquiry->enquiryComments = "Admin / Revised Quotation Generated Online & Verified";
          $enquiryId = $enquiry->id;
          $subjectLine = "Revised Quotation Generated";
          $content = "Mr. " . $request->concernedLeadPerson . " reviewed the enquiry details and provided the quotation upon agreement with the customer to crack the deal. View the Revised Quotation below for more details.";
          $linkDescr = "View Revised Quotation";
          $link = "/enquiry/quotation/" . $enquiryId . "/" . $quoteCodeGen;
          $additionalInfo = "Admin / Revised Quotation Generated Online & Verified";
          OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, $linkDescr, $link, $additionalInfo, "REQUEST FOR REVISED QUOTATION");

          Enquiry::addNotificationEntry("Mr. " . $request->concernedLeadPerson . " reviewed the enquiry details and provided the revised quotation for " . $enquiry->organizationName . "", $link);
      }

      else {

          $enquiry->enquiryStatus = "QUOTATION GENERATED";
          $enquiry->enquiryComments = "Admin / Quotation Generated Online & Verified";

          $enquiryId = $enquiry->id;
          $subjectLine = "Quotation Generated";
          $content = "Mr. " . $request->concernedLeadPerson . " reviewed the enquiry details and provided the quotation for the best price to crack the deal. View the Quotation below for more details.";
          $linkDescr = "View Quotation";
          $link = "/enquiry/quotation/" . $enquiryId . "/" . $quoteCodeGen;
          $additionalInfo = "Admin / Quotation Generated Online & Verified";
          OrderCycle::addLogEntry($enquiryId, $subjectLine, $content, $linkDescr, $link, $additionalInfo, "QUOTATION GENERATED");

          Enquiry::addNotificationEntry("Mr. " . $request->concernedLeadPerson . " reviewed the enquiry details and provided the quotation for " . $enquiry->organizationName . "", $link);
      }

      $enquiry->save();

      return redirect('/enquiry')->with('success', 'Quotation Generated Successfully. View the Enquiry to Review the Quotation.');
    }

    public function viewQuote($id, $quoteCd) {

       $enquiry = Enquiry::find($id);
       $enquiryRequirements = $enquiry->enquiryRequirements()->where('status', 'Approved')->get();
       $enquiryQuote = EnquiryQuotations::where('quotation_code', $quoteCd)->get();
       $enquiryQuoteLinkage = EnquiryQuotationLinkage::where('quotation_code', $quoteCd)->get();

       if(count($enquiryQuote) == 2) {
          return view('quotations.quotationDouble', compact('quoteCd', 'enquiry', 'enquiryQuote', 'enquiryRequirements', 'enquiryQuoteLinkage'));
       }
       else if(count($enquiryQuote) == 1) {
          return view('quotations.quotationSingle', compact('quoteCd', 'enquiry', 'enquiryQuote', 'enquiryRequirements', 'enquiryQuoteLinkage'));
       }
       else {
          return view('quotations.quotationMultiple', compact('quoteCd', 'enquiry', 'enquiryQuote', 'enquiryRequirements', 'enquiryQuoteLinkage'));
       }
    }

    public function getLifecycle($orderId, $enquiryId) {

        $orderCycle = OrderCycle::where('enquiry_id', $enquiryId)->orderBy('created_at','DESC')->get();
        $order = Order::find($orderId);
        $orderStatusUpdates = $order->statusUpdates()->get();
        return view('documents.orderTimeLine', compact('orderCycle', 'orderStatusUpdates'));
    }
}
