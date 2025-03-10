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
                                <h4 class="card-title">Archived folder of {{ $year}}</h4>
                               
                            </div>
                        </div>
                <ul class="nav nav-tabs" id="archiveTabs" role="tablist">
                   
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="church-wedding-tab" data-bs-toggle="tab" href="#wedding" role="tab" aria-controls="wedding" aria-selected="false">Wedding Records</a>
                    </li>
                    

                    
                    
                </ul>

    <!-- Tab Content -->
            <div class="tab-content mt-3" id="archiveTabsContent">
                <!-- Church Records Tab -->
                
                <div class="tab-pane fade show active" id="wedding" role="tabpanel" aria-labelledby="church-wedding-tab">
                    <div class="card-body">
                        <h3 class="card-title">Wedding Folder</h3>
                        <div class="table-responsive">
                                                    <table
                                                    id="wedding-row"
                                                    class="display table table-striped table-hover"
                                               
                                                    >
                                                    <thead>
                                                        <tr>
                                                            <th> Month</th>
                                                            <th>No. Weddings</th>
                                                            
                                                            <th style="width: 10%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th> Month</th>
                                                            <th>No. Weddings</th>
                                                            
                                                            <th style="width: 10%">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        @foreach($WeddingrecordCounts as $wedding)
                                                            <tr>
                                                            <td><i class="fas fa-book"> - </i> {{ $wedding['month'] }}</td>
                                                                <td>{{ $wedding['wedding_count'] }} Total numbers of Wedding</td>
                                                                <td>
                                                                    <div class="form-button-action">
                                                                        <button
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title="Edit Task"
                                                                            class="btn btn-link btn-primary btn-lg"
                                                                            data-original-title="Edit Task"
                                                                            onclick="window.location.href='/wedding_record_archived/{{ $wedding['id'] }}'"
                                                                        >
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                        <button
                                                                            type="button"
                                                                            data-bs-toggle="tooltip"
                                                                            title="Move to Archive"
                                                                            class="btn btn-link btn-danger"
                                                                            data-original-title="Remove"
                                                                            onclick="window.location.href='/weddingfolder/archive/{{ $wedding['id'] }}'"
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
               

                <!-- Members Tab -->
               

                
            </div>
</div>
</div>
</div>
</div>
</div>



@include('layouts.footer')
@endsection