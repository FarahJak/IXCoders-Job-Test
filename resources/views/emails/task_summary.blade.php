<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Summary</title>
</head>

<body>
    <h1>Your Daily Task Summary</h1>
    <ul>
        @forelse ($tasks as $task)
            <li>{{ $task->name }} - {{ $task->status }}</li>
        @empty
            <li>No tasks for today.</li>
        @endforelse
    </ul>
</body>

</html>
