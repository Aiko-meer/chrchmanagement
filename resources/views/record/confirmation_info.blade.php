@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Confirmands Information</h3>
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
                    <a href="/confirmation">Confirmation of {{ $confirmationYear }} Records</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/confirmation/{{  $confirmationID }}">Confirmands Information</a>
                </li>
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Confirmands Record Details</h5>
                <div class="d-flex align-items-center">
                                <h5 class="card-title"></h5>
                                <a
                                    href="{{ url('confirmation_certificate/' . $confirmationRecord->id) }}"
                                    class="btn btn-secondary btn-round ms-auto"
                                >
                                    <i class="fa fa-eye"></i>
                                    View Certificate
                                </a>
                            </div>
                            <br>
                <div class="table-responsive"><!-- Book and Record Info -->
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th colspan = '2'>Page No: {{ $confirmationRecord->page_no }}/Record Code: {{ $confirmationRecord->record_code }}/Series Year No: {{ $confirmationRecord->series_year_no }} </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="width: 15%"><strong>Name:</strong></td>
                            <td>{{ $confirmationRecord->child_first_name }} {{ $confirmationRecord->child_middle_name }} {{ $confirmationRecord->child_last_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Date of Birth:</strong></td>
                            <td>{{ $confirmationRecord->child_dob }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Place of Birth:</strong></td>
                            <td>{{ $confirmationRecord->child_city }}, {{ $confirmationRecord->child_province }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Father's Name:</strong></td>
                            <td>{{ $confirmationRecord->father_first_name }} {{ $confirmationRecord->father_middle_name }} {{ $confirmationRecord->father_last_name }}</td>
                        </tr>
                        
                        <tr>
                            <td style="width: 15%"><strong>Mother's Name:</strong></td>
                            <td>{{ $confirmationRecord->mother_first_name }} {{ $confirmationRecord->mother_middle_name }} {{ $confirmationRecord->mother_last_name }}</td>
                        </tr>
                        
                        <tr>
                            <td style="width: 15%"><strong>Residence:</strong></td>
                            <td>{{ $confirmationRecord->purok_no }},{{ $confirmationRecord->street_address }},{{ $confirmationRecord->barangay }},{{ $confirmationRecord->residence_city }}, {{ $confirmationRecord->residence_province }}</td>
                        </tr>
                        
                        <tr>
                            <td colspan = '2'><strong>Sponsors</strong></td>
                            
                        </tr>

                    
                            <tr>
                                <td style="width: 15%"><strong>Sponsor's Name:</strong></td>
                                <td> {{ $confirmationRecord->godparent_first_name }} {{ $confirmationRecord->godparent_middle_name }} {{ $confirmationRecord->godparent_last_name }}</td>
                            </tr>
                            
                        
                        <tr>
                            <td style="width: 15%"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Priest/Minister</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Date of Confirmation</strong></td>
                            <td>{{ $confirmationRecord->confirmation_date}}</td>
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
