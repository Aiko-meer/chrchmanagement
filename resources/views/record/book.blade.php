@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Baptism Book  of {{ $baptismFolder->year }} Records</h3>
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
            <li class="nav-item">
                <a href="/book">Baptism Book of {{ $baptismFolder->year }} {{ $baptismFolder->month }} Records</a>
            </li>
           
            
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Baptism Book of {{ $baptismFolder->year }} {{ $baptismFolder->month }} Records</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i> Add New Book No.
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">New Book</span>
                                            <span class="fw-light">no.</span>
                                        </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small">New Book</p>
                                        <form id="bookForm">
                                            @csrf
                                            <input type="hidden" id="baptismId" name="baptism_id" value="{{ request()->route('baptism_id') }}" />
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Book No.</label>
                                                        <input id="bookNumber" name="book_number" type="number" class="form-control" placeholder="Book No." min="1" required />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive ">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Book Number</th>
                                        <th style="width: 50%">No. of Baptisms</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td># {{ $book->book_number }}</td>
                                            <td>{{ $book->book_records_count }} total baptisms</td>
                                            <td>
                                                <div class="form-button-action">
                                                @if(request()->is('book_archived/*'))
    <!-- Button for archived book records -->
                                                    <button type="button" class="btn btn-link btn-primary btn-lg" title="Show Baptism Record"
                                                        onclick="window.location.href='/book_record_archived/{{ $book->id }}'">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @else
                                                    <!-- Button for regular book records -->
                                                    <button type="button" data-bs-toggle="tooltip" title="Show Baptism Record" class="btn btn-link btn-primary btn-lg"
                                                        onclick="window.location.href='/book_record/{{ $book->id }}'">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @endif
                                                <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                                onclick="bookarchive({{ json_encode($book['id']) }})">
                                                <i class="fa fa-archive"></i>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addRowButton = document.getElementById('addRowButton');
    const bookForm = document.getElementById('bookForm');
    
    addRowButton.addEventListener('click', function() {
        const formData = new FormData(bookForm);
        
        fetch('/book/store', { // Adjust this URL if necessary
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload(); // Reload the page after success
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
});
</script>
<script>
    function bookarchive(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Archive the Book Folder?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Archive Book Folder!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/baptism_archive/' + id;
            }
        });
    }
</script>


@include('layouts.footer')




@endsection


