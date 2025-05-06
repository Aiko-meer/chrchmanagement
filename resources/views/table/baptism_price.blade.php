@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Baptism Price Table</h3>
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
                <a href="/baptism">Baptism</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            
            
            
            
            </ul>
        </div>



<!--category-->
<div class="modal fade" id="CategoryModal" tabindex="-1" aria-labelledby="CategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">New Baptism Category Price</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="baptismRecordForm" action="{{ route('baptism.category.store') }}" method="POST">
            @csrf
            <div class="container">
              <div class="page-inner">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <!-- Example Form Fields -->
                        <div class="form-group mb-3">
                          <label for="baptism_name">Name of Category</label>
                          <input type="text" name="baptism_name" class="form-control" required>
                        </div>
  
                        <div class="form-group mb-3">
                          <label for="baptism_date">Price</label>
                          <input type="text" name="baptism_price" class="form-control" required>
                        </div>
                      </div> <!-- End card-body -->
                    </div> <!-- End card -->
                  </div> <!-- End col -->
                </div> <!-- End row -->
              </div> <!-- End page-inner -->
            </div> <!-- End container -->
  
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div> <!-- End modal-body -->
      </div> <!-- End modal-content -->
    </div> <!-- End modal-dialog -->
  </div> <!-- End modal -->


        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Funeral Price Table</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#CategoryModal"
                                >
                                <i class="fa fa-plus"></i>
                                New Funeral Category Price
                                </button>
                               
                            </div>
                        </div>
                        <div class="card-body">
                        <!-- Modal -->
                        
                        <div class="table-responsive">
                          <table id="add-row" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Category name</th>
                                      <th style="width: 40%">Price</th>
                                      
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Category name</th>
                                      <th style="width: 40%">Price</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                  @foreach($price as $index => $record)
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $record->name }}</td>
                                      <td>{{$record->price}}</td>
                                      
                                      <td>
                                          <div class="form-button-action">
                                        <button type="button" data-bs-toggle="tooltip" title="Edit Funeral Record" class="btn btn-link btn-primary btn-lg"
                                        onclick='editFuneralRecord({!! json_encode($record) !!})'>
                                            <i class="fa fa-edit"></i>
                                        </button>
                                              <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-danger btn-lg" title="Cancel"
                                              onclick="confirmcancel({{ $record['id'] }})">
                                              <i class="fas fa-times"></i>  <!-- Checkmark icon -->
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
<script> 
function editFuneralRecord(record) {
    // Set form fields with the existing record data
    document.getElementById('editFuneralId').value = record.id;
    document.getElementById('editRecordCode').value = record.name;
    document.getElementById('editFuneralDate').value = record.price;
    

    // Show the modal
    var editModal = new bootstrap.Modal(document.getElementById('editFuneralRecordModal'));
    editModal.show();
}
</script>

<!-- Edit Funeral Record Modal -->
<div class="modal fade" id="editFuneralRecordModal" tabindex="-1" aria-labelledby="editFuneralRecordLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFuneralRecordLabel">Edit Funeral Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editFuneralRecordForm" method="POST" action="{{ route('baptism.price.update') }}">
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    <input type="hidden" name="price_id" id="editFuneralId">

                    <!-- Funeral Details -->
                    <h5 class="fw-bold mb-3">Funeral Category Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editRecordCode">Category Name</label>
                               
                                <input type="text" class="form-control" id="editRecordCode" name="name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editFuneralDate">Price</label>
                                <input type="text" class="form-control" id="editFuneralDate" name="price" />
                            </div>
                        </div>
                    </div>

                  

                    
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmcancel(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Delete these Category?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete Category',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/baptism_price/delete/' + id;
            }
        });
    }
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  @if(session('success'))
  <script>
      Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '{{ session('success') }}',
          confirmButtonText: 'OK'
      }).then(() => {
           // Redirect to the previous page after the alert
      });
  </script>
@endif
@include('layouts.footer')




@endsection


