<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>NS RES Program Invoice</title>
  <style>
    body {
        background: #FFF;
        font-family: 'Cambria', serif;
        font-size:12px;
        line-height:1.1em;
    }

    #page {
        margin: 0px auto;
        padding: 0px;
        width: 720px; /* width: 7in; */
        max-height: 1000px; /* or height: 9.5in; */
        clear: both;
        background-color: #FFF;
        page-break-after: always;
        border: 1px solid #000;
    }

    table {
        border-left: 1px solid #000;
        border-right: 1px solid #000;
    }

    #page table:first-child {
        border-top: 1px solid #000;
    }
    #page table:last-child {
        border-bottom: 1px solid #000;
    }

    table td {
        padding:3px 4px;
        vertical-align: top;
        background: #FFF;
    }

    table.bordered td {
        border: 1px solid #000;
    }

    table.bordered tr td:first-child {
        border-left:0;
    }

    table.bordered tr td:last-child {
        border-right:0;
    }

    td.centered-blue {
        text-align: center;
        color: #00d6ff;
    }

    td.seperator {
        height:0px;
        line-height: 0;
    }

    td.label {
        font-weight:bold;
        text-align:left;
    }

    td.yellow-header {
        background-color: #ffffcc;
        font-weight:bold;
        text-align:left;
        white-space: nowrap;
    }

    td.small-data {
        font-size:10px;
    }

    .burgundy {
        background-color: #7b0000;
    }

    .noborder {
        border:none !important;
    }

    .noborder td {
        border:none !important;
    }
        #page2 {
        margin: 0px auto;
        padding: 0px;
        width: 720px; /* width: 7in; */
        max-height: 1000px; /* or height: 9.5in; */
        clear: both;
        background-color: #FFF;
        page-break-after: always;
        border: 1px solid #000;
    }

    table {
        border-left: 1px solid #000;
        border-right: 1px solid #000;
    }

    #page2 table:first-child {
        border-top: 1px solid #000;
    }
    #page2 table:last-child {
        border-bottom: 1px solid #000;
    }

    table td {
        padding:3px 4px;
        vertical-align: top;
        background: #FFF;
    }

    .bordered td {
        border: 1px solid #000;
    }

    .bordered tr td:first-child {
        border-left:0;
    }

    .bordered tr td:last-child {
        border-right:0;
    }

    td.seperator {
        height:0px;
        line-height: 0;
    }

    tbody.small-border td {
        border: none;
        border-top: 1px solid #000;
        border-left: 1px solid #000;
        height: 12px;
    }

    .small-border tr:last-child td {
        border-bottom: 1px solid #000;
    }

    td.label {
        font-weight:bold;
        text-align:left;
    }

    td.underline {
        border-bottom:1px solid #555;
    }

    .grey {
        background-color: #d8d8d8;
    }

    .noborder {
        border: none !important;
    }
    input[type=date] {
        color: #00d6ff;
        text-align: center;
    }

  </style>
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
<div id="page">
    <!-- Title Section -->
    <table cellpadding="0" cellspacing="0" width="100%" >
        <tr>
            <td class="centered-blue" style="font-size:16px;" >{{ $facilityInfo->contractor_name }}</td>
        </tr>
        <tr>
            <td class="centered-blue">Contractor's Representative:   Karen Hall</td>
        </tr>
        <tr>
            <td class="centered-blue">{{ $facilityInfo->actual_date_of_discharge }}</td>
        </tr>
        <tr>
            <td class="centered-blue">Telephone:  (XXX) XXX-XXXX   Cell:  (---) --------  Facsimile:   (XXX) XXX-XXXX</td>
        </tr>
        <tr>
            <td align="center" style="padding:4px;"><a style="font-family: Arial, sans-serif; font-size: 13px;" href="mailto:npitall@keetoncorrections.com">npitall@keetoncorrections.com</a></td>
        </tr>
    </table>
    <!-- Data Table One -->
    <table cellpadding="0" cellspacing="0" width="100%" class="bordered" >
        <tr>
            <td colspan="4" class="burgundy separator"></td>
        </tr>
        <tr>
            <td class="label" style="width:30%;">Month of Service Delivery:</td><td class="centered-blue" style="width:15%;">{{ $monthOfServiceDelivery }}</td>
            <td class="label">INV#:</td><td class="centered-blue" style="width: 20%;">{{ $invoiceNumber }}</td>
        </tr>
        <tr>
            <td class="label">Contract Number:</td><td class="centered-blue">{{ $facilityInfo->contract_number }}</td>
            <td class="label">FEIN#</td><td class="centered-blue">{{ $facilityInfo->fein_number }}</td>
        </tr>
        <tr>
            <td class="label">Total # of Days in Month:</td><td class="centered-blue">{{ $daysInMonth }}</td>
            <td class="label">Complete Invoice Date</td><td class="centered-blue"><input type="date"></td>
            <!--To be entered by Contract Manager-->
        </tr>
        <tr>
            <td colspan="4" class="burgundy separator"></td>
        </tr>
        <tr>
            <td class="label">Maximum Nonsecure Bed Days:</td><td class="centered-blue">{{ $facilityInfo->max_annual_bed_days }}</td>
            <td class="label">Cumulative Nonsecure Bed Days YTD:</td><td class="centered-blue">{{ $manDaysFY }}</td>
        </tr>
        <tr>
            <td class="label">Maximum Dual Diagnosis Bed Days:</td><td class="centered-blue">n/a</td>
            <td class="label">Cumulative Dual Diagnosis Bed Days YTD:</td><td class="centered-blue">n/a</td>
        </tr>
        <tr>
            <td colspan="4" class="burgundy separator"></td>
        </tr>
        <tr>
            <td class="label">Total Allocation:</td><td class="centered-blue">$ {{$totalAllocation}} </td>
            <td class="label">Contract Term:</td><td class="centered-blue">{{$contractTerm}}</td>
        </tr>
        <tr>
            <td class="label">Total Previously Paid Out:</td><td class="centered-blue">${{$totalPaid}}</td>
            <td class="label">Amendment:</td><td class="centered-blue">5</td>
        </tr>
        <tr>
            <td colspan="4" class="burgundy separator" ></td>
        </tr>
    </table>
    <!-- Service Table -->
    <table cellpadding="0" cellspacing="0" width="100%" class="bordered" >
        <tr>
            <td></td>
            <td class="yellow-header">Type of Service</td>
            <td class="yellow-header">Allowable Costs</td>
            <td class="yellow-header">Qualifiers</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Total Occupied Nonsecure Bed Days in Billing Month</td>
            <td align="right" style="width: 15%;">$ {{ number_format($facilityInfo->per_diem * $totalBedDaysForMonth, 2, '.', ',') }}</td>
            <td class="small-data" style="width: 55%;">This is a fixed rate Contract.  DC will only pay for the date of admission; not the date of discharge.  DC will compensate the Contractor on a monthly basis in accordance with the rates in the Compensation section for Nonsecure Residential Beds.  (Per Diem Rate * Per Occupied Bed * Number of Days).  DC may decrease the number of beds at its exclusive option.</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Total Occupied Co-occurring Disorder Overlay Services in Billing Month</td>
            <td align="right">$ -</td>
            <td class="small-data">This is a fixed rate Contract.  DC will only pay for the date of admission; not the date of discharge.  DC will compensate the Contractor on a monthly basis in accordance with the rates in the Compensation section for Co-occurring Disorder Overlay Services.  (Per Diem Rate * Per Occupied Bed * Number of Days).  DC may decrease the number of beds at its exclusive option.</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Total Naltrexone in Billing Month</td>
            <td align="right">$ -</td>
            <td class="small-data">DC will compensate the Contractor for services as specified in Section II., I., 5. Medication-Assisted Treatment Services and will accordance with the rates in the Compensation section of this Contract.  Naltrexone Screening/Procedure will include Administrative Oversight, Physical Lab Work and Medication Education.  Administration of Single Dose of Medication will include Medication Management by the Physician, Medication Administration by the Nurse, Lab Work and Medication. (Unit Rate, Per Offender, Per Service)</td>
        </tr>
        <tr>
            <td colspan="4" class="burgundy separator noborder"></td>
        </tr>
        <tr class="burgundy" >
            <td colspan="2" >Balance on Contract Agreement:</td><td align="right">$ {{ $balance }}</td><td class="burgundy noborder"></td>
        </tr>
        <tr class="burgundy" >
            <td colspan="2">Percentage of Funds Expended:</td><td align="right">{{ $expended }}%</td><td class="burgundy noborder"></td>
        </tr>
        <tr>
            <td colspan="4" class="burgundy separator noborder"></td>
        </tr>
        <tr>
            <td class="centered-blue">{{ $veteran }}</td><td colspan="3">During this invoice period did you utilize any minority/service-disabled veteran vendor?  If yes, please attach appropriate documentation.</td>
        </tr>
        <tr>
            <td class="centered-blue">{{ $pride }}</td><td colspan="3">During this invoice period did you purchase all items required to carry out this Contract from PRIDE or RESPECT?  If yes, please attach appropriate documentation.  If no, please provide an explanation.</td>
        </tr>
        <tr>
            <td class="centered-blue">{{ $paid }}</td><td colspan="3">Have you paid all sub-contractors for the previous billing month?</td>
        </tr>
        <tr>
            <td colspan="4" class="burgundy separator"></td>
        </tr>
    </table>
    <!-- Fine Print -->
    <table cellpadding="0" cellspacing="0" width="100%" class="bordered" >
        <tr>
            <td style="font-style:italic; border-bottom:0;">The contractor agrees to submit invoices monthly within 30 calendar days following the end of the month services were provided.  The request for compensation will be in sufficient  detail for a pre- or post-audit.  The invoices shall have attached the applicable Monthly Reports which will include detail of services rendered for proper invoicing.  </td>
        </tr>
        <tr>
            <td style="font-weight:bold; border-top:0; border-bottom:0">I certify, under penalty of perjury, that the aforesaid listing is true and correct, that requested reimbursements are for actual cost incurred, that our agency has complied with all provisions of the above referenced Agreement, including terms and conditions of procurement, and that the supporting documentation submitted is sufficient for a proper pre-audit and post-audit thereof and is available for review upon request.</td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="100%" >
        <tr>
            <td style="padding-left:20px; height:16px"></td>
            <td style="padding-left:20px;"></td>
        </tr>
        <tr>
            <td style="font-style:italic; padding-left:20px; width:50%; border-top:2px solid #000">Chief Administrative Officer or Designee</td>
            <td style="font-style:italic; padding-left:20px; border-top:2px solid #000">Date</td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="100%" class="bordered" >
        <tr>
            <td style="font-style:italic; border-bottom:0; border-top:2px solid #000;">I certify that I am the Contract Manager or designee and the provided information is true and correct; the goods and services have been satisfactorily received and payment is now due.  I understand that the office of the State Chief Financial Officer reserves the right to require additional documentation and/or conduct periodic post-audits of any agreements.</td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="100%" >
        <tr>
            <td style="padding-left:20px; height:16px"></td>
            <td style="padding-left:20px;"></td>
        </tr>
        <tr>
            <td style="font-style:italic; padding-left:20px; width:50%; border-top:2px solid #000">Contract Manager or Designee</td>
            <td style="font-style:italic; padding-left:20px; border-top:2px solid #000">Date</td>
        </tr>
    </table>
