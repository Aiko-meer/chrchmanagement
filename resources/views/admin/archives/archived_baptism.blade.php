
<div class="card-body">
<h3 class="card-title">Baptisms Folder</h3>
    <div class="table-responsive">
        <table id="baptisms-table" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 10%">Year</th>
                    <th style="width: 45%">No. of Bookings</th>
                    <th style="width: 20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($baptismWithBookCounts as $baptism)
                    <tr>
                        <td><i class="fas fa-book"> - </i> {{ $baptism['year'] }}</td>
                        <td>{{ $baptism['book_count'] }} Total Books</td>
                        <td>
                            <div class="form-button-action">
                                <button type="button" class="btn btn-link btn-primary btn-lg" title="Edit Task"
                                    onclick="window.location.href='/baptism_archive/month/{{ $baptism['year'] }}'">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-secondary btn-lg" title="Retrieve"
                                        onclick="confirmRetrievefolder({{ $baptism['year'] }})">
                                    <i class="fas fa-undo"></i>
                                </button>
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--js script-->
<script>
    function confirmRetrievefolder(baptismId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to retrieve this baptism record?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, retrieve it!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/baptism_retrieve/' + baptismId;
            }
        });
    }
</script>
<script>
    function confirmRetrieveRecord(bookId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to retrieve this Baptism record?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, retrieve it!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/bookrecord_retrieve/' + bookId;
            }
        });
    }
</script>
<script>
    function confirmRetrieveBookRecord(bookIds) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to retrieve this Baptism record?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, retrieve it!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/book_archived/retrieve/' + bookIds;
            }
        });
    }
</script>
<div class="separator" style="border-top: 2px solid #ddd; margin: 20px 0;"></div>
<div class="card-body">
<h3 class="card-title">Batism Books Records</h3>
    <div class="table-responsive">
        <table id="books-table" class="display table table-striped table-hover">
            <thead>
                <tr>
                 
                    <th style="width: 15%">Book Number</th>
                    <th style="width: 15%">Baptism Series of</th>
                    <th style="width: 50%">No. of Baptisms</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($booksWithRecordCounts as $book)
                    <tr>
                     
                        <td># {{ $book['book_number'] }}</td>
                        <td> {{ $book['baptism_year'] }}</td>
                        <td>{{ $book['record_count'] }} total baptisms</td>
                        <td>
                            <div class="form-button-action">
                                <button type="button" class="btn btn-link btn-primary btn-lg" title="Show Baptism Record"
                                    onclick="window.location.href='/book_record_archived/{{ $book['id'] }}'">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-secondary btn-lg" title="Retrieve"
                                onclick="confirmRetrieveBookRecord({{ $book['id'] }})">
                                 <i class="fas fa-undo"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="separator" style="border-top: 2px solid #ddd; margin: 20px 0;"></div>
<div class="card-body">
<h3 class="card-title">Baptism Records</h3>
    <div class="table-responsive">
        <table id="records-table" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Record Code</th>
                    <th style="width: 40%">Name of Child</th>
                    <th>Date of Baptism</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookRecords as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $record->record_code }}</td>
                        <td>{{ $record->child_first_name }} {{ $record->child_middle_name }} {{ $record->child_last_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->baptism_date)->format('m/d/Y') }}</td>
                        <td>
                            <div class="form-button-action">
                                <a href="{{ route('book.record.info', $record->id) }}" class="btn btn-link btn-primary btn-lg" title="View Baptism Record">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-link btn-primary btn-lg" title="Edit Baptism Record"
                                    onclick="editBaptismRecord({{ json_encode($record) }})">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-secondary btn-lg" title="Retrieve"
                                onclick="confirmRetrieveRecord({{ $record['id'] }})">
                            <i class="fas fa-undo"></i>
                        </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>