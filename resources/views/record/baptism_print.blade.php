<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Baptism</title>

    <style>

        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }

        .certificate {
            width: 700px;
 	    height: 1175px;
            border: 5px solid black;
            padding: 20px;
            margin: 30px auto;
            position: relative;
        }

        .certificate h1 {
	font-family: "Old English Text MT";
            font-size: 40px;
            text-align: center;
            margin: 0;
        }

        .header {
            text-align: center;
            font-size: 16px;
            margin-bottom: 2px;
        }

        .bold {
            font-weight: bold;
        }

        .underline {
            text-decoration: underline;
        }

        .section-title {
            font-size: 18px;
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
        }

        .info-table, .sponsor-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .info-table td, .sponsor-table td {
            padding: 1px;
            font-size: 18px;

        }

        .info-table td:first-child {
            width: 20%;
            font-weight: bold;
        }

        .sponsor-table td {
           width: 20%;
            text-align: center;
        }

        .priest-section {
            margin-top: 20px;
        }

        .footer-section {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }

        .seal {
            position: absolute;
            bottom: 80px;
            left: 50px;
            width: 120px;
            opacity: 0.6;
        }

        .signature {
            text-align: right;
            margin-top: 10px;
            font-style: italic;
        }

        .small-text {
            font-size: 12px;
            text-align: center;
            margin-top: 15px;
        }
hr {
 display: block;
   
    background: transparent;
    width: 100%;
    border: none;
     border-top: solid 1px #000 !important;
}
    </style>
</head>
<body>
<div class="certificate" id="certificate">
        <div class="header">
            <h2>OUR LADY OF PEACE AND GOOD VOYAGE PARISH</h2>
            <p>Tugbungan, Zamboanga City, Philippines</p>
            <p>Archdiocese of Zamboanga</p>
        </div>

        <h1>Certificate of Baptism</h1>

        <table class="info-table">
            <tr>
                <td>Name:</td>
                <td>{{ $bookRecord->child_first_name }} {{ $bookRecord->child_middle_name }} {{ $bookRecord->child_last_name }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
		
            </tr>

            <tr>
                <td>Date of Birth:</td>
                <td>{{ $bookRecord->child_dob }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Place of Birth:</td>
                <td>{{ $bookRecord->child_city }}, {{ $bookRecord->child_province }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Father:</td>
                <td>{{ $bookRecord->father_first_name }} {{ $bookRecord->father_middle_name }} {{ $bookRecord->father_last_name }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Place of Birth:</td>
                <td>{{ $bookRecord->father_city }}, {{ $bookRecord->father_province }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Mother:</td>
                <td>{{ $bookRecord->mother_first_name }} {{ $bookRecord->mother_middle_name }} {{ $bookRecord->mother_last_name }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Place of Birth:</td>
                <td>{{ $bookRecord->mother_city }}, {{ $bookRecord->mother_province }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
            <tr>
                <td>Residence:</td>
                <td>{{ $bookRecord->residence_city }}, {{ $bookRecord->residence_province }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
        </table>

        <h2 class="section-title">Sponsors</h2>
        <table class="sponsor-table">
        @foreach($godparents as $godparent)
            <tr>
                <td>{{ $godparent->first_name }} {{ $godparent->middle_name }} {{ $godparent->last_name }}<hr style="width:100%;text-align:left;margin-left:0;height:1px;border-width:0;color:black;background-color:black"></td>
                <td>{{ $godparent->municipality_city }}, {{ $godparent->province }}<hr style="width:100%;text-align:right;margin-left:0;height:1px;border-width:0;color:gray;background-color:black"></td>
            </tr>
        @endforeach
        @for($i = count($godparents); $i < 3; $i++)
        <tr>
            <td>&nbsp;
                <hr style="width:100%;text-align:left;margin-left:0; margin: 20px 0 0 0px;height:1px;border-width:0;color:gray;background-color:black">
            </td>
            <td>&nbsp;
                <hr style="width:100%;text-align:right;margin-left:0; margin: 20px 0 0 0px;height:1px;border-width:0;color:gray;background-color:black">
            </td>
        </tr>
       
        @endfor
        
           
        </table>
        

        <div class="priest-section">
            <p><strong>Priest/Minister: </strong></p><div style="width: 25%; height: 1px; border-top: 1px solid black; margin: -20px 0 0 120px;"></div>
            <p><strong>Date of Baptism: </strong></p><div style="width: 25%; height: 1px; border-top: 1px solid black;; margin: -20px 0 0 120px;"></div><br>
            <p><strong>REFERENCE:</strong></p><div style="width: 25%; height: 1px; border-top: 1px solid black; margin: -20px 0 0 120px;"></div>
            <table class="info-table">
                <tr>
                    <td>Book No: </td>
                    <td>{{ $bookRecord->book_no }}<div style="width: 25%; height: 1px; border-top: 1px solid black; margin: -4px 0 0 -60px;"></div></td>
                </tr>
                <tr>
                    <td>Page No:</td>
                    <td>{{ $bookRecord->page_no }}<div style="width: 25%; height: 1px; border-top: 1px solid black; margin: -4px 0 0 -60px;"></div></td>
                </tr>
                <tr>
                    <td>Line No:</td>
                    <td> 0<div style="width: 25%; height: 1px; border-top: 1px solid black; margin: -4px 0 0 -60px;"></div></td>
                </tr>
                <tr>
                    <td>Series:</td>
                    <td>{{ $bookRecord->series_year_no }}<div style="width: 25%; height: 1px; border-top: 1px solid black; margin: -4px 0 0 -60px;"></div></td>
                </tr>
                
            </table>
<div class="signature">
            Certified True and Correct:<br>
<br>

            <span class="underline">MSGR. A.P. SEBASTIAN</span><br>
            Parish Priest
        </div>
        <p><strong>Issued By: </strong>

        </p>
        <div style="width: 25%; height: 1px; border-top: 1px solid black; margin: -15px 0 0 80px;"></div>

        <p style="position: relative; margin: 0;">
        <strong> Date: </strong>
     
      
    </p><div style="width: 25%; height: 1px; border-top: 1px solid black; margin: -5px 0 0 80px;"></div>
<br>
    <p style="position: relative; margin: 0;">
    <strong> Notanda: </strong>
     
      
    </p><div style="width: 85%; height: 1px; border-top: 1px solid black; margin: -5px 0 0 80px;"></div>
    <div style="width: 85%; height: 0; border-top: 1px solid black; margin: 21px 0 0 80px;"></div>
    <br>

    <br>
        <div class="small-text">
            This certification is not valid if it does not bear the official seal of the parish,
            or if it has marks of erasures or alterations of any entry.
        </div>
    </div>
        </div>


        <script>
        // Trigger print dialog automatically when the page loads
        window.onload = function() {
            window.print();
        };
    </script>
        
</body>
</html>
