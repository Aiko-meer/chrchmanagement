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
                    <a href="/book/{{ $baptismID }}">Baptism Book of {{ $baptismYear }} Records</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/book_record/{{ $bookFolder->id }}">Baptism Book No. {{ $bookFolder->book_number }} of {{ $baptismYear }} Records</a>
                </li>
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
      
                <div class="d-flex align-items-center">
                                <h5 class="card-title">Baptism Record Details</h5>
                                <a
                                    href="{{ url('baptism_certificate/' . $bookRecord->id) }}"
                                    class="btn btn-secondary btn-round ms-auto"
                                >
                                    <i class="fa fa-eye"></i>
                                    View Certificate
                                </a>
                            </div>
         
                <div class="table-responsive"><!-- Book and Record Info -->
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th colspan = '2'>Book No: {{ $bookRecord->book_no }}/Page No: {{ $bookRecord->page_no }}/Record Code: {{ $bookRecord->record_code }}/Series Year No: {{ $bookRecord->series_year_no }} </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="width: 15%"><strong>Name:</strong></td>
                            <td>{{ $bookRecord->child_first_name }} {{ $bookRecord->child_middle_name }} {{ $bookRecord->child_last_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Date of Birth:</strong></td>
                            <td>{{ $bookRecord->child_dob }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Place of Birth:</strong></td>
                            <td>{{ $bookRecord->child_city }}, {{ $bookRecord->child_province }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Father's Name:</strong></td>
                            <td>{{ $bookRecord->father_first_name }} {{ $bookRecord->father_middle_name }} {{ $bookRecord->father_last_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Place of Birth:</strong></td>
                            <td>{{ $bookRecord->father_city }}, {{ $bookRecord->father_province }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Mother's Name:</strong></td>
                            <td>{{ $bookRecord->mother_first_name }} {{ $bookRecord->mother_middle_name }} {{ $bookRecord->mother_last_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Place of Birth:</strong></td>
                            <td>{{ $bookRecord->mother_city }}, {{ $bookRecord->mother_province }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Residence:</strong></td>
                            <td>{{ $bookRecord->residence_city }}, {{ $bookRecord->residence_province }}</td>
                        </tr>
                        
                        <tr>
                            <td colspan = '2'><strong>Sponsors</strong></td>
                            
                        </tr>

                        @foreach($godparents as $godparent)
                            <tr>
                                <td style="width: 15%"><strong>Sponsor's Name:</strong></td>
                                <td> {{ $godparent->first_name }} {{ $godparent->middle_name }} {{ $godparent->last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Address:</strong></td>
                                <td>{{ $godparent->municipality_city }}, {{ $godparent->province }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="width: 15%"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Priest/Minister</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Date of Baptism</strong></td>
                            <td>{{ $bookRecord->baptism_date}}</td>
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
