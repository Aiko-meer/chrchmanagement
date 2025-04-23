@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
        <h3 class="fw-bold mb-3">Wedding Record of {{ $weddingYear }}</h3>
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
                <a href="/wedding/">Wedding</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/wedding_record/{{ $weddingID }}">Wedding Record of {{ $weddingYear }}</a>
            </li>
            
            
            
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Wedding Record Details</h5>
                
                <div class="table-responsive">
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Record Code:{{ $WeddingRecords->record_code }}  </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 15%"><strong>Groom's Name:</strong></td>
                                <td>{{ $WeddingRecords->groom_first_name }} {{ $WeddingRecords->groom_middle_name }} {{ $WeddingRecords->groom_last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Birth:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($WeddingRecords->groom_dob)->format('F j, Y') }} </td>  
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Residence</strong></td>
                                <td>{{ $WeddingRecords->groom_purok_no }}, {{ $WeddingRecords->groom_street_address }}, {{ $WeddingRecords->groom_barangay }}, {{ $WeddingRecords->groom_residence_city }}, {{ $WeddingRecords->groom_residence_province }}</td>
                            </tr>
                           
                            <tr>
                                <td style="width: 15%"><strong></strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Bride's Name:</strong></td>
                                <td>{{ $WeddingRecords->bride_first_name }} {{ $WeddingRecords->bride_middle_name }} {{ $WeddingRecords->bride_last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Birth:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($WeddingRecords->bride_dob)->format('F j, Y') }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Residence</strong></td>
                                <td>{{ $WeddingRecords->bride_purok_no }}, {{ $WeddingRecords->bride_street_address }}, {{ $WeddingRecords->bride_barangay }}, {{ $WeddingRecords->bride_residence_city }}, {{ $WeddingRecords->bride_residence_province }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%" colspan="2"><strong>Documents Presented</strong></td>
                               
                            </tr>
                            <tr>
                                <td style="width: 15%" colspan="2"><strong>{{ $WeddingRecords->document }}</strong></td>
                               
                            </tr>
                            <tr>
                                <td style="width: 15%" colspan="2"><strong></td>
                               
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
