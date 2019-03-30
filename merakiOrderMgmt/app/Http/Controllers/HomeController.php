<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function generatePDF() {

      $userName = \Auth::user()->name;
      $pdf = \App::make('dompdf.wrapper');
      $view = view('pdfDocuments.taxInvoice', compact('userName'));
      $contents = (string) $view->render();

      $htmlTestData = "<h2>Vamsi Krishna</h2><img src='images/taxInvoiceHdr.png' alt='Meraki Store' style='width:98%;'/><br><br>";
      $pdf->loadHTML($contents);
      return $pdf->stream('Order_Tax_Invoice.pdf');
    }
}
