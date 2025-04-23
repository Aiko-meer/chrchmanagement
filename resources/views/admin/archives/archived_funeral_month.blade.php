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
                                <h4 class="card-title">Archived by {{$year}} </h4>
                               
                            </div>
                        </div>
                <ul class="nav nav-tabs" id="archiveTabs" role="tablist">
                   
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="church-funeral-tab" data-bs-toggle="tab" href="#funeral" role="tab" aria-controls="funeral" aria-selected="false">funeral Records</a>
                    </li>
                 

                   
                </ul>

    <!-- Tab Content -->
            <div class="tab-content mt-3" id="archiveTabsContent">
                <!-- Church Records Tab -->
               
                <div class="tab-pane fade show active" id="funeral" role="tabpanel" aria-labelledby="church-funeral-tab">
                    <div class="card-body">
                        
                        <h3 class="card-title">Funeral Folder</h3>
                                                <div class="table-responsive">
                                                    <table
                                                    id="add-row"
                                                    class="display table table-striped table-hover"
                                               
                                                    >
                                                    <thead>
                                                        <tr>
                                                            <th> Year</th>
                                                            <th>No. Funeral Records</th>
                                                            
                                                            <th style="width: 10%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th> Year</th>
                                                            <th>No. Funeral Records</th>
                                                            
                                                            <th style="width: 10%">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        @foreach($FuneralrecordCounts as $funeral)
                                                            <tr>
                                                            <td><i class="fas fa-book"> - </i> {{ $funeral['month'] }}</td>
                                                                <td>{{ $funeral['funeral_count'] }} Total Funeral Record of {{ $funeral['year'] }} </td>
                                                                <td>
                                                                    <div class="form-button-action">
                                                                        <button
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title="Edit Task"
                                                                            class="btn btn-link btn-primary btn-lg"
                                                                            data-original-title="Edit Task"
                                                                            onclick="window.location.href='/funeral_record_archived/{{ $funeral['id'] }}'"
                                                                        >
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                        <button
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title="Move to Archive"
                                                                            class="btn btn-link btn-danger"
                                                                            data-original-title="Remove"
                                                                            onclick="window.location.href='/funeralfolder/archive/'"
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
                                                <div class="separator" style="border-top: 2px solid #ddd; margin: 20px 0;"></div>
                        
                                               
                    
                </div>

               
                
            </div>
</div>
</div>
</div>
</div>
</div>



@include('layouts.footer')
@endsection