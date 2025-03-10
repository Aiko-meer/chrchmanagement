@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Funeral Record of </h3>
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
                <a href="/funeral">Funeral</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/funeral_record">Funeral Record of  </a>
            </li>
            
            
            
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Funeral Record Details</h5>
                
                <div class="table-responsive">
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Record Code: {{ $funeralRecord->record_code }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 15%"><strong>Name of Deceased:</strong></td>
                                <td>{{ $funeralRecord->first_name }} {{ $funeralRecord->middle_name }} {{ $funeralRecord->last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Birth:</strong></td>
                                <td>{{ $funeralRecord->dob }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Death:</strong></td>
                                <td>{{ $funeralRecord->dod }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Funeral:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($funeralRecord->funeral_date)->format('m/d/Y') }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Contact of Relative:</strong></td>
                                <td>{{ $funeralRecord->contact }}</td>
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
