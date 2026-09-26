<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            color: #222;
        }

        .add-button {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #e5e7eb;
        }

        .status {
            font-weight: bold;
        }

        .actions a,
        .actions button {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .edit {
            background: #f59e0b;
            color: white;
        }

        .delete {
            background: #dc2626;
            color: white;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #666;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Personal Task Manager</h1>

    <a href="/tasks/create" class="add-button">
    + Add Task
    </a>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($tasks->count() > 0)

        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->task_name }}</td>

                        <td>{{ $task->description ?? 'No description' }}</td>

                        <td class="status">
                            {{ $task->status }}
                        </td>

                        <td>
                            {{ $task->due_date ?? 'No due date' }}
                        </td>

                        <td class="actions">

                            <a href="/tasks/{{ $task->id }}/edit" class="edit">
    Edit
</a>

                            <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="delete"
                                        onclick="return confirm('Delete this task?')">
                                    Delete
                                </button>

                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <div class="empty">
            <h3>No tasks yet.</h3>
            <p>Click "Add Task" to create your first task.</p>
        </div>

    @endif

</div>

</body>
</html>