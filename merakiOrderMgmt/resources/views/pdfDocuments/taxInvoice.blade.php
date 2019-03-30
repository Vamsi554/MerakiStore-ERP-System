<!DOCTYPE html>
<html>
<head>
  <title>{{ $userName }}</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<link href="https://fonts.googleapis.com/css?family=Calibri" rel="stylesheet"/>
<style>
table, th, td {
    border: 0.6px solid #E6E7E8;
}

#page-wrap { width: 280mm; height:210mm; margin:auto; }
td {
	font-size:13px;
}
@media all {
	.page-break	{ display: none; }
}
@media print {
	.page-break	{ display: block; page-break-before: always; }
}
body{
    font-family: 'Calibri';
}

@page
      {
          size: auto;   /* auto is the initial value */
          margin: 0mm 0mm 2mm 2mm;  /* this affects the margin in the printer settings */
      }

      @media print {
        body {-webkit-print-color-adjust: exact !important;}
      }

</style>
</head>
<body>

<div id="page-wrap">

	<img src="{{ asset('images/taxInvoiceHdr.png') }}" alt="Meraki Store" style="width:98%;"/><br><br>
	<table cellspacing="0" cellpadding="0" style="width:98%;">
	  <tr>
	    <td style="width:50%;padding-left:15px;" rowspan="0">
	    	<img src="{{ asset('images/merakiStoreFooterLogo.png') }}" alt="Meraki Store" style="width:150px;"/><br>
	    	From <br>
	    	<strong style="color: #373435;">MERAKII ENTERPRISES</strong><br>
	    	8-3-978, D.No : 101, SRINAGAR COLONY, MAIN ROAD <br>
	    	HYDERABAD, TELANGANA - 500073 <br><br>

            <b>GSTIN</b> : 36BOPPG4920P1ZD <br>
            <b>PAN</b> : BOPPG4920P <br><br>
	    </td>
	    <td style="padding-left:15px;padding-top:10px;">
	    	<table style="border: 0px;" cellpadding="5">
	    		<tr>
	    			<td style="border:0px;">Tax Invoice No</td><td style="border: 0px;padding:0 0 0 200px;">MER_INV_0001</td>
	    		</tr>
	    		<tr>
	    			<td style="border:0px;">Date</td><td style="border: 0px;padding:0 0 0 200px;">23-Nov-2018</td>
	    		</tr>
	    		<tr>
	    			<td style="border:0px;">Reference No</td><td style="border: 0px;padding:0 0 0 200px;">MER_0001</td>
	    		</tr>
	    		<tr>
	    			<td style="border:0px;">Purchase Order No</td><td style="border: 0px;padding:0 0 0 200px;">MER_PO_0001</td>
	    		</tr>
	    		<tr>
	    			<td style="border:0px;">Place Of Supply</td><td style="border: 0px;padding:0 0 0 200px;">Hyderabad</td>
	    		</tr>
	    		<tr>
	    			<td style="border:0px;">Due Date</td><td style="border: 0px;padding:0 0 0 200px;">30-Nov-2018</td>
	    		</tr>
	    	</table>
		</td>
	  </tr>
	  <tr>
	    <td style="padding-left:20px;padding-top: 10px;">
	    	<b>Contact Details</b><br><br>
	    	Email : contact.merakistore@gmail.com <br><br>
	    	Ph. No : 040 - 48554470, +91 9010661111 <br><br>
	    </td>
	  </tr>
	</table>

	<table cellspacing="0" cellpadding="5" style="width:98%;">
	  <tr>
	    <td style="width:50%;padding-left:15px;padding-top: 10px;">
	    	<b>Billing Address</b><br><br>
	    	<span style="padding-left:30px;">Sudhakar Plastics Pvt Ltd. </span><br>
		    <span style="padding-left:30px;">D.No : 1-11-60/1, Balaram Thanda </span><br>
		    <span style="padding-left:30px;">Near Industrial Estate, Suryapet - 508213 </span><br>
		    <span style="padding-left:30px;">Dist. Suryapet, Talangana </span><br><br>

	    	<b>GSTIN : </b> 36AADCS4065KIZ4 <br>
	    </td>
	    <td style="width:50%;padding-left:20px;padding-top: 10px;">
	    	<b>Shipping Address</b><br><br>
	    	<span style="padding-left:30px;">Sudhakar Plastics Pvt Ltd. </span><br>
		    <span style="padding-left:30px;">D.No : 1-11-60/1, Balaram Thanda </span><br>
		    <span style="padding-left:30px;">Near Industrial Estate, Suryapet - 508213 </span><br>
		    <span style="padding-left:30px;">Dist. Suryapet, Talangana </span><br><br>

	    	<b>GSTIN : </b> 36AADCS4065KIZ4 <br>
	    </td>
	  </tr>
	</table>

	<table cellspacing="0" cellpadding="5" width="98%">
		<tr style="height:40px;background-color: #F2F3F3;">
			<td style="text-align:center;border-width:0px;color: #373435;">#</td>
			<td style="text-align:center;border-width:0px;color: #373435;">Description</td>
			<td style="text-align:center;border-width:0px;color: #373435;">HSN/SAC</td>
			<td style="text-align:center;border-width:0px;color: #373435;">Qty.</td>
			<td style="text-align:center;border-width:0px;color: #373435;">Rate/Unit</td>
			<td style="text-align:center;border-width:0px;color: #373435;">Taxable Amount</td>
			<td style="text-align:center;border-width:0px;color: #373435;">CGST</td>
			<td style="text-align:center;border-width:0px;color: #373435;">SGST</td>
			<td style="text-align:right;border-width:0px;color: #373435;">Total Amount</td>
		</tr>

		<tr>
			<td style="text-align:center;color: #727376;">1</td>
			<td style="text-align:center;color: #727376;">Polo T-Shirts</td>
			<td style="text-align:center;color: #727376;">6109</td>
			<td style="text-align:center;color: #727376;">50</td>
			<td style="text-align:center;color: #727376;">200.00</td>
			<td style="text-align:center;color: #727376;">5900.00</td>
			<td style="text-align:center;color: #727376;">5900.00 <br><sub style="color: #727376;">2.50%</sub></td>
			<td style="text-align:center;color: #727376;">5900.00 <br><sub style="color: #727376;">2.50%</sub></td>
			<td style="text-align:right;color: #727376;">5900.00</td>
		</tr>

		<tr>
			<td style="text-align:center;color: #727376;">2</td>
			<td style="text-align:center;color: #727376;">Polo T-Shirts</td>
			<td style="text-align:center;color: #727376;">6109</td>
			<td style="text-align:center;color: #727376;">50</td>
			<td style="text-align:center;color: #727376;">200.00</td>
			<td style="text-align:center;color: #727376;">5900.00</td>
			<td style="text-align:center;color: #727376;">5900.00 <br><sub style="color: #727376;">2.50%</sub></td>
			<td style="text-align:center;color: #727376;">5900.00 <br><sub style="color: #727376;">2.50%</sub></td>
			<td style="text-align:right;color: #727376;">5900.00</td>
		</tr>

		<tr>
			<td style="text-align:center;color: #727376;">3</td>
			<td style="text-align:center;color: #727376;">Polo T-Shirts</td>
			<td style="text-align:center;color: #727376;">6109</td>
			<td style="text-align:center;color: #727376;">50</td>
			<td style="text-align:center;color: #727376;">200.00</td>
			<td style="text-align:center;color: #727376;">5900.00</td>
			<td style="text-align:center;color: #727376;">5900.00 <br><sub style="color: #727376;">2.50%</sub></td>
			<td style="text-align:center;color: #727376;">5900.00 <br><sub style="color: #727376;">2.50%</sub></td>
			<td style="text-align:right;color: #727376;">5900.00</td>
		</tr>

		<tr>
			<td style="text-align:center;color: #727376;">4</td>
			<td style="text-align:center;color: #727376;">Polo T-Shirts</td>
			<td style="text-align:center;color: #727376;">6109</td>
			<td style="text-align:center;color: #727376;">50</td>
			<td style="text-align:center;color: #727376;">200.00</td>
			<td style="text-align:center;color: #727376;">5900.00</td>
			<td style="text-align:center;color: #727376;">5900.00 <br><sub style="color: #727376;">2.50%</sub></td>
			<td style="text-align:center;color: #727376;">5900.00 <br><sub style="color: #727376;">2.50%</sub></td>
			<td style="text-align:right;color: #727376;">5900.00</td>
		</tr>

		<tr style="height: 40px;">
			<td style="text-align:left;padding-left: 15px;" colspan="5"><b>TOTAL</b></td>
			<td style="text-align:center;">5900.00</td>
			<td style="text-align:center;">5900.00</td>
			<td style="text-align:center;">5900.00</td>
			<td style="text-align:right;">5900.00</td>
		</tr>

		<tr>
			<td style="text-align:left;padding-left: 15px;" colspan="6">
				<b>Bank Details : </b> Merakii Enterprises <br><br>
				<table style="border: 0px;" cellpadding="5">
					<tr>
						<td style="border:0px;">Account No : </td><td style="border:0px;">50220000311005382</td>
						<td style="border:0px;padding-left:150px;">IFSC : </td><td style="border:0px;">HDFC0001554</td>
					</tr>
					<tr>
						<td style="border:0px;">Bank Name : </td><td style="border:0px;">HDFC Bank</td>
						<td style="border:0px;padding-left:150px;">Branch : </td><td style="border:0px;">Srinagar Colony, Hyderabad</td>
					</tr>
				</table>
			</td>
			<td style="text-align:right;" colspan="2">
				<b>Taxable Amount</b> <br><br>
				<b>Total Tax</b> <br><br>
			</td>
			<td style="text-align:right;" >
				5900.00 <br><br>
				5900.00 <br><br>
			</td>
		</tr>

		<tr style="height: 40px;">
			<td style="text-align:left;padding-left: 15px;" colspan="6"><b>Total Amount (In Words) : Five Thousand Nine Hundred Rupees Only</b></td>
			<td style="text-align:right;" colspan="2"><b>Total Amount</b></td>
			<td style="text-align:right;" ><b>5900.00</b></td>
		</tr>

		<tr>
			<td style="text-align:left;padding-left: 15px;" colspan="6">
				<p>I/We hereby certify that registration certificate under the Telangana Goods and Service Tax Act. 2017</p>
				<b>Terms & Conditions</b> <br>
				<ul>
					<li>Our responsibility ceases as soon as goods delivered in your premises.</li>
			        <li>We will recognize only official receipt.</li>
			        <li>Goods once sold cannot be returned or exchanged.</li>
			        <li>Full Payment must be made to us on the presentation of the Invoice otherwise interest will be charged @18% P.A.</li>
			        <li>All disputes shall be subjected to Hyderabad jurisdiction only.</li>
			        <li>We reserved to ourselves the right to demand payment of this bill any time before due date.</li>
			        <li>All cheques /drafts to be made in favour of <b>"MERAKII ENTERPRISES"</b>, Payable at Hyderabad.</li>
			        <li>Mention the Invoice No at the back of your cheque / draft.</li>
				</ul>
			</td>
			<td style="text-align:right;" colspan="3" valign="top">
				<b style="color: #373435;">MERAKII ENTERPRISES</b>
				<p style="padding-top:100px;">Authorized Signature</p>
			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<img src="{{ asset('images/footer.png') }}" alt="Meraki Store" style="width:98%;margin-bottom: 0;"/><br><br>
</div>

</body>
</html>
