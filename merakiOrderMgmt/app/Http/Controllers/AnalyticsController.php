<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class AnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $clientsArr = ['Oracle', 'ISB', 'Deloitte', 'TSCAB', 'CSC', 'Amazon', 'Google', 'FlipKart', 'Aarvee', 'Microsoft'];
        $ordersArr = [25, 75, 45, 55, 45, 78, 89, 76, 90, 65];

        return view('analytics.final', compact('clientsArr', 'ordersArr'));
    }

    public function trackLeadSource() {

        $leadSourceArr = ['Just Dial', 'India Mart', 'Previous Client', 'Reference', 'Sales'];
        $percentArr = [15, 15, 40, 20, 10];
        return view('analytics.enquiryLeadSource', compact('leadSourceArr', 'percentArr'));
    }

    public function testJsonData() {

        $clientsArr = ['Oracle', 'ISB', 'Deloitte', 'TSCAB', 'CSC', 'Amazon', 'Google', 'FlipKart', 'Aarvee', 'Microsoft'];
        $ordersArr = [25, 75, 45, 55, 45, 78, 89, 76, 90, 65];

        $data = array();
        for($i=0; $i<count($clientsArr); $i++) {
            $newArr = array();
            $newArr['client'] = $clientsArr[$i];
            $newArr['orders'] = $ordersArr[$i] - 5;
            $data[$i] = $newArr;
        }
        return response()->json($data);
    }

    public function testLeadSourceJsonData() {

        $leadSourceArr = ['Just Dial', 'India Mart', 'Previous Client', 'Reference', 'Sales'];
        $percentArr = [15, 15, 40, 20, 10];

        $data = array();
        for($i=0; $i<count($leadSourceArr); $i++) {

          $newArr = array();
          $newArr['source'] = $leadSourceArr[$i];
          $newArr['percent'] = $percentArr[$i];
          $data[$i] = $newArr;
        }
        return response()->json($data);
    }
}
