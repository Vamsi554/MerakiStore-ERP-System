<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCatalog;

class ProductCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $productCatalog = ProductCatalog::all();
        if(count($productCatalog) > 0) {
            return view('productCatalog.index', compact('productCatalog'));
        }
        else {
            return view('productCatalog.dummy');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productCatalog.addProductCatalog');
    }

    public function store(Request $request)
    {
        //validate post data
        $this->validate($request, [
            'productCategory' => 'required',
            'productCategoryCode' => 'required',
            'productDescr' => 'required',
            'artWork' => 'required',
            'hsnCode' => 'required',
            'gstPer' => 'required',
            'additionalInformation' => 'required'
        ]);

        $productCatalog = new ProductCatalog();

        $productCatalog->product_category = $request->productCategory;
        $productCatalog->product_category_code = $request->productCategoryCode;
        $productCatalog->product_description = $request->productDescr;
        $productCatalog->art_work = $request->artWork;
        $productCatalog->hsn_code = $request->hsnCode;
        $productCatalog->gst_tax = $request->gstPer;
        $productCatalog->additional_information = $request->additionalInformation;
        $productCatalog->created_by = \Auth::user()->name;

        // Product Style
        $prodStyleStatusArr = $request->prodStyleStatus;
        $prodStyleFeaturesArr = $request->prodStyleFeatureText;
        $x = 0;
        $psfeatures = "";
        while($x < count($prodStyleStatusArr)) {

            $psfeatures .= $prodStyleStatusArr[$x] . "@" . $prodStyleFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->product_style = substr($psfeatures, 0,-1);

        // Material
        $materialStatusArr = $request->materialStatus;
        $materialFeaturesArr = $request->materialFeatureText;
        $x = 0;
        $mfeatures = "";
        while($x < count($materialStatusArr)) {

            $mfeatures .= $materialStatusArr[$x] . "@" . $materialFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->material = substr($mfeatures, 0,-1);

        // Quality (GSM)
        $qualityStatusArr = $request->qualityStatus;
        $qualityFeaturesArr = $request->qualityFeatureText;
        $x = 0;
        $qfeatures = "";
        while($x < count($qualityStatusArr)) {

            $qfeatures .= $qualityStatusArr[$x] . "@" . $qualityFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->quality = substr($qfeatures, 0,-1);

        // Fabric
        $fabricStatusArr = $request->fabricStatus;
        $fabricFeaturesArr = $request->fabricFeatureText;
        $x = 0;
        $fabfeatures = "";
        while($x < count($fabricStatusArr)) {

            $fabfeatures .= $fabricStatusArr[$x] . "@" . $fabricFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->fabric = substr($fabfeatures, 0,-1);

        // Additional Features
        $addtProdFtStatusArr = $request->addtProdFtStatus;
        $addtProdFtFeaturesArr = $request->addtProdFtFeatureText;
        $x = 0;
        $addtProdfeatures = "";
        while($x < count($addtProdFtStatusArr)) {

            $addtProdfeatures .= $addtProdFtStatusArr[$x] . "@" . $addtProdFtFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->additional_features = substr($addtProdfeatures, 0,-1);

        // Colour
        $colourStatusArr = $request->colourStatus;
        $colourFeaturesArr = $request->colourFeatureText;
        $x = 0;
        $cfeatures = "";
        while($x < count($colourStatusArr)) {

            $cfeatures .= $colourStatusArr[$x] . "@" . $colourFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->colour = substr($cfeatures, 0,-1);

        // Print Methods
        $printMethStatusArr = $request->printMethodStatus;
        $printMethFeaturesArr = $request->printMethodFeatureText;
        $x = 0;
        $pmfeatures = "";
        while($x < count($printMethStatusArr)) {

            $pmfeatures .= $printMethStatusArr[$x] . "@" . $printMethFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->print_methods = substr($pmfeatures, 0,-1);

        // Print Placements
        $printPlacementStatusArr = $request->printPlacementStatus;
        $printPlacementFeaturesArr = $request->printPlacementFeatureText;
        $x = 0;
        $ppfeatures = "";
        while($x < count($printPlacementStatusArr)) {

            $ppfeatures .= $printPlacementStatusArr[$x] . "@" . $printPlacementFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->print_placements = substr($ppfeatures, 0,-1);

        // Print Area
        $printAreaStatusArr = $request->printAreaStatus;
        $printAreaFeaturesArr = $request->printAreaFeatureText;
        $x = 0;
        $pafeatures = "";
        while($x < count($printAreaStatusArr)) {

            $pafeatures .= $printAreaStatusArr[$x] . "@" . $printAreaFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->print_area = substr($pafeatures, 0,-1);

        // Measurements
        $msmrmtStatusArr = $request->measurementsStatus;
        $msmrmtFeaturesArr = $request->measurementsFeatureText;
        $x = 0;
        $mfeatures = "";
        while($x < count($msmrmtStatusArr)) {

            $mfeatures .= $msmrmtStatusArr[$x] . "@" . $msmrmtFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->measurements = substr($mfeatures, 0,-1);

        // Customizations
        $cmStatusArr = $request->customizationsStatus;
        $cmFeaturesArr = $request->customizationsFeatureText;
        $x = 0;
        $cmfeatures = "";
        while($x < count($cmStatusArr)) {

            $cmfeatures .= $cmStatusArr[$x] . "@" . $cmFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->additional_customizations = substr($cmfeatures, 0,-1);

        // Finishing
        $finishingStatusArr = $request->finishingStatus;
        $finishingFeaturesArr = $request->finishingFeatureText;
        $x = 0;
        $ffeatures = "";
        while($x < count($finishingStatusArr)) {

            $ffeatures .= $finishingStatusArr[$x] . "@" . $finishingFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->finishing = substr($ffeatures, 0,-1);

        // Packaging
        $pkgStatusArr = $request->packagingStatus;
        $pkgFeaturesArr = $request->packagingFeatureText;
        $x = 0;
        $pfeatures = "";
        while($x < count($pkgStatusArr)) {

            $pfeatures .= $pkgStatusArr[$x] . "@" . $pkgFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->packaging = substr($pfeatures, 0,-1);

        // Inclusive
        $incStatusArr = $request->inclusiveStatus;
        $incFeaturesArr = $request->inclusiveFeatureText;
        $x = 0;
        $ifeatures = "";
        while($x < count($incStatusArr)) {

            $ifeatures .= $incStatusArr[$x] . "@" . $incFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->inclusive = substr($ifeatures, 0,-1);

        // Exclusive
        $excStatusArr = $request->exclusiveStatus;
        $excFeaturesArr = $request->exclusiveFeatureText;
        $x = 0;
        $efeatures = "";
        while($x < count($excStatusArr)) {

            $efeatures .= $excStatusArr[$x] . "@" . $excFeaturesArr[$x] . "#";
            $x++;
        }
        $productCatalog->exclusive = substr($efeatures, 0,-1);

        $productCatalog->save();

        $subjectLine = "Mr. " . \Auth::user()->name . " added the Product Catalog " . $request->productDescr . " in the System.";
        $link = "/productCatalog/displayProduct/" . $productCatalog->id;
        ProductCatalog::addNotificationEntry($subjectLine, $link);

        return redirect('/productCatalog')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productCatalog = ProductCatalog::find($id);
        $productCategoryArr = array();
        $productCatalogCustomizationsArr = array();

        $productCategoryArr[0] = "Product Style";
        $productCatalogCustomizationsArr[0] = $productCatalog->product_style;

        $productCategoryArr[1] = "Material";
        $productCatalogCustomizationsArr[1] = $productCatalog->material;

        $productCategoryArr[2] = "Quality";
        $productCatalogCustomizationsArr[2] = $productCatalog->quality;

        $productCategoryArr[3] = "Fabric";
        $productCatalogCustomizationsArr[3] = $productCatalog->fabric;

        $productCategoryArr[4] = "Additional Features";
        $productCatalogCustomizationsArr[4] = $productCatalog->additional_features;

        $productCategoryArr[5] = "Colour";
        $productCatalogCustomizationsArr[5] = $productCatalog->colour;

        $productCategoryArr[6] = "Print Methods";
        $productCatalogCustomizationsArr[6] = $productCatalog->print_methods;

        $productCategoryArr[7] = "Print Placements";
        $productCatalogCustomizationsArr[7] = $productCatalog->print_placements;

        $productCategoryArr[8] = "Print Area";
        $productCatalogCustomizationsArr[8] = $productCatalog->print_area;

        $productCategoryArr[9] = "Measurements";
        $productCatalogCustomizationsArr[9] = $productCatalog->measurements;

        $productCategoryArr[10] = "Additional Customizations";
        $productCatalogCustomizationsArr[10] = $productCatalog->additional_customizations;

        $productCategoryArr[11] = "Finishing";
        $productCatalogCustomizationsArr[11] = $productCatalog->finishing;

        $productCategoryArr[12] = "Packaging";
        $productCatalogCustomizationsArr[12] = $productCatalog->packaging;

        $productCategoryArr[13] = "Inclusive";
        $productCatalogCustomizationsArr[13] = $productCatalog->inclusive;

        $productCategoryArr[14] = "Exclusive";
        $productCatalogCustomizationsArr[14] = $productCatalog->exclusive;


        return view('productCatalog.displayProductCatalog', compact('productCatalog', 'productCategoryArr', 'productCatalogCustomizationsArr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCatalog = ProductCatalog::find($id);
        return view('productCatalog.editProductCatalog', compact('productCatalog'));
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
          'productCategory' => 'required',
          'productCategoryCode' => 'required',
          'productDescr' => 'required',
          'artWork' => 'required',
          'hsnCode' => 'required',
          'gstPer' => 'required',
          'additionalInformation' => 'required'
      ]);

      $productCatalog = ProductCatalog::find($id);

      $productCatalog->product_category = $request->productCategory;
      $productCatalog->product_category_code = $request->productCategoryCode;
      $productCatalog->product_description = $request->productDescr;
      $productCatalog->art_work = $request->artWork;
      $productCatalog->hsn_code = $request->hsnCode;
      $productCatalog->gst_tax = $request->gstPer;
      $productCatalog->additional_information = $request->additionalInformation;

      // Product Style
      $prodStyleStatusArr = $request->prodStyleStatus;
      $prodStyleFeaturesArr = $request->prodStyleFeatureText;
      $x = 0;
      $psfeatures = "";
      while($x < count($prodStyleStatusArr)) {

          $psfeatures .= $prodStyleStatusArr[$x] . "@" . $prodStyleFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->product_style = substr($psfeatures, 0,-1);

      // Material
      $materialStatusArr = $request->materialStatus;
      $materialFeaturesArr = $request->materialFeatureText;
      $x = 0;
      $mfeatures = "";
      while($x < count($materialStatusArr)) {

          $mfeatures .= $materialStatusArr[$x] . "@" . $materialFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->material = substr($mfeatures, 0,-1);

      // Quality (GSM)
      $qualityStatusArr = $request->qualityStatus;
      $qualityFeaturesArr = $request->qualityFeatureText;
      $x = 0;
      $qfeatures = "";
      while($x < count($qualityStatusArr)) {

          $qfeatures .= $qualityStatusArr[$x] . "@" . $qualityFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->quality = substr($qfeatures, 0,-1);

      // Fabric
      $fabricStatusArr = $request->fabricStatus;
      $fabricFeaturesArr = $request->fabricFeatureText;
      $x = 0;
      $fabfeatures = "";
      while($x < count($fabricStatusArr)) {

          $fabfeatures .= $fabricStatusArr[$x] . "@" . $fabricFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->fabric = substr($fabfeatures, 0,-1);

      // Additional Features
      $addtProdFtStatusArr = $request->addtProdFtStatus;
      $addtProdFtFeaturesArr = $request->addtProdFtFeatureText;
      $x = 0;
      $addtProdfeatures = "";
      while($x < count($addtProdFtStatusArr)) {

          $addtProdfeatures .= $addtProdFtStatusArr[$x] . "@" . $addtProdFtFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->additional_features = substr($addtProdfeatures, 0,-1);

      // Colour
      $colourStatusArr = $request->colourStatus;
      $colourFeaturesArr = $request->colourFeatureText;
      $x = 0;
      $cfeatures = "";
      while($x < count($colourStatusArr)) {

          $cfeatures .= $colourStatusArr[$x] . "@" . $colourFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->colour = substr($cfeatures, 0,-1);

      // Print Methods
      $printMethStatusArr = $request->printMethodStatus;
      $printMethFeaturesArr = $request->printMethodFeatureText;
      $x = 0;
      $pmfeatures = "";
      while($x < count($printMethStatusArr)) {

          $pmfeatures .= $printMethStatusArr[$x] . "@" . $printMethFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->print_methods = substr($pmfeatures, 0,-1);

      // Print Placements
      $printPlacementStatusArr = $request->printPlacementStatus;
      $printPlacementFeaturesArr = $request->printPlacementFeatureText;
      $x = 0;
      $ppfeatures = "";
      while($x < count($printPlacementStatusArr)) {

          $ppfeatures .= $printPlacementStatusArr[$x] . "@" . $printPlacementFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->print_placements = substr($ppfeatures, 0,-1);

      // Print Area
      $printAreaStatusArr = $request->printAreaStatus;
      $printAreaFeaturesArr = $request->printAreaFeatureText;
      $x = 0;
      $pafeatures = "";
      while($x < count($printAreaStatusArr)) {

          $pafeatures .= $printAreaStatusArr[$x] . "@" . $printAreaFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->print_area = substr($pafeatures, 0,-1);

      // Measurements
      $msmrmtStatusArr = $request->measurementsStatus;
      $msmrmtFeaturesArr = $request->measurementsFeatureText;
      $x = 0;
      $mfeatures = "";
      while($x < count($msmrmtStatusArr)) {

          $mfeatures .= $msmrmtStatusArr[$x] . "@" . $msmrmtFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->measurements = substr($mfeatures, 0,-1);

      // Customizations
      $cmStatusArr = $request->customizationsStatus;
      $cmFeaturesArr = $request->customizationsFeatureText;
      $x = 0;
      $cmfeatures = "";
      while($x < count($cmStatusArr)) {

          $cmfeatures .= $cmStatusArr[$x] . "@" . $cmFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->additional_customizations = substr($cmfeatures, 0,-1);

      // Finishing
      $finishingStatusArr = $request->finishingStatus;
      $finishingFeaturesArr = $request->finishingFeatureText;
      $x = 0;
      $ffeatures = "";
      while($x < count($finishingStatusArr)) {

          $ffeatures .= $finishingStatusArr[$x] . "@" . $finishingFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->finishing = substr($ffeatures, 0,-1);

      // Packaging
      $pkgStatusArr = $request->packagingStatus;
      $pkgFeaturesArr = $request->packagingFeatureText;
      $x = 0;
      $pfeatures = "";
      while($x < count($pkgStatusArr)) {

          $pfeatures .= $pkgStatusArr[$x] . "@" . $pkgFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->packaging = substr($pfeatures, 0,-1);

      // Inclusive
      $incStatusArr = $request->inclusiveStatus;
      $incFeaturesArr = $request->inclusiveFeatureText;
      $x = 0;
      $ifeatures = "";
      while($x < count($incStatusArr)) {

          $ifeatures .= $incStatusArr[$x] . "@" . $incFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->inclusive = substr($ifeatures, 0,-1);

      // Exclusive
      $excStatusArr = $request->exclusiveStatus;
      $excFeaturesArr = $request->exclusiveFeatureText;
      $x = 0;
      $efeatures = "";
      while($x < count($excStatusArr)) {

          $efeatures .= $excStatusArr[$x] . "@" . $excFeaturesArr[$x] . "#";
          $x++;
      }
      $productCatalog->exclusive = substr($efeatures, 0,-1);

      $productCatalog->save();

      $subjectLine = "Mr. " . \Auth::user()->name . " Updated the Product Catalog " . $request->productDescr . " Details.";
      $link = "/productCatalog/displayProduct/" . $productCatalog->id;
      ProductCatalog::addNotificationEntry($subjectLine, $link);

      return redirect('/productCatalog')->with('success', 'Product Updated Successfully');
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
