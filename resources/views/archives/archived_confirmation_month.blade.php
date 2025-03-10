@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Archive</h3>
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
                                <h4 class="card-title">Archived folder of {{ $year }}</h4>
                               
                            </div>
                        </div>
                <ul class="nav nav-tabs" id="archiveTabs" role="tablist">
                  
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="church-confirmation-tab" data-bs-toggle="tab" href="#confirmation" role="tab" aria-controls="confirmation" aria-selected="true">Confirmation Records</a>
                    </li>
                   
                    
                </ul>

    <!-- Tab Content -->
            <div class="tab-content mt-3" id="archiveTabsContent">
                <!-- Church Records Tab -->
               
                <div class="tab-pane fade show active" id="confirmation" role="tabpanel" aria-labelledby="church-confirmation-tab">
                
<div class="card-body">
    <div class="table-responsive">
            <table
            id="confirmation-table"
            class="display table table-striped table-hover"
        
            >
                <thead>
                    <tr>
                    <th> Month</th>
                    <th>No. Confirmed Record</th>
                    
                    <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th> Month</th>
                    <th>No. Confirmed Record</th>
                    
                    <th style="width: 10%">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($ConfirmationrecordCounts as $confirmation)
                        <tr>
                        <td><i class="fas fa-book"> - </i> {{ $confirmation['month'] }}</td>
                            <td>{{ $confirmation['funeral_count'] }} Total Confirmation Record of {{ $confirmation['month'] }} </td>
                            <td>
                                <div class="form-button-action">
                                    <button
                                        type="button"
                                        data-bs-toggle="tooltip"
                                        title="Edit Task"
                                        class="btn btn-link btn-primary btn-lg"
                                        data-original-title="Edit Task"
                                        onclick="window.location.href='/confirmation_record_archive/{{ $confirmation['id'] }}'"
                                    >
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button
                                        type="button"
                                        data-bs-toggle="tooltip"
                                        title="Move to Archive"
                                        class="btn btn-link btn-danger"
                                        data-original-title="Move to Archive"
                                        onclick="window.location.href='/confirmationfolder/archive/{{ $confirmation['id'] }}'"
                                        
                                    >
                                        <i class="fas fa-archive"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    
   
    

                            <!-- Modal -->
                         
    
                           
                            </div>
                    
                </div>
              
               

                <!-- Members Tab -->
                
                <!-- Finance Tab -->
             

                
            </div>
</div>
</div>
</div>
</div>
</div>



@include('layouts.footer')
@endsection