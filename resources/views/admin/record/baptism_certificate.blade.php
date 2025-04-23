@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Baptised Information</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="/">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/baptism">Baptism</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/book/">Baptism Book of  Records</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/book_record/">Baptism Book No.  of  Records</a>
                </li>
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Baptism Certificate of {{ $bookRecord->child_first_name }} {{ $bookRecord->child_middle_name }} {{ $bookRecord->child_last_name }} </h5>
                <div class="d-flex align-items-center">
                                <h5 class="card-title"></h5>
                                <a
                                    href="{{ url('baptism_print/' . $bookRecord->id) }}"
                                    class="btn btn-danger btn-round ms-auto"
                                >
                                    <i class="fa fa-print"></i>
                                    Print Certificate
                                </a>
                            </div>
                <div class="certificate" id="certificate">
        <div class="header">
            <h2>OUR LADY OF PEACE AND GOOD VOYAGE PARISH</h2>
            <p>Tugbungan, Zamboanga City, Philippines</p>
            <p>Archdiocese of Zamboanga</p>
        </div>

        <h1>Certificate of Baptism</h1>

        <table class="info-table">
            <tr>
                <td>Name:</td>
                <td>{{ $bookRecord->child_first_name }} {{ $bookRecord->child_middle_name }} {{ $bookRecord->child_last_name }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
		
            </tr>

            <tr>
                <td>Date of Birth:</td>
                <td>{{ $bookRecord->child_dob }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Place of Birth:</td>
                <td>{{ $bookRecord->child_city }}, {{ $bookRecord->child_province }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Father:</td>
                <td>{{ $bookRecord->father_first_name }} {{ $bookRecord->father_middle_name }} {{ $bookRecord->father_last_name }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Place of Birth:</td>
                <td>{{ $bookRecord->father_city }}, {{ $bookRecord->father_province }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Mother:</td>
                <td>{{ $bookRecord->mother_first_name }} {{ $bookRecord->mother_middle_name }} {{ $bookRecord->mother_last_name }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Place of Birth:</td>
                <td>{{ $bookRecord->mother_city }}, {{ $bookRecord->mother_province }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Residence:</td>
                <td>{{ $bookRecord->residence_city }}, {{ $bookRecord->residence_province }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
        </table>

        <h2 class="section-title">Sponsors</h2>
        <table class="sponsor-table">
        @foreach($godparents as $godparent)
            <tr>
                <td>{{ $godparent->first_name }} {{ $godparent->middle_name }} {{ $godparent->last_name }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:black;background-color:black"></td>
                <td>{{ $godparent->municipality_city }}, {{ $godparent->province }}<hr style="width:100%;text-align:right;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
        @endforeach
        @for($i = count($godparents); $i < 3; $i++)
        <tr>
            <td>&nbsp;
                <hr style="width:100%;text-align:left;margin-left:0; margin: 20px 0 0 0px;height:1px;border-width:0;color:gray;background-color:black">
            </td>
            <td>&nbsp;
                <hr style="width:100%;text-align:right;margin-left:0; margin: 20px 0 0 0px;height:1px;border-width:0;color:gray;background-color:black">
            </td>
        </tr>
       
        @endfor
        
           
        </table>
        

        <div class="priest-section">
            <p>Priest/Minister: </p><div style="width: 25%; height: 1px; background-color: black; margin: -20px 0 0 120px;"></div>
            <p>Date of Baptism: </p><div style="width: 25%; height: 1px; background-color: black; margin: -20px 0 0 120px;"></div><br>
            <p>REFERENCE:</p><div style="width: 25%; height: 1px; background-color: black; margin: -20px 0 0 120px;"></div>
            <table class="info-table">
                <tr>
                    <td>Book No: </td>
                    <td>{{ $bookRecord->book_no }}<div style="width: 25%; height: 1px; background-color: black; margin: -5px 0 0 -60px;"></div></td>
                </tr>
                <tr>
                    <td>Page No:</td>
                    <td>{{ $bookRecord->page_no }}<div style="width: 25%; height: 1px; background-color: black; margin: -5px 0 0 -60px;"></div></td>
                </tr>
                <tr>
                    <td>Line No:</td>
                    <td> 0<div style="width: 25%; height: 1px; background-color: black; margin: -5px 0 0 -60px;"></div></td>
                </tr>
                <tr>
                    <td>Series:</td>
                    <td>{{ $bookRecord->series_year_no }}<div style="width: 25%; height: 1px; background-color: black; margin: -5px 0 0 -60px;"></div></td>
                </tr>
                
            </table>
<div class="signature">
            Certified True and Correct:<br>
<br>

            <span class="underline">MSGR. A.P. SEBASTIAN</span><br>
            Parish Priest
        </div>
        <p>Issued By: 

        </p>
        <div style="width: 25%; height: 1px; background-color: black; margin: -15px 0 0 80px;"></div>

        <p style="position: relative; margin: 0;">
    Date: 
     
      
    </p><div style="width: 25%; height: 1px; background-color: black; margin: -5px 0 0 80px;"></div>
<br>
    <p style="position: relative; margin: 0;">
    Notanda: 
     
      
    </p><div style="width: 85%; height: 1px; background-color: black; margin: -5px 0 0 80px;"></div>
    <div style="width: 85%; height: 1px; background-color: black; margin: 21px 0 0 80px;"></div>
    <br>

    <br>
        <div class="small-text">
            This certification is not valid if it does not bear the official seal of the parish,
            or if it has marks of erasures or alterations of any entry.
        </div>
    </div>
        </div>
           
                
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
