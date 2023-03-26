@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mb-5">タスクを編集</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option {{ $task->status == 'todo' ? 'selected' : '' }}>todo</option>
                            <option {{ $task->status == 'doing' ? 'selected' : '' }}>doing</option>
                            <option {{ $task->status == 'doing' ? 'selected' : '' }}>doing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $task->deadline }}" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">タスクを更新</button>
                        {{-- 戻るボタンを追加 --}}
                        <a href="javascript:history.back()" class="btn btn-secondary ml-3">back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
