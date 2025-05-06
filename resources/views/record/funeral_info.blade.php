@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Funeral Record of </h3>
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
                <a href="/funeral">Funeral</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/funeral_record">Funeral Record of  </a>
            </li>
            
            
            
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                <h5 class="card-title">Funeral Record Details</h5>
                @if ($funeralRecord->payment == 0)
                <button
                    class="btn btn-primary btn-round ms-auto"
                    data-bs-toggle="modal" data-bs-target="#paymentModal"
                >
                    <i class="fa fa-plus"></i>
                    Proceed to Pay
                </button>
            @endif
                </div>
                <div class="table-responsive">
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Record Code: {{ $funeralRecord->record_code }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 15%"><strong>Name of Deceased:</strong></td>
                                <td>{{ $funeralRecord->first_name }} {{ $funeralRecord->middle_name }} {{ $funeralRecord->last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Birth:</strong></td>
                                <td>{{ $funeralRecord->dob }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Death:</strong></td>
                                <td>{{ $funeralRecord->dod }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Funeral:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($funeralRecord->funeral_date)->format('m/d/Y') }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Contact of Relative:</strong></td>
                                <td>{{ $funeralRecord->contact }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Payment status</strong></td>
                                  <td>
                                      {{ $funeralRecord->category }}: ₱{{ $funeralRecord->price }}
                                      <br>
                                      @if ($funeralRecord->payment == 0)
                                          <span style="color: red;">Not yet paid</span>
                                      @elseif ($funeralRecord->payment == 1)
                                          <span style="color: green;">Paid</span>
                                      @endif
                                  </td>
      
                              </tr>
                        </tbody>
                    </table>
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
          <form action="{{ route('funeral.payment.store') }}" method="POST">
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
                              <input type="text" name="funeral_id" value="{{$funeralRecord->id}}" hidden>
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
                              <input type="text" class="form-control" id="paymentReason" name="reason"   value=" bapstism for {{ $funeralRecord->category}}" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="paymentAmount">Amount</label>
                              <input type="text" class="form-control" id="paymentAmount" name="amount" value="{{ $funeralRecord->price}}" required />
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

@include('layouts.footer')

@endsection