</div>
<div id="page2">
    <!-- Title Section -->
    <table cellpadding="0" cellspacing="0" width="100%" >
        <tr>
            <td style="font-size:16px;" >Detailed Monthly Performance Report - NS</td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="100%" >
        <tr>
            <td colspan="3" class="separator"></td>
        </tr>
        <tr>
            <td style="width:50px;">Program:</td><td class="underline" style="width: 250px;">{{ $facilityInfo->contractor_name }}</td><td></td>
        </tr>
        <tr>
            <td colspan="9" class="separator"></td>
        </tr>
        <tr>
            <td>Location:</td><td class="underline">{{ $facilityInfo->facility_name }}</td><td></td>
        </tr>
        <tr>
            <td colspan="3" class="separator"></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="100%" >
        <thead class="bordered">
            <tr>
                <td class="label grey">#</td>
                <td class="label grey">DC#</td>
                <td class="label grey">Offender Name</td>
                <td class="label grey" style="width:75px;">Entry Date</td>
                <td class="label grey" style="width:75px;">ERC Entry Date</td>
                <td class="label grey" style="width:75px;">Exit Date</td>
                <td class="label grey">Discharge<br>Code ***</td>
                <td class="label grey">Bed Days<br>for Month</td>
                <td class="label grey">Comments</td>
            </tr>
        </thead>
        <tbody class="small-border">
            <!-- start foreach -->
            @foreach($residents as $resident)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $resident->document_number }}</td>
                <td>{{ $resident->last_name }}, {{ $resident->first_name }}</td>
                <td>{{ $resident->date_of_admission }}</td>
                <td>{{ $resident->date_of_admission }}</td>
                <td>
                    @if($resident->actual_date_of_discharge != null &&
                                \Carbon\Carbon::parse($resident->actual_date_of_discharge)->lessThanOrEqualTo(
                                    \Carbon\Carbon::createFromDate($year, $month)->endOfMonth()))
                            {{ \Carbon\Carbon::parse($resident->actual_date_of_discharge)->format('m-d-Y') }}
                    @endif
                </td>
                <td>
                    @if($resident->status_at_discharge == 'Administrative')
                        A
                    @elseif($resident->status_at_discharge == 'Successful')
                        S
                    @elseif(preg_match('/Unsuccessful*/', $resident->status_at_discharge))
                        U
                    @endif
                </td>
                <td>{{ App\Resident::calculateManDaysForMonth($year, $month, $resident) }}</td>
                <td></td>
            </tr>
            @endforeach
            <!-- end foreach -->
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td colspan="5" class="noborder">***Discharge Codes:  S=Successful  U=Unsuccessful  A=Administrative  T=Transfer</td>
                <td class="label grey" style="border:1px solid #000; border-top:0; border-right:0;">Bed Days Total</td>
                <td style="border:1px solid #000; border-top:0;">{{ $totalBedDaysForMonth }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="9" class="separator" style="height:30px;"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="border-top:1px solid #000">Authorized Signature</td>
                <td style="border-top:1px solid #000">Date</td>
                <td align="right">Per Diem</td>
                <td style="border-bottom: 1px solid #000">${{ number_format($facilityInfo->per_diem, 2, '.', ',')}} </td>
                <td align="center">=</td>
                <td style="border:1px solid #000">${{ number_format($facilityInfo->per_diem * $totalBedDaysForMonth, 2, '.', ',') }}</td>
                <td>TOTAL</td>
            </tr>
            <tr>
                <td colspan="9" class="separator"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="8">This report documents services rendered to offenders and is to be submitted with the monthly invoice.</td>
            </tr>
            <tr>
                <td colspan="9" class="separator"></td>
            </tr>
            <tr>
                <td></td><td colspan="2" style="width:50px;">Verified by:</td><td colspan="3" class="underline" style="width: 250px;"></td><td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="9" class="separator"></td>
            </tr>
            <tr>
                <td></td><td colspan="2">Printed Name:</td><td colspan="3" class="underline"></td><td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="9" class="separator"></td>
            </tr>
            <tr>
                <td></td><td colspan="2">Title:</td><td colspan="3" class="underline"></td><td colspan="4"></td>
            </tr>
            <tr>
                <td colspan="9" class="separator"></td>
            </tr>
            <tr>
                <td colspan="9" class="separator"></td>
            </tr>
        </tfoot>
    </table>
</div>
</body>
</html>