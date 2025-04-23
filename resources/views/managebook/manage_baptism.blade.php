
<div class="card-body">
<h3 class="card-title">Baptism book</h3>
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
                                <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                    onclick="baparchive({{ json_encode($record->id) }})">
                                    <i class="fa fa-archive"></i>
                                </button>
                                @auth
                                @if(session('user_type') == '1')
                                    <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                        onclick="bapdelete({{ json_encode($record->id) }})">
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
<script>
    function baparchive(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Archive the Baptism Book?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Archive Baptism Book!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/bookrecord/archive/' + id;
            }
        });
    }
</script>
<script>
    function bapdelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Delete the Baptism Record?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete Baptism Record!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/deletedelete_record/' + id;
            }
        });
    }
</script>