<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Church Mangament System</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon"/>

    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('assets/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
   $(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
     editable:true,
     header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
     },
     events: 'load.php',
     selectable:true,
     selectHelper:true,
     select: function(start, end, allDay)
     {
      var title = prompt("Enter Event Title");
      if(title)
      {
       var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
       var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
       $.ajax({
        url:"insert.php",
        type:"POST",
        data:{title:title, start:start, end:end},
        success:function()
        {
         calendar.fullCalendar('refetchEvents');
         alert("Added Successfully");
        }
       })
      }
     },
     editable:true,
     eventResize:function(event)
     {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
       url:"update.php",
       type:"POST",
       data:{title:title, start:start, end:end, id:id},
       success:function(){
        calendar.fullCalendar('refetchEvents');
        alert('Event Update');
       }
      })
     },
 
     eventDrop:function(event)
     {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
       url:"update.php",
       type:"POST",
       data:{title:title, start:start, end:end, id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Updated");
       }
      });
     },
 
     eventClick:function(event)
     {
      if(confirm("Are you sure you want to remove it?"))
      {
       var id = event.id;
       $.ajax({
        url:"delete.php",
        type:"POST",
        data:{id:id},
        success:function()
        {
         calendar.fullCalendar('refetchEvents');
         alert("Event Removed");
        }
       })
      }
     },
 
    });
   });
    
   </script>
    
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="white">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="blue">
            <a href="/" class="logo">
            <img
                src="{{ asset('assets/img/kaiadmin/logo-big.png') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="50"
            />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
              <ul class="nav nav-secondary">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="/">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                  <li class="nav-item {{ Request::is('baptism', 'confirmation', 'wedding', 'funeral') ? 'active' : '' }}">
                      <a data-bs-toggle="collapse" href="#Church">
                          <i class="fas fa-file-alt"></i>
                          <p>Church Record</p>
                          <span class="caret"></span>
                      </a>
                  <div class="collapse {{ Request::is('baptism', 'confirmation', 'wedding', 'funeral') ? 'show' : '' }}" id="Church">
                    <ul class="nav nav-collapse">
                        <li class="{{ Request::is('baptism') ? 'active' : '' }}">
                            <a href="/baptism">
                                <span class="sub-item">Baptism</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('confirmation') ? 'active' : '' }}">
                            <a href="/confirmation">
                                <span class="sub-item">Confirmation</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('wedding') ? 'active' : '' }}">
                            <a href="/wedding">
                                <span class="sub-item">Marriage</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('funeral') ? 'active' : '' }}">
                            <a href="/funeral">
                                <span class="sub-item">Funeral</span>
                            </a>
                        </li>
                      </ul>

                  </li>
            
              <li class="nav-item {{ Request::is('member', 'volunteer') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#Members">
                    <i class="fas fa-user-friends"></i>
                    <p>Members</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ Request::is('member', 'volunteer') ? 'show' : '' }}" id="Members">
                    <ul class="nav nav-collapse">
                        <li class="{{ Request::is('member') ? 'active' : '' }}">
                            <a href="/member">
                                <span class="sub-item">Members</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('volunteer') ? 'active' : '' }}">
                            <a href="/volunteer">
                                <span class="sub-item">Volunteers</span>
                            </a>
                        </li>
                    </ul>
                </div>
              </li>
              <li class="nav-item {{ Request::is('donation', 'collection', 'payment') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#Finances">
                    <i class="fas fa-hand-holding-usd"></i>
                    <p>Finances</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ Request::is('donation', 'collection', 'payment') ? 'show' : '' }}" id="Finances">
                    <ul class="nav nav-collapse">
                        <li class="{{ Request::is('donation') ? 'active' : '' }}">
                            <a href="/donation">
                                <span class="sub-item">Donation</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('collection') ? 'active' : '' }}">
                            <a href="/collection">
                                <span class="sub-item">Collection</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('payment') ? 'active' : '' }}">
                            <a href="/payment">
                                <span class="sub-item">Payment</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
              <li class="nav-item {{ Request::is('schedules') ? 'active' : '' }}">
                <a href="/schedules">
                  <i class="fas fa-calendar-alt"></i>
                  <p>Calendar</p>
                  
                </a>
              </li>
              <li class="nav-item {{ Request::is('archive') ? 'active' : '' }}">
                <a href="/archive">
                  <i class="fas fa-archive"></i>
                  <p>Archive</p>
                  
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="white">
              <a href="index.html" class="logo">
              <img
                    src="{{ asset('assets/img/kaiadmin/logo.png') }}"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
       
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
         
              <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                
              </nav>

              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false">
                    <div class="avatar-sm">
                    <img
                        src="{{ asset('assets/img/face1.jpg') }}"
                        alt="..."
                        class="avatar-img rounded-circle"
                    />
                    </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                          <img
                                src="{{ asset('assets/img/face1.jpg') }}"
                                alt="..."
                                class="avatar-img rounded-circle"
                            />
                          </div>
                          <div class="u-text">
                            <h4>{{ Auth::user()->name }}</h4>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                            <a
                              href="profile.html"
                              class="btn btn-xs btn-secondary btn-sm"
                              >View Profile</a
                            >
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">My Balance</a>
                        <a class="dropdown-item" href="#">Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
            
          </nav>
       
        
          @yield('content')
        </div>
       
    </div>
    
  
  
   
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/core/main.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
<script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    
   
    

   

