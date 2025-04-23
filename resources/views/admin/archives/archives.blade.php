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
                                <h4 class="card-title">Archived</h4>
                               
                            </div>
                        </div>
                <ul class="nav nav-tabs" id="archiveTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="church-baptism-tab" data-bs-toggle="tab" href="#baptism" role="tab" aria-controls="baptism" aria-selected="true">Baptism Record</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="church-confirmation-tab" data-bs-toggle="tab" href="#confirmation" role="tab" aria-controls="confirmation" aria-selected="false">Confirmation Records</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="church-wedding-tab" data-bs-toggle="tab" href="#wedding" role="tab" aria-controls="wedding" aria-selected="false">Wedding Records</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="church-funeral-tab" data-bs-toggle="tab" href="#funeral" role="tab" aria-controls="funeral" aria-selected="false">funeral Records</a>
                    </li>
                 

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="members-tab" data-bs-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="false">Members</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="finance-tab" data-bs-toggle="tab" href="#finance" role="tab" aria-controls="finance" aria-selected="false">Finance</a>
                    </li>
                    
                </ul>

    <!-- Tab Content -->
            <div class="tab-content mt-3" id="archiveTabsContent">
                <!-- Church Records Tab -->
                <div class="tab-pane fade show active" id="baptism" role="tabpanel" aria-labelledby="church-baptism-tab">
                @include('archives.archived_baptism')
                    
                </div>
                <div class="tab-pane fade " id="confirmation" role="tabpanel" aria-labelledby="church-confirmation-tab">
                @include('archives.archived_confirmation')
                    
                </div>
                <div class="tab-pane fade " id="wedding" role="tabpanel" aria-labelledby="church-wedding-tab">
                @include('archives.archived_wedding')
                    
                </div>
                <div class="tab-pane fade" id="funeral" role="tabpanel" aria-labelledby="church-funeral-tab">
                @include('archives.archived_funeral')
                    
                </div>

                <!-- Members Tab -->
                <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="members-tab">
                    <!-- Display Members Archive -->
                    @include('archives.archived_member')
                </div>

                <!-- Finance Tab -->
                <div class="tab-pane fade" id="finance" role="tabpanel" aria-labelledby="finance-tab">
                    <!-- Display Finance Archive -->
                    @include('archives.archived_finance')
                </div>

                
            </div>
</div>
</div>
</div>
</div>
</div>



@include('layouts.footer')
@endsection