@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Manage Booking</h3>
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
                                <h4 class="card-title">Booking Event</h4>
                               
                            </div>
                        </div>
                <ul class="nav nav-tabs" id="archiveTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="church-baptism-tab" data-bs-toggle="tab" href="#baptism" role="tab" aria-controls="baptism" aria-selected="true">Baptism </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="church-confirmation-tab" data-bs-toggle="tab" href="#confirmation" role="tab" aria-controls="confirmation" aria-selected="false">Confirmation </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="church-wedding-tab" data-bs-toggle="tab" href="#wedding" role="tab" aria-controls="wedding" aria-selected="false">Wedding </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " id="church-funeral-tab" data-bs-toggle="tab" href="#funeral" role="tab" aria-controls="funeral" aria-selected="false">funeral </a>
                    </li>
                 

                   
                    
                </ul>

    <!-- Tab Content -->
            <div class="tab-content mt-3" id="archiveTabsContent">
                <!-- Church Records Tab -->
                <div class="tab-pane fade show active" id="baptism" role="tabpanel" aria-labelledby="church-baptism-tab">
                @include('managebook.manage_baptism')
                    
                </div>
                <div class="tab-pane fade " id="confirmation" role="tabpanel" aria-labelledby="church-confirmation-tab">
                @include('managebook.manage_confirmation')
                    
                </div>
                <div class="tab-pane fade " id="wedding" role="tabpanel" aria-labelledby="church-wedding-tab">
                @include('managebook.manage_wedding')
                    
                </div>
                <div class="tab-pane fade" id="funeral" role="tabpanel" aria-labelledby="church-funeral-tab">
                @include('managebook.manage_funeral')
                    
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