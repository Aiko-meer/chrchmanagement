<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>OTP Verification Form</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://smtpjs.com/v3/smtp.js">
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    </script>
   
       <!-- Include jQuery and SweetAlert -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <style>
 @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4070f4;
}
:where(.container, form, .input-field, header) {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.container {
  background: #fff;
  padding: 30px 65px;
  border-radius: 12px;
  row-gap: 20px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.container header {
  height: 65px;
  width: 65px;
  background: #4070f4;
  color: #fff;
  font-size: 2.5rem;
  border-radius: 50%;
}
.container h4 {
  font-size: 1.25rem;
  color: #333;
  font-weight: 500;
}
form .input-field {
  flex-direction: row;
  column-gap: 10px;
}
.input-field input {
  height: 45px;
  width: 42px;
  border-radius: 6px;
  outline: none;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
}
.input-field input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.input-field input::-webkit-inner-spin-button,
.input-field input::-webkit-outer-spin-button {
  display: none;
}
form button {
  margin-top: 25px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  border: none;
  padding: 9px 0;
  cursor: pointer;
  border-radius: 6px;
 
  background: #6e93f7;
  transition: all 0.2s ease;
}
.bt {
  margin-top: 25px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  border: none;
  padding: 9px 0;
  cursor: pointer;
  border-radius: 6px;
 
  background: #6e93f7;
  transition: all 0.2s ease;
}
form button.active {
  background: #4070f4;
  pointer-events: auto;
}
form button:hover {
  background: #0e4bf1;
}

  </style>
  <body>
    <div class="container">
      <header>
        <i class="bx bxs-check-shield"></i>
      </header>
      <h4>Email Exist </h4>
     
        <button type="button" class="bt" onclick="sendOtp()">Send OTP Code</button>
        <button></button>
        <input type="text" id="otp"  hidden>
        <input type="email" id="email" hidden>
        <form action="{{ route('otp') }}" method="POST" onsubmit="combineOtpInputs()">

           
            <div class="input-field">
                @csrf
                <input type="number" class="otp-input" maxlength="1" />
                <input type="number" class="otp-input" maxlength="1" disabled />
                <input type="number" class="otp-input" maxlength="1" disabled />
                <input type="number" class="otp-input" maxlength="1" disabled />
            </div>
            <input type="hidden" name="otp" id="otpHidden" />
            <input type="hidden" name="emails" id="email1" />
            <button type="submit" >Verify OTP</button>
        </form>
        
    </div>



    @if(isset($success))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ $success }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>

    <!-- Auto-fill OTP input field -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("otp").value = "{{ $otp }}";
            document.getElementById("email").value = "{{ $email }}";
            document.getElementById("email1").value = "{{ $email }}";
        });
    </script>
@endif

@if(isset($error))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $error }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    </script>
@endif
<!-- Add this in the <head> -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        (function(){
            emailjs.init("KTAAcRPgtzk3AyymQ"); // Replace with your EmailJS public key
        })();
    </script>
    
<script>
    function sendOtp(){
        let email = document.getElementById("email").value;
        let otp = document.getElementById("otp").value;
        let templateParams = {
          email: email,
          otp: otp,
      };

      emailjs.send("service_t9q5ec8", "template_7siipea", templateParams)
          .then(response => {
              alert("OTP Sent Successfully!");
              console.log("Success:", response);
          }, error => {
              alert("Failed to send OTP");
              console.error("Error:", error);
          });
    }
        
   
    
</script>
<script>
 document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".otp-input"),
        button = document.querySelector("button"),
        otpHidden = document.getElementById("otpHidden"),
        form = document.querySelector("form");

    // Handle OTP input behavior
    inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
            const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;

            if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }

            if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                nextInput.removeAttribute("disabled");
                nextInput.focus();
            }

            if (e.key === "Backspace") {
                inputs.forEach((input, index2) => {
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }

            if (!inputs[3].disabled && inputs[3].value !== "") {
                button.classList.add("active");
            } else {
                button.classList.remove("active");
            }
        });
    });

    // Combine OTP values into hidden input before submitting
    form.addEventListener("submit", function () {
        let otp = "";
        inputs.forEach(input => {
            otp += input.value;
        });
        otpHidden.value = otp; // Store OTP in hidden input field
    });

    // Focus the first input on page load
    inputs[0].focus();
});


</script>
  </body>
</html>