@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Confirmands Information</h3>
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
                    <a href="/confirmation">Confirmation of {{ $confirmationYear }} Records</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/confirmation/{{  $confirmationID }}">Confirmands Information</a>
                </li>
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Confirmands Record Details</h5>
                <div class="d-flex align-items-center">
                                <h5 class="card-title"></h5>
                                <a
                                    href="{{ url('confirmation_print/' . $confirmationRecord->id) }}"
                                    class="btn btn-danger btn-round ms-auto"
                                >
                                    <i class="fa fa-print"></i>
                                    Print Certificate
                                </a>
                            </div>
                            <br>
                            <div class="certificate">
        <div class="header">
            <h2>OUR LADY OF PEACE AND GOOD VOYAGE PARISH</h2>
            <p>Tugbungan, Zamboanga City, Philippines</p>
            <p>Archdiocese of Zamboanga</p>
        </div>

        <h1>Certificate of Confirmation</h1>

        <h2 >Parish of</h2>
        <p><strong>Our Lady of Peace and Good Voyage Parish, Tugbungan Zamboanga City</strong></p>
        <p class="sub-text">*This is to Certify*</p>

        <p >
            That <strong>{{ $confirmationRecord->child_first_name }} {{ $confirmationRecord->child_middle_name }} {{ $confirmationRecord->child_last_name }}</strong>, Son/Daughter of 
            <strong>{{ $confirmationRecord->father_first_name }} {{ $confirmationRecord->father_middle_name }} {{ $confirmationRecord->father_last_name }}</strong> and <strong>
            {{ $confirmationRecord->mother_first_name }} {{ $confirmationRecord->mother_middle_name }} {{ $confirmationRecord->mother_last_name }}
            </strong>,
        </p><br>
        <p>Received the</p>
        <p style="text-align: left; margin: 10px 30px; text-indent: 0px;">
             <br>SACRAMENT OF CONFIRMATION ACCORDING TO THE RITES OF THE HOLY ROMAN CATHOLIC CHURCH
        </p>
<br>    
        <p style="text-align: left; margin: 10px 30px; text-indent: 30px;">
            On <strong>{{ \Carbon\Carbon::parse($confirmationRecord->confirmation_date)->format('F, d, Y') }}</strong> in the Church of <strong>OUR LADY OF PEACE AND GOOD VOYAGE PARISH</strong> at 
            <strong>BRGY. TUGBUNGAN, ZAMBOANGA CITY</strong>
        </p>
        <p style="text-align: left; margin: 10px 30px;">In the <strong>Archdiocese of Zamboanga</strong></p>
        <p style="text-align: left; margin: 10px 30px;">By the</p>
        <p style="text-align: left; margin: 10px 30px;">The Sponsors being <strong>{{ $confirmationRecord->godparent_first_name }} {{ $confirmationRecord->godparent_middle_name }} {{ $confirmationRecord->godparent_last_name }}</strong></p>

        <p>As appears in the</p>
        <br>
        <p style="text-align: left; margin: 10px 30px; text-indent: 0px;">
            Confirmation Registered Book of this Church Book of <strong>CONFIRMATION</strong> page 
            <strong>{{ $confirmationRecord->page_no }}</strong> Line <strong>{{ $confirmationRecord->page_no }}</strong>.
        </p>

        <div class="footer">
            <p style="text-align: left; margin: 10px 10px;">Date: <strong>{{ \Carbon\Carbon::parse($confirmationRecord->confirmation_date)->format('F, d, Y') }}</strong></p>
            <p style="text-align: right;">___________________________</p>
            <p style="text-align: right; margin: 10px 70px;">Parish Priest</p>
        </div>
    </div>
           
                
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
