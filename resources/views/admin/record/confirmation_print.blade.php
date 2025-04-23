<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Confirmation</title>
   


    <style>
body {
    font-family: 'Times New Roman', Times, serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f9f9f9;
}

.certificate {
    border: 3px solid black;
    padding: 30px;
    width: 700px;
    height: 900px;
    background: white;
    text-align: center;
}

.header {
    margin-bottom: 20px;
}

.header h2 {
    font-size: 20px;
    text-transform: uppercase;
    margin: 0;
}

.header p {
    margin: 5px 0;
    font-size: 20px;
}
p {
    margin: 5px 0;
    font-size: 20px;
}

h1 {
    font-size: 40px;
    margin: 10px 0 20px;
  
}


.parish {
    font-size: 18px;
    margin: 10px 0;
}

.sub-text {
    margin: 10px 0;
    font-style: italic;
}

.body-text {
    margin: 20px 0;
    font-size: 18px;
}

.received {
    margin: 20px 0;
    font-size: 18px;
    font-weight: bold;
}

.footer {
    margin-top: 30px;
    text-align: center;
}

.footer p {
    margin: 5px 0;
}


    </style>
</head>
<body>
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
    <script>
        // Trigger print dialog automatically when the page loads
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
