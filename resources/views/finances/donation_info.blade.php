@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Donations</h3>
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
                <a href="/donation">Donations</a>
            </li>
          
            
            
            
            </ul>
        </div>

        


        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Donation</h4>
                               
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
                                        <td style="width: 15%"><strong>Type of Donation:</strong></td>
                                        <td>{{ $donations->type}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"><strong>Cash Amount:</strong></td>
                                        <td>{{ $donations->cash_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%"><strong>In Kind:</strong></td>
                                        <td>{{ $donations->inkind_details}}</td>
                                    </tr>
                                    <tr>
                                            <th colspan = '2'></th>
                                            
                                        </tr>
                                    <tr>
                                        <td rawspan = '2'style="width: 15%"><strong>Donor's Names:</strong></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($donations->donors as $donor)
                                    <tr>
                                        <td style="width: 15%"><strong></strong></td>
                                        <td>{{ $donor->first_name }} {{ $donor->last_name }}</td>
                                    </tr>
                                   
                                     <br>
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



@include('layouts.footer')




@endsection