<script>
function showImagePreview(event) {
    const input = event.target;
    const file = input.files[0];
    const imagePreview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.src = '#';
        imagePreview.style.display = 'none';
    }
}
</script>
<script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,
        });
        $("#member-table").DataTable({
          pageLength: 5,
        });

        // Initialize Volunteers Table
        $("#volunteer-table").DataTable({
          pageLength: 5,
        });
        $("#donation-table").DataTable({
            pageLength: 5,
        });

        $("#collection-table").DataTable({
            pageLength: 5,
        });

        $("#payment-table").DataTable({
            pageLength: 5,
        });
        $('#baptisms-table').DataTable({
            pageLength: 5,
        });
        $('#books-table').DataTable({
            pageLength: 5,
        });
        $('#records-table').DataTable({
            pageLength: 5,
        });
        $('#confirmation-table').DataTable({
            pageLength: 5,
        });

        $('#confirmation-record-table').DataTable({
            pageLength: 5,
        });
        $('#wedding-record-row').DataTable({
            pageLength: 5,
        });

        $('#wedding-row').DataTable({
            pageLength: 5,
        });



        
      });
    </script>
    
    <script>
      $(document).ready(function () {
    let provinceMap = {};

    // Function to populate provinces for a given select element
    function populateProvinces(provinceSelector) {
        fetch('https://psgc.gitlab.io/api/provinces/')
            .then(response => response.json())
            .then(data => {
                let provinceOptions = '<option value="">Select Province</option>';
                data.forEach(function (province) {
                    // Store the province code by its name
                    provinceMap[province.name] = province.code;
                    provinceOptions += `<option value="${province.name}">${province.name}</option>`;
                });
                $(provinceSelector).html(provinceOptions);
            });
    }

    // Populate provinces for existing fields on page load
    populateProvinces('#fatherProvince');
    populateProvinces('#motherProvince');
    populateProvinces('#childProvince');
    populateProvinces('#residenceProvince');
    populateProvinces('#updateGroomProvince');
    populateProvinces('#updateBrideProvince');

    // Function to populate cities based on the selected province name
    function populateCities(provinceSelector, citySelector) {
        const selectedProvinceName = $(provinceSelector).val();
        const provinceCode = provinceMap[selectedProvinceName]; // Get code from map using name

        if (provinceCode) {
            fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
                .then(response => response.json())
                .then(data => {
                    let cityOptions = '<option value="">Select City/Municipality</option>';
                    data.forEach(function (city) {
                        cityOptions += `<option value="${city.name}">${city.name}</option>`;
                    });
                    $(citySelector).html(cityOptions);
                });
        } else {
            $(citySelector).html('<option value="">Select City/Municipality</option>');
        }
    }

    // Event listeners for province selection change
    $('#fatherProvince').change(function () {
        populateCities('#fatherProvince', '#fatherCity');
    });

    $('#motherProvince').change(function () {
        populateCities('#motherProvince', '#motherCity');
    });

    $('#childProvince').change(function () {
        populateCities('#childProvince', '#childCity');
    });

    $('#residenceProvince').change(function () {
        populateCities('#residenceProvince', '#residenceCity');
    });
    $('#updateGroomProvince').change(function () {
        populateCities('#updateGroomProvince', '#updateGroomCity');
    });
    $('#updateBrideProvince').change(function () {
        populateCities('#updateBrideProvince', '#updateBrideCity');
    });
});

      </script>
          
  </body>
</html>