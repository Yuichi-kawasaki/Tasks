@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- フラッシュメッセージを表示 --}}
        @if (session('success'))
            <div class="alert alert-success " style="color: blue;">
                {{ session('success') }}
            </div>
        @endif
        <h1>Tasks</h1>
        @if ($tasks->isEmpty())
            <p>No tasks found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Deadline</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td class="text-center">{{ $task->title }}</td>
                            <td class="text-center">{{ $task->status }}</td>
                            <td class="text-center">{{ $task->deadline }}</td>
                            <td class="text-center">
                                <!-- <div class="d-flex justify-content-center"> -->
                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-primary mr-2">show</a>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning mr-2">edit</a>
                                    <a href="{{ route('tasks.destroy', $task->id) }}"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this task?')){ document.getElementById('delete-form-{{ $task->id }}').submit(); }"
                                        class="btn btn-sm btn-danger mr-2">
                                        destroy
                                    </a>
                                    <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                <!-- </div> -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">New Task</a>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this task?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
