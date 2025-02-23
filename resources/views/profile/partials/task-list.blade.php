<!-- filepath: /d:/ukk/todolist/resources/views/profile/partials/task-list.blade.php -->
<style>
    .task-card {
        background: #F8F7F3;
    }
    .modal-body {
        max-height: 400px;
        overflow-y: auto;
        word-wrap: break-word;
    }
    .task-description {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Number of lines to show */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .priority-low {
        background-color: rgb(255, 234, 0);
        color: black;
        padding: 4px 8px;
        text-align: center;
        border-radius: 5px;
    }
    .priority-medium {
        background-color: orange;
        color: black;
        padding: 4px 8px;
        text-align: center;
        border-radius: 5px;
    }
    .priority-urgent {
        background-color: red;
        color: white;
        padding: 4px 8px;
        text-align: center;
        border-radius: 5px;
    }
</style>
<!-- filepath: /d:/ukk/todolist/resources/views/profile/partials/task-list.blade.php -->
<div class="task-list" id="task-list">
    @foreach ($tasks->sortBy('due_date')->groupBy('due_date') as $date => $tasksByDate)
        <h5>{{ \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dddd, D-M-YYYY') }}</h5>
        @foreach ($tasksByDate as $task)
            <div class="task-card" data-toggle="modal" data-target="#taskModal{{ $task->id }}">
                <div class="task-status {{ strtolower($task->priority) }}">
                    {{ ucfirst($task->priority) }}
                </div>
                <div class="task-name">
                    {{ $task->task_name }}
                </div>
                <div class="badge badge-secondary">
                    {{ $task->days_left }} hari lagi
                </div>
                <div class="task-description" id="task-desc-{{ $task->id }}">
                    {{ $task->description }}
                </div>
                <div class="task-due-date">
                    {{ $task->due_day }}, {{ $task->due_date }}
                </div>
            </div>

            <!-- Task Modal -->
            <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title" id="taskModalLabel{{ $task->id }}">
                                    <span class="priority-{{ strtolower($task->priority) }}">{{ ucfirst($task->priority) }}</span> - {{ $task->task_name }}
                                </h5>
                                <div class="badge badge-light text-success">
                                    {{ $task->days_left }} hari lagi
                                </div>
                            </div>
                            <button type="button" class="btn text-light fw-bold" data-dismiss="modal">{{ __('X') }}</button>
                        </div>
                        <div class="modal-body">
                            <p>{{ $task->description }}</p>
                            <p><strong>{{ __('Batas Waktu:') }}</strong> {{ $task->due_day }}, {{ $task->due_date }}</p>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div class="task-actions d-flex justify-content-start">
                                <div class="d-flex col-8 justify-content-between">
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn rounded btn-danger btn-sm btn-rounded pe-2">
                                            <i class="fa fa-trash pe-2"></i>
                                        </button>
                                    </form>
                                    <div class="ps-2">
                                        <button class="btn rounded btn-warning btn-sm btn-rounded ps-2" data-toggle="modal" data-target="#editTaskModal{{ $task->id }}">
                                            <i class="fa fa-pencil ps-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('tasks.done', $task->id) }}" onsubmit="confirmDone(event)">
                                @csrf
                                <button type="submit" class="btn rounded btn-success btn-sm btn-rounded">{{ __('Selesai') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Task Modal -->
            <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTaskModalLabel{{ $task->id }}">{{ __('Edit Tugas') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="task_name">{{ __('Nama Tugas') }}</label>
                                    <input type="text" class="form-control" id="task_name" name="task_name" value="{{ $task->task_name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Deskripsi') }}</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $task->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="priority">{{ __('Prioritas') }}</label>
                                    <select class="form-control" id="priority" name="priority" required>
                                        <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>{{ __('Rendah') }}</option>
                                        <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>{{ __('Sedang') }}</option>
                                        <option value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>{{ __('Tinggi') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="due_date">{{ __('Batas Waktu') }}</label>
                                    <input type="date" class="form-control" id="due_date_{{ $task->id }}" name="due_date" value="{{ $task->due_date }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

<script>
    $(document).ready(function() {
        // Set the minimum date for the date input to today
        var today = new Date().toISOString().split('T')[0];
        @foreach ($tasks as $task)
            document.getElementById("due_date_{{ $task->id }}").setAttribute("min", today);
        @endforeach

        // Limit description length to 15 characters
        @foreach ($tasks as $task)
            var descElement = document.getElementById("task-desc-{{ $task->id }}");
            var descText = descElement.innerText;
            if (descText.length > 15) {
                descElement.innerText = descText.substring(0, 15) + "...";
            }
        @endforeach
    });
</script>