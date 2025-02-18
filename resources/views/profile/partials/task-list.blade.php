<!-- filepath: /d:/ukk/todolist/resources/views/profile/partials/task-list.blade.php -->
<div class="task-list" id="task-list">
    @foreach ($tasks->sortBy('due_date')->groupBy('due_date') as $date => $tasksByDate)
        <h5>{{ \Carbon\Carbon::parse($date)->format('l, Y-m-d') }}</h5>
        @foreach ($tasksByDate as $task)
            <div class="task-card" data-toggle="modal" data-target="#taskModal{{ $task->id }}">
                <div class="task-status {{ strtolower($task->priority) }}">
                    {{ ucfirst($task->priority) }}
                </div>
                <div class="task-name">
                    {{ $task->task_name }} 
                </div>
                <div class="badge badge-secondary">
                    {{ $task->days_left }} days left
                </div>
              
                <div class="task-description">
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
                            <h5 class="modal-title" id="taskModalLabel{{ $task->id }}">{{ $task->task_name }}</h5>
                            <div class="badge badge-secondary">
                                {{ $task->days_left }} days left
                            </div>
                        </div>
                        <div class="modal-body">
                            <p>{{ $task->description }}</p>
                            <p><strong>{{ __('Deadline:') }}</strong> {{ $task->due_day }}, {{ $task->due_date }}</p>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div class="task-actions d-flex justify-content-start">
                                <div class="btn-group d-flex justify-content-start gap-2">
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn rounded btn-danger btn-sm btn-rounded">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn rounded btn-warning btn-sm btn-rounded" onclick="confirmEdit(event)">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <form method="POST" action="{{ route('tasks.done', $task->id) }}" onsubmit="confirmDone(event)">
                                    @csrf
                                    <button type="submit" class="btn rounded btn-success btn-sm btn-rounded">{{ __('Done') }}</button>
                                </form>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>