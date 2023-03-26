@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- フラッシュメッセージを表示 --}}
        @if (session('success'))
            <div class="alert alert-success" style="color: blue;">   
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $task->title }}</div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $task->description }}</p>
                        <p><strong>Status:</strong> {{ $task->status }}</p>
                        <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
                    </div>
                    <div class="card-footer">
                        {{-- 編集ボタンを追加 --}}
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                        {{-- 削除ボタンを追加 --}}
                        <a href="{{ route('tasks.destroy', $task->id) }}"
                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this task?')){ document.getElementById('delete-form-{{ $task->id }}').submit(); }"
                            class="btn btn-sm btn-danger mr-2">
                            destroy
                        </a>
                        <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>


                        {{-- 戻るボタンを追加 --}}
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this task?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
