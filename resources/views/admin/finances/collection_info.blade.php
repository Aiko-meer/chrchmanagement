@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Collection</h3>
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
                <a href="/collection">Collection</a>
            </li>
          
            
            
            
            </ul>
        </div>

        


        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Collection</h4>
                                
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive"><!-- Book and Record Info -->
                                <table class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan = '2'></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td rawspan = '2'style="width: 15%"><strong>Acolyte's Names:</strong></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($collections->acolytes as $acolyte)
                                    <tr>
                                        <td style="width: 15%"><strong></strong></td>
                                        <td>{{ $acolyte->first_name }} {{ $acolyte->middle_name }}  {{ $acolyte->last_name }}</td>
                                    </tr>
                                   
                                     <br>
                                    @endforeach
                                    <tr>
                                        <td style="width: 15%"><strong>Collected On:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($collections->collection_date)->format('F j, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"><strong>Time:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($collections->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($collections->end_time)->format('h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"><strong>Money Collected:</strong></td>
                                        <td>₱{{ number_format($collections->money_amount, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <td rawspan = '2'style="width: 15%"><strong>In-kind Collected:</strong></td>
                                        <td></td>
                                    </tr>
                           
                                        @foreach ($inkinds as $inkind)
                                            <tr>
                                                <td style="width: 15%"><strong></strong></td>
                                                <td>{{ $inkind->item_name }} - {{ $inkind->pieces }}</td>
                                            </tr>
                                        @endforeach
                                 
                                           
                                    <tr>
                                            <th colspan = '2'></th>
                                            
                                        </tr>
                                    
                                    
                                    
                                   
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                  
                    </div>
                </div>
                

                
            </div>
    </div>
</div>



@include('layouts.footer')




@endsection


