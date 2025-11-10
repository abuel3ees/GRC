@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-accent-400 fw-bold fs-3">Edit Risk – {{ $cyberrisk->code }}</h1>
        <a href="{{ route('admin.cyberrisks.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <form method="POST" action="{{ route('admin.cyberrisks.update', $cyberrisk) }}" class="bg-dark p-4 rounded-3 shadow-sm">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-2">
                <label class="form-label">Code</label>
                <input type="text" value="{{ $cyberrisk->code }}" class="form-control" disabled>
            </div>
            <div class="col-md-10">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $cyberrisk->title }}" required>
            </div>

            <div class="col-12">
                <label class="form-label">Risk Statement</label>
                <textarea name="risk_statement" class="form-control" rows="2" required>{{ $cyberrisk->risk_statement }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Cause</label>
                <textarea name="cause" class="form-control" rows="2">{{ $cyberrisk->cause }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Consequence</label>
                <textarea name="consequence" class="form-control" rows="2">{{ $cyberrisk->consequence }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Existing Control</label>
                <textarea name="existing_control" class="form-control" rows="2">{{ $cyberrisk->existing_control }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Mitigation Plan</label>
                <textarea name="mitigation_plan" class="form-control" rows="2">{{ $cyberrisk->mitigation_plan }}</textarea>
            </div>

            <div class="col-md-3">
                <label class="form-label">Likelihood</label>
                <input type="number" name="likelihood" class="form-control" min="1" max="5" value="{{ $cyberrisk->likelihood }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Impact</label>
                <input type="number" name="impact" class="form-control" min="1" max="5" value="{{ $cyberrisk->impact }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Score</label>
                <input type="number" name="score" class="form-control" value="{{ $cyberrisk->score }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Residual Level</label>
                <select name="residual_level" class="form-select">
                    <option value="High" @selected($cyberrisk->residual_level=='High')>High</option>
                    <option value="Medium" @selected($cyberrisk->residual_level=='Medium')>Medium</option>
                    <option value="Low" @selected($cyberrisk->residual_level=='Low')>Low</option>
                </select>
            </div>
        </div>

        <button class="btn btn-accent mt-4">Update Risk</button>
    </form>
@endsection
