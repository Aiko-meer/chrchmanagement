<!DOCTYPE html>
<html>
 <head>
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Church Mangament System</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon"/>
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
        
                events: booking,
                selectable: true,
                selectHelper: true,
                
                select: function(start, end, allDays) {
                    $('#bookingModal').modal('toggle');

                    $('#saveBtn').click(function() {
                      var title = $('#title').val();
                      var description = $('#description').val();
                      var start_date = moment(start).format('YYYY-MM-DD HH:mm:ss');
                      var end_date = moment(end).format('YYYY-MM-DD HH:mm:ss');

                      $.ajax({
                          url: "{{ route('calendar.store') }}",
                          type: "POST",
                          dataType: 'json',
                          data: { title, description, start_date, end_date },
                          success: function(response) {
                              $('#bookingModal').modal('hide');
                              $('#calendar').fullCalendar('renderEvent', {
                                  'id': response.id,
                                  'title': response.title,
                                  'description': response.description,
                                  'start': response.start,
                                  'end': response.end,
                                  'color': response.color
                              });
                          },
                          error: function(error) {
                              if (error.responseJSON.errors) {
                                  $('#titleError').html(error.responseJSON.errors.title);
                                  $('#descriptionError').html(error.responseJSON.errors.description);
                              }
                          },
                      });
                  });
                },
                editable: true,
                eventDrop: function(event) {
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
                    var end_date = moment(event.end).format('YYYY-MM-DD HH:mm:ss');

                    $.ajax({
                            url:"{{ route('calendar.update', '') }}" +'/'+ id,
                            type:"PATCH",
                            dataType:'json',
                            data:{ start_date, end_date  },
                            success:function(response)
                            {
                                swal("Good job!", "Event Updated!", "success");
                            },
                            error:function(error)
                            {
                                console.log(error)
                            },
                        });
                },
                                eventResize: function(event) {
                    // Triggered when the event's time is adjusted by resizing
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
                    var end_date = moment(event.end).format('YYYY-MM-DD HH:mm:ss');

                    $.ajax({
                        url: "{{ route('calendar.update', '') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        data: { start_date, end_date },
                        success: function(response) {
                            swal("Good job!", "Event Updated!", "success");
                        },
                        error: function(error) {
                            console.log(error);
                        },
                    });
                },
                eventClick: function(event) {
                  var id = event.id;
                  var title = event.title;
                  var description = event.description;
                  $('#eventStart').text(moment(event.start).format('MMMM DD, YYYY - hh:mm A') || 'N/A');
                  $('#eventEnd').text(event.end ? moment(event.end).format('MMMM DD, YYYY - hh:mm A') : 'N/A');

                  // Create a modal dynamically if it doesn't exist
                  if (!$('#eventInfoModal').length) {
                      $('body').append(`
                          <div class="modal fade" id="eventInfoModal" tabindex="-1" role="dialog" aria-labelledby="eventInfoModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="eventInfoModalLabel">Event Details</h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <p><strong>Title:</strong> <span id="eventTitle"></span></p>
                                          <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                                          <p><strong>Start:</strong> <span id="eventStart"></span></p>
                                          <p><strong>End:</strong> <span id="eventEnd"></span></p>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" id="deleteEvent">Delete</button>
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      `);
                  }

                  // Populate modal with event details
                  $('#eventTitle').text(title);
                  $('#eventDescription').text(description);

                  // Show the modal
                  $('#eventInfoModal').modal('show');

                  // Handle the Delete button click
                  $('#deleteEvent').off('click').on('click', function() {
                      $.ajax({
                          url: "{{ route('calendar.destroy', '') }}" + '/' + id,
                          type: "DELETE",
                          dataType: 'json',
                          success: function(response) {
                              $('#calendar').fullCalendar('removeEvents', id);
                              $('#eventInfoModal').modal('hide');
                              swal("Deleted!", "Event has been deleted.", "success");
                          },
                          error: function(error) {
                              console.log(error);
                              swal("Error!", "Unable to delete the event.", "error");
                          },
                      });
                  });
              },
                



            });


            $("#bookingModal").on("hidden.bs.modal", function () {
                $('#saveBtn').unbind();
            });

            
     
        });
    </script>
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
          
  <br />
  <div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Calendar</h3>
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
                <a href="/schedules">Calendar</a>
            </li>
          
            
            
            
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Calendar</h4>
                               
                            </div>
                        </div>
                        <div class="card-body">
                       
                        <div id="calendar"></div>
                        </div>
                        <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form id="bookingForm">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title">Event Title</label>
                                                <input type="text" class="form-control" id="title" name="title">
                                                <span id="titleError" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Event Description</label>
                                                <textarea class="form-control" id="description" name="description"></textarea>
                                                <span id="descriptionError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="saveBtn" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        </div>
                </div>
                

                
            </div>
  </div>
  </div>@include('layouts.footer')
 
       
    </div>
  
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/core/main.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->


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
 </body>
</html>