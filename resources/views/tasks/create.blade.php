@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="mb-0">New task</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="status" name="status">
                                        <option>todo</option>
                                        <option>doing</option>
                                        <option>done</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deadline" class="col-md-4 col-form-label text-md-right">Deadline</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="deadline" name="deadline" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Create Task</button>
                                        <a href="javascript:history.back()" class="btn btn-secondary">back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
