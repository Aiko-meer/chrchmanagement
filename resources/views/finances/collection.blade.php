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

        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Collection Record</h5>
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
                    <h5 class="fw-bold mb-3">Acolytes Information</h5>
                    <form action="{{ route('collection.store') }}" method="POST">
                    @csrf
                    <div id="acolytesContainer">
                      <!-- Default Acolyte -->
                      <div class="acolyte-group">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="acolyteFirstName">First Name</label>
                              <input type="text" class="form-control" name="acolyteFirstName[]" placeholder="Enter First Name" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="acolyteMiddleName">Middle Name</label>
                              <input type="text" class="form-control" name="acolyteMiddleName[]" placeholder="Enter Middle Name" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="acolyteLastName">Last Name</label>
                              <input type="text" class="form-control" name="acolyteLastName[]" placeholder="Enter Last Name" />
                            </div>
                          </div>
                        </div>
                        <hr />
                      </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addAcolyte()">Add Another Acolyte</button>

                    <!-- Date and Time Schedule -->
                    <h5 class="fw-bold mb-3 mt-4">Date and Time Schedule</h5>
                    <div class="row">
                      <div class="col-md-7">
                        <div class="form-group">
                          <label for="collectionDate">Date</label>
                          <input type="date" class="form-control" name="collectionDate"  id="collectionDate" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="startTime">Start Time</label>
                          <input type="time" class="form-control" name="startTime"  id="startTime" />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="endTime">End Time</label>
                          <input type="time" class="form-control"  name="endTime" id="endTime" />
                        </div>
                      </div>
                    </div>

                    <!-- In-Kind Collection -->
                    <h5 class="fw-bold mb-3 mt-4">In-Kind Collection</h5>
                    <div id="inkindCollectionContainer">
                      <!-- Default In-Kind Collection -->
                      <div class="inkind-collection-group">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="inkindItems">Items</label>
                              <input type="text" class="form-control" name="inkindItems[]" placeholder="Enter Items" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="inkindPieces">Pieces</label>
                              <input type="text" class="form-control" name="inkindPieces[]" placeholder="Enter Pieces" />
                            </div>
                          </div>
                        </div>
                        <hr />
                      </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addInKindCollection()">Add Another In-Kind Collection</button>

                    <!-- Money Collection -->
                    <h5 class="fw-bold mb-3 mt-4">Money Collection</h5>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="moneyAmount">Amount</label>
                          <input type="number" class="form-control" name="moneyAmount" id="moneyAmount" placeholder="Enter Amount" />
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

<div class="modal fade" id="formModal1" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Collection Record</h5>
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
                    <h5 class="fw-bold mb-3">Acolytes Information</h5>
                    <form action="{{ route('collection.print') }}" method="POST">
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
                

                    <!-- Date and Time Schedule -->
                    

                    <!-- In-Kind Collection -->
                  

                    <!-- Money Collection -->
                  

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
  function addAcolyte() {
    const acolytesContainer = document.getElementById('acolytesContainer');
    const acolyteGroup = document.createElement('div');
    acolyteGroup.className = 'acolyte-group';
    acolyteGroup.innerHTML = `
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="acolyteFirstName">First Name</label>
            <input type="text" class="form-control" name="acolyteFirstName[]" placeholder="Enter First Name" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="acolyteMiddleName">Middle Name</label>
            <input type="text" class="form-control" name="acolyteMiddleName[]" placeholder="Enter Middle Name" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="acolyteLastName">Last Name</label>
            <input type="text" class="form-control" name="acolyteLastName[]" placeholder="Enter Last Name" />
          </div>
        </div>
      </div>
      <hr />
    `;
    acolytesContainer.appendChild(acolyteGroup);
  }

  function addInKindCollection() {
    const inkindCollectionContainer = document.getElementById('inkindCollectionContainer');
    const inkindCollectionGroup = document.createElement('div');
    inkindCollectionGroup.className = 'inkind-collection-group';
    inkindCollectionGroup.innerHTML = `
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="inkindItems">Items</label>
            <input type="text" class="form-control" name="inkindItems[]" placeholder="Enter Items" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="inkindPieces">Pieces</label>
            <input type="text" class="form-control" name="inkindPieces[]" placeholder="Enter Pieces" />
          </div>
        </div>
      </div>
      <hr />
    `;
    inkindCollectionContainer.appendChild(inkindCollectionGroup);
  }

</script>



        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Collection</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                                Collection record
                                </button>
                                <button
                                class="btn btn-primary btn-round "
                                data-bs-toggle="modal" data-bs-target="#formModal1"
                                >
                                <i class="fa fa-plus"></i>
                               Print Record By Month
                                </button>
                            </div>
                        </div>
                        
                        <div class="card-body">
                        <div class="table-responsive">
                          <table id="add-row" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Acolyte's Name</th>
                                      <th style="width: 40%">Collected On</th>
                                      <th>Time</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                              <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Acolyte's Name</th>
                                      <th style="width: 40%">Collected On</th>
                                      <th>Time</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                              @foreach ($collections as $collection)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>@foreach ($collection->acolytes as $acolyte)
                                      {{ $acolyte->first_name }} {{ $acolyte->last_name }} <br> @endforeach</td>
                                      <td>{{ \Carbon\Carbon::parse($collection->collection_date)->format('F j, Y') }}</td>
                                      <td>{{ \Carbon\Carbon::parse($collection->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($collection->end_time)->format('h:i A') }}</td>
                                      <td>
                                          <div class="form-button-action">
                                          <button type="button" data-bs-toggle="tooltip" title="View Collection Record" 
                                          class="btn btn-link btn-primary" onclick="window.location.href='/collection_info/{{ $collection->id }}'">
                                              <i class="fas fa-eye"></i> 
                                          </button>
                                              
                                            
                                              <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                                      onclick="Collarchive({{ json_encode($collection->id) }})">
                                                      <i class="fa fa-archive"></i>
                                                  </button>
                                              @auth
                                              @if(session('user_type') == '1')
                                                  <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                                      onclick="colldelete({{ json_encode($collection->id) }})">
                                                      <i class="fa fa-times"></i>
                                                  </button>
                                              @endif
                                          @endauth
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function colldelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Delete the Collection Record?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete Collection Record!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/collection/delete/' + id;
            }
        });
    }
</script>
<script>
  function Collarchive(id) {
      Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to Archive the Collection Record?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Yes, Archive Collection Record!',
          cancelButtonText: 'No, cancel',
      }).then((result) => {
          if (result.isConfirmed) {
              // Redirect to the retrieval route
              window.location.href = '/collection_records/archive/' + id;
          }
      });
  }
</script>


@include('layouts.footer')




@endsection


