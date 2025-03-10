<div class="card-body">
    <h3 class="card-title">Members</h3>
    <div class="table-responsive">
        <table id="member-table" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 50%">Full Name</th>
                    <th style="width: 20%">Position</th>
                    <th style="width: 20%">Status</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th style="width: 50%">Full Name</th>
                    <th style="width: 20%">Position</th>
                    <th style="width: 20%">Status</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</td>
                        <td>{{ $member->position }}</td>
                        <td>{{ $member->status }}</td>
                        <td>
                            <div class="form-button-action">
                                <button
                                    type="button"
                                    class="btn btn-link btn-primary btn-lg"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editMemberModal"
                                    onclick="editMember(
                                        '{{ $member->id }}',
                                        '{{ $member->first_name }}',
                                        '{{ $member->middle_name }}',
                                        '{{ $member->last_name }}',
                                        '{{ $member->dob }}',
                                        '{{ $member->civil_status }}',
                                        '{{ $member->email }}',
                                        '{{ $member->contact_number }}',
                                        '{{ $member->position }}',
                                        '{{ $member->status }}',
                                        '{{ $member->purok_no }}',
                                        '{{ $member->street_address }}',
                                        '{{ $member->barangay }}',
                                        '{{ $member->municipality }}',
                                        '{{ $member->province }}',
                                        '{{ $member->picture }}'
                                    )">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button
                                    type="button"
                                    data-bs-toggle="tooltip"
                                    class="btn btn-link btn-danger"
                                    title="Move to Archive"
                                    onclick="window.location.href='/members/archive/{{ $member->id }}'">
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
    <h3 class="card-title">Volunteers</h3>
    <div class="table-responsive">
        <table id="volunteer-table" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 50%">Full Name</th>
                    <th style="width: 20%">Position</th>
                    <th style="width: 20%">Status</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th style="width: 50%">Full Name</th>
                    <th style="width: 20%">Position</th>
                    <th style="width: 20%">Status</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($volunteers as $volunteer)
                    <tr>
                        <td>{{ $volunteer->first_name }} {{ $volunteer->middle_name }} {{ $volunteer->last_name }}</td>
                        <td>{{ $volunteer->position }}</td>
                        <td>{{ $volunteer->status }}</td>
                        <td>
                            <div class="form-button-action">
                                <button
                                    type="button"
                                    class="btn btn-link btn-primary btn-lg"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editVolunteerModal"
                                    onclick="editVolunteer(
                                        '{{ $volunteer->id }}',
                                        '{{ $volunteer->first_name }}',
                                        '{{ $volunteer->middle_name }}',
                                        '{{ $volunteer->last_name }}',
                                        '{{ $volunteer->dob }}',
                                        '{{ $volunteer->civil_status }}',
                                        '{{ $volunteer->email }}',
                                        '{{ $volunteer->contact_number }}',
                                        '{{ $volunteer->position }}',
                                        '{{ $volunteer->status }}',
                                        '{{ $volunteer->purok_no }}',
                                        '{{ $volunteer->street_address }}',
                                        '{{ $volunteer->barangay }}',
                                        '{{ $volunteer->municipality }}',
                                        '{{ $volunteer->province }}',
                                        '{{ $volunteer->picture }}'
                                    )">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button
                                    type="button"
                                    data-bs-toggle="tooltip"
                                    class="btn btn-link btn-danger"
                                    title="Move to Archive"
                                    onclick="window.location.href='/volunteers/archive/{{ $volunteer->id }}'">
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
