@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Payment</h3>
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
                <a href="/collection">Payment</a>
            </li>
          
            
            
            
            </ul>
        </div>

       


        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Payment Record</h4>
                                
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
                                        <td rawspan = '2'style="width: 15%"><strong>Payer's Names:</strong></td>
                                        <td> {{ $payments->first_name }} {{ $payments->middle_name }}  {{ $payments->last_name }}</td>
                                    </tr>
                                    
                                   
                                   
                                     <br>
                                     <tr>
                                        <td style="width: 15%"><strong>Reason of Payment:</strong></td>
                                        <td>{{$payments->reason  }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"><strong>Amount:</strong></td>
                                        <td>₱{{ number_format($payments->amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"><strong>Payemnt Date:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($payments->payment_date)->format('F j, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"><strong>Payment Time:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($payments->payment_time)->format('h:i A') }}</td>
                                    </tr>

                                   
                                           
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


