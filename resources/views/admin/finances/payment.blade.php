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

        <div class="modal fade" id="formModal1" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Donation Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="page-inner">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
        
                            <!-- Acolytes Information -->
                            <h5 class="fw-bold mb-3">Print Record By Month</h5>
                            <form action="{{ route('payment.print') }}" method="POST">
                            @csrf
                            <div id="acolytesContainer">
                              <!-- Default Acolyte -->
                              <div class="acolyte-group">
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="acolyteFirstName">Year and Month</label>
                                      <input type="month" class="form-control" name="yearmonth" />
        
                                    </div>
                                  </div>
                                 
                                 
                                </div>
                                <hr />
                              </div>
                            </div>
              
                          </div>
                          <div class="card-action">
                            <button class="btn btn-primary">Submit</button>
                            <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('payment.store') }}" method="POST">
                  @csrf
                  <div class="container">
                    <div class="page-inner">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-body">
                              <!-- Payer's Information -->
                              <h5 class="fw-bold mb-3">Payer's Information</h5>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="payerFirstName">First Name</label>
                                    <input type="text" class="form-control" id="payerFirstName" name="first_name" placeholder="Enter First Name" required />
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="payerMiddleName">Middle Name</label>
                                    <input type="text" class="form-control" id="payerMiddleName" name="middle_name" placeholder="Enter Middle Name" />
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="payerLastName">Last Name</label>
                                    <input type="text" class="form-control" id="payerLastName" name="last_name" placeholder="Enter Last Name" required />
                                  </div>
                                </div>
                              </div>

                              <!-- Payment Details -->
                              <h5 class="fw-bold mb-3 mt-4">Payment Details</h5>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="paymentReason">Reason for Payment</label>
                                    <input type="text" class="form-control" id="paymentReason" name="reason" placeholder="Enter Reason for Payment" required />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="paymentAmount">Amount</label>
                                    <input type="number" class="form-control" id="paymentAmount" name="amount" placeholder="Enter Amount" required />
                                  </div>
                                </div>
                              </div>

                              <!-- Date and Time -->
                              <h5 class="fw-bold mb-3 mt-4">Date and Time</h5>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="paymentDate">Date</label>
                                    <input type="date" class="form-control" name="payment_date" id="paymentDate" required />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="paymentTime">Time</label>
                                    <input type="time" class="form-control" name="payment_time" id="paymentTime" required />
                                  </div>
                                </div>
                              </div>

                            </div>
                            <div class="card-action">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>




        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Payment Record</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#paymentModal"
                                >
                                <i class="fa fa-plus"></i>
                                Payment record
                                </button>
                                <button
                                class="btn btn-primary btn-round ms-2"
                                data-bs-toggle="modal" data-bs-target="#formModal1"
                                >
                                <i class="fa fa-plus"></i>
                                Print Record By Month
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <!-- Modal -->
                        

                        <div class="table-responsive">
                          <table id="add-row" class="display table table-striped table-hover">
                              <thead>
                                  <tr>pa
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Name</th>
                                      <th style="width: 40%">Reason of Payment</th>
                                      <th>Payed On</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                
                              <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Name</th>
                                      <th style="width: 40%">Reason of Payment</th>
                                      <th>Payed On</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                 @foreach($payments as $index => $payment)
                           
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $payment->first_name }} {{ $payment->middle_name }} {{ $payment->last_name }}</td>
                                      <td>{{ $payment->reason }}</td>
                                      <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('F j, Y') }}, {{ \Carbon\Carbon::parse($payment->payment_time)->format('g:i A') }}</td>
                                      <td>
                                          <div class="form-button-action">
                                          
                                          <button type="button" data-bs-toggle="tooltip" title="View Payment Record" 
                                          class="btn btn-link btn-primary" onclick="window.location.href='/payment_info/{{ $payment->id }}'">
                                              <i class="fas fa-eye"></i> 
                                          </button>
                                              <button type="button" data-bs-toggle="tooltip" title="Move to Archive"
                                                  class="btn btn-link btn-danger" onclick="window.location.href='/payment/archive/{{ $payment->id }}'">
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
                    </div>
                </div>
                

                
            </div>
    </div>
</div>



@include('layouts.footer')




@endsection


