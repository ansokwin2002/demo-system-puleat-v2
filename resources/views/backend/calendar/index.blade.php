@extends('backend.master')
@section('content')

<div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        @include('backend.body.navbar')
    </nav>
    <div class="main-sidebar sidebar-style-2">
        @include('backend.body.aside')
    </div>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Modern Calendar</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Calendar</a></div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal for Event -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Event Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="eventForm">
                    @csrf
                    <input type="hidden" id="eventId">
                    <input type="hidden" name="_method" id="methodField" value="POST">
                    
                    <div class="form-group">
                        <label for="eventTitle">Event Title</label>
                        <input type="text" class="form-control" id="eventTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="start" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="end">
                    </div>
                    <div class="form-group">
                        <label for="eventColor">Pick a Color</label>
                        <input type="color" class="form-control" id="eventColor" name="color" value="#6777ef">
                    </div>
                    <div class="form-group">
                        <label for="eventDesc">Description</label>
                        <textarea class="form-control" id="eventDesc" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </form>

                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        @include('backend.body.footer')
    </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
        selectable: true,

        // Load events from the server
        events: {
            url: '/calendar/events',
            failure: function() {
                console.error('Failed to fetch events.');
            }
        },

        // Show modal on date click
        dateClick: function(info) {
            document.getElementById('eventForm').reset();
            document.getElementById('startDate').value = info.dateStr;
            document.getElementById('endDate').value = info.dateStr;
            document.getElementById('methodField').value = 'POST'; // Reset to POST for new events
            $('#eventModal').modal('show');
        },

        // Edit event on event click
        eventClick: function(info) {
            var event = info.event;
            var eventId = event.id;

            // Fetch event details from the server
            $.ajax({
                url: '/calendar/show/' + eventId,
                type: 'GET',
                success: function(eventData) {
                    console.log('Fetched event data:', eventData);
                    document.getElementById('eventId').value = eventData.id;
                    document.getElementById('eventTitle').value = eventData.title;
                    document.getElementById('startDate').value = eventData.start;
                    document.getElementById('endDate').value = eventData.end || eventData.start;
                    document.getElementById('eventColor').value = eventData.color;
                    document.getElementById('eventDesc').value = eventData.description;
                    document.getElementById('methodField').value = 'PUT'; // Change to PUT for updates
                    $('#eventModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching event details:', error);
                }
            });
        }
    });

    calendar.render();

    // Handle form submission (add or update event)
    $('#eventForm').on('submit', function(event) {
        event.preventDefault();

        var eventId = $('#eventId').val();
        var method = eventId ? 'PUT' : 'POST';
        var url = eventId ? '/calendar/update/' + eventId : '/calendar/store';

        var eventData = {
            _token: $('meta[name="csrf-token"]').attr('content'), // Ensure CSRF token is included
            title: $('#eventTitle').val(),
            start: $('#startDate').val(),
            end: $('#endDate').val() || $('#startDate').val(),
            color: $('#eventColor').val(),
            description: $('#eventDesc').val()
        };

        $.ajax({
            url: url,
            type: method,
            data: eventData,
            success: function(response) {
                console.log('Event saved successfully:', response);
                calendar.refetchEvents(); // Refresh the calendar to include the new event
                $('#eventModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Error saving event:', error);
            }
        });
    });
});


</script>

@endsection
