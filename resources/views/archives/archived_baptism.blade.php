
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
                                <button type="button" class="btn btn-link btn-danger" title="Move to Archive"
                                    onclick="window.location.href='/baptism_archive/{{ $baptism['year'] }}'">
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
                                <button type="button" class="btn btn-link btn-danger" title="Move to Archive"
                                    onclick="window.location.href='{{ route('bookfolder.archive', $book['id']) }}'">
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
                                <button type="button" class="btn btn-link btn-danger" title="Move to Archive"
                                    onclick="window.location.href='/bookrecord/archive/{{ $record->id }}'">
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