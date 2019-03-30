<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $vendors = Vendor::all();
      if(count($vendors) > 0) {
          return view('merakiVendors.index', compact('vendors'));
      }
      else {
          return view('merakiVendors.dummy');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merakiVendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //validate post data
      $this->validate($request, [
          'vendorCode' => 'required',
          'vendorName' => 'required',
          'vendorPhone' => 'required',
          'vendorCompany' => 'required',
          'vendorAddress1' => 'required',
          'vendorAddress2' => 'required',
          'street' => 'required',
          'city' => 'required',
          'state' => 'required',
          'zipCode' => 'required',
          'vendorTin' => 'required',
          'vendorCst' => 'required'
      ]);

      $vendor = new Vendor();

      $vendor->vendor_code = $request->vendorCode;
      $vendor->vendor_name = $request->vendorName;
      $vendor->vendor_phone = $request->vendorPhone;
      $vendor->vendor_company = $request->vendorCompany;
      $vendor->vendor_address1 = $request->vendorAddress1;
      $vendor->vendor_address2 = $request->vendorAddress2;
      $vendor->street = $request->street;
      $vendor->city = $request->city;
      $vendor->state = $request->state;
      $vendor->zipcode = $request->zipCode;
      $vendor->vendor_TIN = $request->vendorTin;
      $vendor->vendor_CST = $request->vendorCst;

      $vendor->save();

      $subjectLine = "Mr. " . \Auth::user()->name . " added a New Vendor " . $request->vendorName . ", " . $request->vendorCompany . " in the System.";
      $link = "/meraki/vendors/displayVendor/" . $vendor->id;
      Vendor::addNotificationEntry($subjectLine, $link);

      return redirect('/meraki/vendors')->with('success', 'Vendor Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = Vendor::find($id);
        return view('merakiVendors.display', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return view('merakiVendors.edit', compact('vendor'));
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
          'vendorCode' => 'required',
          'vendorName' => 'required',
          'vendorPhone' => 'required',
          'vendorCompany' => 'required',
          'vendorAddress1' => 'required',
          'vendorAddress2' => 'required',
          'street' => 'required',
          'city' => 'required',
          'state' => 'required',
          'zipCode' => 'required',
          'vendorTin' => 'required',
          'vendorCst' => 'required'
      ]);

      $vendor = Vendor::find($id);

      $vendor->vendor_code = $request->vendorCode;
      $vendor->vendor_name = $request->vendorName;
      $vendor->vendor_phone = $request->vendorPhone;
      $vendor->vendor_company = $request->vendorCompany;
      $vendor->vendor_address1 = $request->vendorAddress1;
      $vendor->vendor_address2 = $request->vendorAddress2;
      $vendor->street = $request->street;
      $vendor->city = $request->city;
      $vendor->state = $request->state;
      $vendor->zipcode = $request->zipCode;
      $vendor->vendor_TIN = $request->vendorTin;
      $vendor->vendor_CST = $request->vendorCst;

      $vendor->save();

      $subjectLine = "Mr. " . \Auth::user()->name . " Updated Vendor Details for " . $request->vendorName . ", " . $request->vendorCompany . "";
      $link = "/meraki/vendors/displayVendor/" . $id;
      Vendor::addNotificationEntry($subjectLine, $link);
      return redirect('/meraki/vendors')->with('success', 'Vendor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
