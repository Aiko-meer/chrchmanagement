@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
        <h3 class="fw-bold mb-3">Wedding Record of {{ $weddingYear }}</h3>
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
                <a href="/wedding/">Wedding</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/wedding_record/{{ $weddingID }}">Wedding Record of {{ $weddingYear }}</a>
            </li>
            
            
            
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="card-title">Wedding Record Details</h5>
                    <button
                    class="btn btn-primary btn-round ms-auto"
                    data-bs-toggle="modal" data-bs-target="#updateWeddingDateModal"
                >
                    <i class="fa fa-edit"></i>
                    Re-Schedule Wedding date
                </button>
                @if ($WeddingRecords->payment == 0)
                <button
                    class="btn btn-primary btn-round ms-2"
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
                                <th colspan="2">Record Code:{{ $WeddingRecords->record_code }}  </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 15%"><strong>Groom's Name:</strong></td>
                                <td>{{ $WeddingRecords->groom_first_name }} {{ $WeddingRecords->groom_middle_name }} {{ $WeddingRecords->groom_last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Birth:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($WeddingRecords->groom_dob)->format('F j, Y') }} </td>  
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Residence</strong></td>
                                <td>{{ $WeddingRecords->groom_purok_no }}, {{ $WeddingRecords->groom_street_address }}, {{ $WeddingRecords->groom_barangay }}, {{ $WeddingRecords->groom_residence_city }}, {{ $WeddingRecords->groom_residence_province }}</td>
                            </tr>
                            <tr>
                                <td  style="width: 15%"><strong>Documents Presented</strong></td>
                                <td>
                                    @if ($WeddingRecords->groom_baptism_cert)
                                        <a href="{{ asset('storage/' . $WeddingRecords->groom_baptism_cert) }}" target="_blank">View Groom Baptism Cert</a>,
                                        <a href="{{ asset('storage/' . $WeddingRecords->groom_confirmation_cert) }}" target="_blank">View Groom Confirmation Cert</a>,
                                        <a href="{{ asset('storage/' . $WeddingRecords->groom_cenomar) }}" target="_blank">View Groom CENOMAR </a>,
                                    @else
                                        No file uploaded
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong></strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Bride's Name:</strong></td>
                                <td>{{ $WeddingRecords->bride_first_name }} {{ $WeddingRecords->bride_middle_name }} {{ $WeddingRecords->bride_last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Date of Birth:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($WeddingRecords->bride_dob)->format('F j, Y') }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Residence</strong></td>
                                <td>{{ $WeddingRecords->bride_purok_no }}, {{ $WeddingRecords->bride_street_address }}, {{ $WeddingRecords->bride_barangay }}, {{ $WeddingRecords->bride_residence_city }}, {{ $WeddingRecords->bride_residence_province }}</td>
                            </tr>
                            <tr>
                                <td  style="width: 15%"><strong>Documents Presented</strong></td>
                                <td>
                                    @if ($WeddingRecords->groom_baptism_cert)
                                        <a href="{{ asset('storage/' . $WeddingRecords->brides_baptism_cert) }}" target="_blank">View Brides Baptism Cert</a>,
                                        <a href="{{ asset('storage/' . $WeddingRecords->brides_confirmation_cert) }}" target="_blank">View Brides Confirmation Cert</a>,
                                        <a href="{{ asset('storage/' . $WeddingRecords->brides_cenomar) }}" target="_blank">View Brides CENOMAR </a>,
                                    @else
                                        No file uploaded
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td  style="width: 15%"><strong>Wedding Date</strong></td>
                                <td>{{ \Carbon\Carbon::parse($WeddingRecords->wedding_date)->format('F j, Y') }}</td>
                            </tr>
                            <tr>
                                <td style="width: 15%"><strong>Payment status</strong></td>
                                  <td>
                                      {{ $WeddingRecords->category }}: ₱{{ $WeddingRecords->price }}
                                      <br>
                                      @if ($WeddingRecords->payment == 0)
                                          <span style="color: red;">Not yet paid</span>
                                      @elseif ($WeddingRecords->payment == 1)
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
<!--payment modal-->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentModalLabel">Payment Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('wedding.payment.store') }}" method="POST">
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
                              <input type="text" name="funeral_id" value="{{$WeddingRecords->id}}" hidden>
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
                              <input type="text" class="form-control" id="paymentReason" name="reason"   value=" Wedding for {{ $WeddingRecords->category}}" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="paymentAmount">Amount</label>
                              <input type="text" class="form-control" id="paymentAmount" name="amount" value="{{ $WeddingRecords->price}}" required />
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

  <!--wedding date-->
  <!-- Update Wedding Date Modal -->
<div class="modal fade" id="updateWeddingDateModal" tabindex="-1" aria-labelledby="updateWeddingDateLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="updateWeddingDateLabel">Update Wedding Date</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" action="{{ route('wedding.date.update') }}">
        @csrf
        @method('PUT')

        <div class="modal-body px-4 py-3">
          <input type="hidden" name="wedding_id" value="{{ $WeddingRecords->id}}" id="updateWeddingId">

          <div class="mb-3">
            <label for="weddingDate" class="form-label">New Wedding Date</label>
            <input type="date" class="form-control" id="weddingDate" name="wedding_date" value="{{ \Carbon\Carbon::parse($WeddingRecords->wedding_date)->format('Y-m-d') }}" required>

          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>


@include('layouts.footer')

@endsection
