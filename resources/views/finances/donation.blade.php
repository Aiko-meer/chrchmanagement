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
                            <form action="{{ route('donation.print') }}" method="POST">
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

        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
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

                    <!-- Donors Information -->
                    <h5 class="fw-bold mb-3">Donor Information</h5>
                    
                    <form action="{{ route('donation.store') }}" method="POST">
                    @csrf
                    <div id="donorsContainer">
                      <div class="donor-group">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="donorFirstName">First Name</label>
                              <input type="text" class="form-control" name="donorFirstName[]" placeholder="Enter First Name" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="donorMiddleName">Middle Name</label>
                              <input type="text" class="form-control" name="donorMiddleName[]" placeholder="Enter Middle Name" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="donorLastName">Last Name</label>
                              <input type="text" class="form-control" name="donorLastName[]" placeholder="Enter Last Name" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="donorContactNo">Contact Number</label>
                              <input type="text" class="form-control" name="donorContactNo[]" placeholder="Enter Contact Number" />
                            </div>
                          </div>
                        </div>
                        <hr />
                      </div>
                    </div>
                
                    <button type="button" class="btn btn-secondary" onclick="addDonor()">Add Another Donor</button>
                   
                    <!-- Donation Details -->
                    <h5 class="fw-bold mb-3 mt-4">Donation Details</h5>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="donationType">Type of Donation</label>
                          <select class="form-control" name="donationType" id="donationType" onchange="toggleDonationDetails()">
                            <option value="">Select Donation Type</option>
                            <option value="Cash">Cash</option>
                            <option value="In-kind">In-Kind</option>
                            <option value="Cash and In-kind">Cash and In-Kind</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Cash Donation Amount -->
                    <div class="row" id="cashDonation" style="display: none;">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="cashAmount">Amount</label>
                          <input type="number" class="form-control" name="cashAmount" id="cashAmount" placeholder="Enter Amount" />
                        </div>
                      </div>
                    </div>
                    
                    <!-- In-Kind Donation Details -->
                    <div class="row" id="inkindDonation" style="display: none;">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="inkindDetails">In-Kind Donation</label>
                          <textarea class="form-control" id="inkindDetails" name="inkindDetails" placeholder="Enter In-Kind Donation Details"></textarea>
                        </div>
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

<script>
    function toggleDonationDetails() {
        const donationType = document.getElementById('donationType').value;
        const cashDonation = document.getElementById('cashDonation');
        const inkindDonation = document.getElementById('inkindDonation');

        if (donationType === 'Cash') {
            cashDonation.style.display = 'block';
            inkindDonation.style.display = 'none';
        } else if (donationType === 'In-kind') {
            cashDonation.style.display = 'none';
            inkindDonation.style.display = 'block';
        } else if (donationType === 'Cash and In-kind') {
            cashDonation.style.display = 'block';
            inkindDonation.style.display = 'block';
        } else {
            cashDonation.style.display = 'none';
            inkindDonation.style.display = 'none';
        }
    }

    function addDonor() {
        const donorsContainer = document.getElementById('donorsContainer');
        const donorGroup = document.createElement('div');
        donorGroup.className = 'donor-group';
        donorGroup.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="donorFirstName">First Name</label>
                        <input type="text" class="form-control" name="donorFirstName[]" placeholder="Enter First Name" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="donorMiddleName">Middle Name</label>
                        <input type="text" class="form-control" name="donorMiddleName[]" placeholder="Enter Middle Name" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="donorLastName">Last Name</label>
                        <input type="text" class="form-control" name="donorLastName[]" placeholder="Enter Last Name" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="donorContactNo">Contact Number</label>
                        <input type="text" class="form-control" name="donorContactNo[]" placeholder="Enter Contact Number" />
                    </div>
                </div>
            </div>
            <hr />
        `;
        donorsContainer.appendChild(donorGroup);
    }
</script>



        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Donation</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                                Donation record
                                </button>
                                <button
                                class="btn btn-primary btn-round ms-2"
                                data-bs-toggle="modal" data-bs-target="#formModal1"
                                >
                                <i class="fa fa-plus"></i>
                               Print Record by Month
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                       

                        <div class="table-responsive">
                          <table id="add-row" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Donator's Name</th>
                                      <th style="width: 40%">Type Of Donation</th>
                                      <th>Donated On</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                              <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Donator's Name</th>
                                      <th style="width: 40%">Type Of Donation</th>
                                      <th>Donated On</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                              @foreach ($donations as $donation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                    @foreach ($donation->donors as $donor)
                    {{ $donor->first_name }} {{ $donor->last_name }} <br>
                    @endforeach</td>
                    <td>{{ ucfirst($donation->type) }}</td>
                    <td>{{ $donation->created_at->format('F j, Y, h:iA') }}</td>
                    <td>
                        <div class="form-button-action">
                      
                        <button type="button" data-bs-toggle="tooltip" title="View Donation Record" class="btn btn-link btn-primary" onclick="window.location.href='/donation_info/{{ $donation->id }}'">
                                <i class="fas fa-eye"></i> 
                            </button>
                            
                            <button type="button" data-bs-toggle="tooltip" title="Move to Archive" class="btn btn-link btn-danger" onclick="window.location.href='/donations/archive/{{ $donation->id }}'">
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


