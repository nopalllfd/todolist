<!-- filepath: /d:/ukk/todolist/resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Dashboard</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }
        .navbar {
            background-color: #F8F7F3; /* Green background color for the navbar */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white; /* White text color for the navbar links */
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #d4d4d4; /* Light grey color for the navbar links on hover */
        }
        input:focus, input.form-control:focus, textarea:focus, textarea.form-control:focus, select:focus, select.form-control:focus {
            outline: none !important;
            outline-width: 0 !important;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
        }
        .card-header {
            background-color: #28a745;
            color: white;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .container {
            border-top: 1px solid #28a745; 
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-rounded {
            border-radius: 50px;
        }
        .modal-header {
            background-color: #28a745;
            color: white;
        }
        .modal-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .task-card {
            position: relative;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 1rem;
            background-color: #fff;
            cursor: pointer;
        }
        .task-card .task-status {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 0.25rem 0.5rem;
            border-radius: 5px;
            color: #fff;
            font-size: 0.875rem;
            font-weight: bold;
        }
        .task-card .task-status.urgent {
            background-color: #dc3545; /* Red for urgent */
        }
        .task-card .task-status.medium {
            background-color: #ffc107; /* Orange for medium */
        }
        .task-card .task-status.low {
            background-color: #ffeb3b; /* Yellow for low */
            color: #000;
        }
        .task-card .task-name {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .task-card .task-days-left {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        .task-card .task-due-date {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .task-card .task-description {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #6c757d;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .task-card .task-actions {
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
        }
        .task-card .task-actions .btn-group {
            display: flex;
            gap: 5px;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-add-task {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #28a745;
            color: white;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        .btn-add-task:hover {
            background-color: #218838;
        }
        .badge-select {
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-right: 0.5rem;
            transition: background-color 0.3s ease;
        }
        .badge-select.active {
            background-color: #000;
            color: #fff;
        }
        .badge-low {
            background-color: #fff9c4;
            color: #000;
        }
        .badge-low.active {
            background-color: #ffeb3b;
        }
        .badge-medium {
            background-color: #ffe082;
            color: #000;
        }
        .badge-medium.active {
            background-color: #ffc107;
        }
        .badge-urgent {
            background-color: #ef9a9a;
            color: #fff;
        }
        .badge-urgent.active {
            background-color: #dc3545;
        }
        .badge-date {
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-right: 0.5rem;
            background-color: #e0e0e0;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }
        .badge-date.active {
            background-color: #0288d1;
            color: #fff;
        }
        .date-picker {
            display: none;
        }
        .input-group-text {
            background-color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">ToDoList</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Profil Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->profile_photo_url }}"  class="rounded-circle" width="30" height="30">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profil</a>
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a> --}}
                        {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> --}}
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="">
                    <div class="card-body">
                        <!-- Filter Form -->
                        <form id="filterForm" class="mb-4">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <span class="badge badge-date" id="filter-badge"><i class="bi bi-filter-left"></i> Filter</span>
                                    <div id="filter-options" class="mt-2" style="display: none;">
                                        <label for="filter_date">{{ __('Filter by Deadline Date') }}</label>
                                        <input type="date" id="filter_date" name="filter_date" class="form-control mb-2" min="{{ date('Y-m-d') }}">
                                        <label for="filter_priority">{{ __('Filter by Priority') }}</label>
                                        <select id="filter_priority" name="filter_priority" class="form-control">
                                            <option value="">{{ __('All') }}</option>
                                            <option value="low">{{ __('Low') }}</option>
                                            <option value="medium">{{ __('Medium') }}</option>
                                            <option value="urgent">{{ __('Urgent') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <div class="input-group">
                                        <input type="text" id="filter_name" name="filter_name" class="form-control" placeholder="Search...">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="search-icon"><i class="bi bi-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="applyFilter">{{ __('Search') }}</button>
                        </form>

                        <!-- Task List -->
                        <div class="mt-4">
                            <div class="task-list" id="task-list">
                                @include('profile.partials.task-list', ['tasks' => $tasks])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Task Button -->
    <button type="button" class="btn btn-add-task" data-toggle="modal" data-target="#addTaskModal">
        <i class="fa fa-plus"></i>
    </button>

    <!-- Add Task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">{{ __('Tambah Tugas') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('tasks.store') }}" onsubmit="return validateTaskName()">
                        @csrf
                        <div class="form-group">
                            <input id="task_name" placeholder="Ketik nama tugasmu disini..." type="text" maxlength="16" class="fw-bolder form-control fs-3 border-0 rounded @error('task_name') is-invalid @enderror" name="task_name" required >
                            @error('task_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <textarea placeholder="Ketik deskripsinya disini... " id="description" class="form-control fs-4 border-0 rounded @error('description') is-invalid @enderror" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="priority">{{ __('Prioritas') }}</label>
                            <div class="d-flex">
                                <span class="badge badge-select badge-low" data-value="low">{{ __('Low') }}</span>
                                <span class="badge badge-select badge-medium" data-value="medium">{{ __('Medium') }}</span>
                                <span class="badge badge-select badge-urgent" data-value="urgent">{{ __('Urgent') }}</span>
                            </div>
                            <input type="hidden" id="priority" name="priority" value="low">
                            @error('priority')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="due_date">{{ __('Atur tenggat') }}</label>
                            <span class="badge badge-date" id="custom-date-badge"><i class="bi mx-2 bi-calendar-date"></i> Pilih Tanggal</span>
                            <input type="date" id="custom_date_picker" class="form-control date date-picker mt-2" name="due_date_custom" min="{{ date('Y-m-d') }}">
                            <input type="hidden" id="due_date" name="due_date" value="{{ date('Y-m-d') }}">
                            @error('due_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-block btn-rounded">
                                {{ __('Tambah Tugas') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    <script>
        
        $(document).ready(function() {
            let selectedPriority = 'low'; // Default priority

$('.badge-select').click(function() {
    $('.badge-select').removeClass('active');
    $(this).addClass('active');
    selectedPriority = $(this).data('value');
    console.log(selectedPriority);
    document.getElementById("priority").value = selectedPriority;
    document.getElementById("priority").defaultValue = selectedPriority;
    console.log(document.getElementById("priority").value);
});
$('form').submit(function(event) {
        let finalValue = $('#priority').val();
        console.log("Final priority before submit:", finalValue);
        
        // Tambahkan input hidden baru untuk memastikan data terkirim
        $(this).append('<input type="hidden" name="priority" value="' + finalValue + '">');
    });
$('form').submit(function() {
    console.log("Final priority value: " + $('#priority').val());
});
  
            $('#custom-date-badge').on('click', function() {
                $('#custom_date_picker').toggle().focus();
            });

            $('#custom_date_picker').on('change', function() {
                $('#due_date').val($(this).val());
            });

            $('#filter-badge').on('click', function() {
                $('#filter-options').toggle();
            });

            $('#search-icon').on('click', function() {
                $('#applyFilter').click();
            });
        });

        function confirmEdit(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to edit this task.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, edit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }

        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }

        function confirmDone(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to mark this task as done.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, mark it as done!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }

        function validateTaskName() {
            const taskName = document.getElementById('task_name').value;
            const wordCount = taskName.trim().split(/\s+/).length;
            if (wordCount > 15) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Task name cannot exceed 15 words!',
                });
                return false;
            }
            return true;
        }
    </script>
</body>
</html>