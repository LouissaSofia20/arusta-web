<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Calendar</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <div id="modal-action" class="modal" tabindex="-1"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const modal = $('#modal-action');
        const csrfToken = $('meta[name=csrf_token]').attr('content');
        const isLoggedIn = @json(auth()->check());

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: `{{ route('events.list') }}`,
            editable: false,
            dateClick: function (info) {
                $.ajax({
                    url: `{{ route('events.list') }}`,
                    data: {
                        date: info.dateStr
                    },
                    success: function (res) {
                        modal.html(res).modal('show');

                        $('#register-event-btn').on('click', function () {
                            if (isLoggedIn) {
                                $.ajax({
                                    url: `{{ route('events.create') }}`,
                                    data: {
                                        start_date: info.dateStr,
                                        end_date: info.dateStr,
                                    },
                                    success: function (res) {
                                        modal.html(res).modal('show');
                                        $('.datepicker').datepicker({
                                            todayHighlight: true,
                                            format: 'yyyy-mm-dd'
                                        });

                                        $('#form-action').on('submit', function (e) {
                                            e.preventDefault();
                                            const form = this;
                                            const formData = new FormData(form);
                                            $.ajax({
                                                url: form.action,
                                                method: form.method,
                                                data: formData,
                                                processData: false,
                                                contentType: false,
                                                success: function (res) {
                                                    modal.modal('hide');
                                                    calendar.refetchEvents();
                                                },
                                                error: function (res) {
                                                    console.error("AJAX error:", res);
                                                }
                                            });
                                        });
                                    },
                                });
                            } else {
                                iziToast.warning({
                                    title: 'Login Required',
                                    message: 'Please log in to register an event.',
                                    position: 'topRight'
                                });
                                window.location.href = '/login';
                            }
                        });
                    },
                    error: function (res) {
                        console.error("AJAX error:", res);
                    }
                });
            },
        });

        calendar.render();
    });

    </script>
</body>
</html>
