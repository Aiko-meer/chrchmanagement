
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