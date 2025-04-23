@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">All Record</h3>
            <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="/">
                <i class="icon-home"></i>
                </a>
            </li>
            
          
            
            
            
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">All Record</h4>
                               
                            </div>
                        </div>
                <ul class="nav nav-tabs" id="archiveTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="church-baptism-tab" data-bs-toggle="tab" href="#baptism" role="tab" aria-controls="baptism" aria-selected="true">Record</a>
                    </li>
                   
                    
                </ul>

    <!-- Tab Content -->
            <div class="tab-content mt-3" id="archiveTabsContent">
                <!-- Church Records Tab -->
                <div class="tab-pane fade show active" id="baptism" role="tabpanel" aria-labelledby="church-baptism-tab">
                    <div class="mb-3">
                        <input type="text" id="search-input" class="form-control" placeholder="Search records...">
                    </div>
<div class="card-body">
    <h3 class="card-title">Baptisms Record</h3>
        <div class="table-responsive">
            <table id="baptisms-table" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%">Name</th>
                        <th style="width: 45%">Baptism Date</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($baptism as $baptism)
                        <tr>
                            <td>{{ $baptism->child_first_name }} {{ $baptism->child_middle_name }} {{ $baptism->child_last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($baptism->baptism_date)->format('m/d/Y') }}</td>
                            <td>
                                
                                    <div class="form-button-action">
                                    <a href="{{ route('book.record.info', $baptism->id) }}" type="button" data-bs-toggle="tooltip" title="View Baptism Record" class="btn btn-link btn-primary btn-lg">
                                      <i class="fas fa-eye"></i>
                                  </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  
    <div class="separator" style="border-top: 2px solid #ddd; margin: 20px 0;"></div>
    <div class="card-body">
    <h3 class="card-title">Confirmation Record</h3>
        <div class="table-responsive">
            <table id="books-table" class="display table table-striped table-hover">
                <thead>
                    <tr>
                     
                        <th style="width: 5%">#</th>
                        <th style="width: 15%">Record Code</th>
                        <th style="width: 40%">Name of Confirmands</th>
                        <th>Date of Confirmation</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($confirmation as $index => $con)
                        <tr>
                         
                            <td>{{ $index + 1 }}</td>
                                      <td>{{ $con->record_code }}</td>
                                      <td>{{ $con->child_first_name }} {{ $con->child_middle_name }} {{ $con->child_last_name }}</td>
                                      <td>{{ \Carbon\Carbon::parse($con->confirmation_date)->format('m/d/Y') }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('confirmation.info', $con->id) }}" type="button" data-bs-toggle="tooltip" title="View Confirmation Record" class="btn btn-link btn-primary btn-lg">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="separator" style="border-top: 2px solid #ddd; margin: 20px 0;"></div>
    <div class="card-body">
    <h3 class="card-title">Wedding Record</h3>
        <div class="table-responsive">
            <table id="records-table" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 15%">Record Code</th>
                        <th style="width: 40%">Name of Couple</th>
                        <th>Date of Wedding</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wedding as $index => $wed)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $wed->record_code }}</td>
                            <td>{{ $wed->groom_first_name }} {{ $wed->groom_middle_name }} {{ $wed->groom_last_name }}  <br>
                              {{ $wed->bride_first_name }} {{ $wed->bride_middle_name }} {{ $wed->bride_last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($wed->wedding_date)->format('m/d/Y') }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('wedding.info', $wed->id) }}" type="button" data-bs-toggle="tooltip" title="View Wedding Record" class="btn btn-link btn-primary btn-lg">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                   
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
                    
                </div>
               
                
            </div>
</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search-input').on('keyup', function () {
            let searchValue = $(this).val();

            $.ajax({
                url: "{{ route('allrecord.index') }}", // Ensure this route exists
                method: "GET",
                data: { search: searchValue },
                success: function (data) {
                    // Replace individual table bodies instead of all <tbody> elements
                    $('#baptisms-table tbody').html($(data).find('#baptisms-table tbody').html());
                    $('#books-table tbody').html($(data).find('#books-table tbody').html());
                    $('#records-table tbody').html($(data).find('#records-table tbody').html());
                }
            });
        });
    });
</script>




@include('layouts.footer')
@endsection