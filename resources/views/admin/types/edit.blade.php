@extends('admin.layouts.base')

@section('contents')

    <h1>Edit project</h1>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form method="POST" action="{{ route('admin.projects.update', ['project' => $project]) }}" novalidate>
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="type" class="form-label">type</label>
            <select
                class="form-select @error('type_id') is-invalid @enderror"
                id="type"
                name="type_id"
            >
                @foreach ($types as $type)
                    <option
                        value="{{ $type->id }}"
                        @if (old('type_id', $project->type) == $type->id) selected @endif
                    >{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

            @dump($errors->get('technologies.*'))
            {{-- @error('technologies')
                <div class="">
                    {{ $message }}
                </div>
            @enderror --}}

        <button class="btn btn-primary">Update</button>
    </form>

@endsection