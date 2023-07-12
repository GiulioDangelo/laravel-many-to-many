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
            <h6>technologies</h6>
            @foreach ($technologies as $technology)
            <div class="form-check">
                <input 
                type="checkbox" 
                class="form-check-input" 
                    id="technology{{ $technology->id }}" 
                    name="technologies[]"
                    value="{{ $technology->id }}"
                    @if (in_array($technology->id, old('technologies', $project->technologies->pluck('id')->all()))) checked @endif 
                >
                <label class="form-check-label" for="technology{{ $technology->id }}">
               {{ $technology->name }}
                </label>
            </div>
            @endforeach
        </div> 

            {{-- @dump($errors->get('technologies.*')) --}}
            {{-- @error('technologies')
                <div class="">
                    {{ $message }}
                </div>
            @enderror --}}

        <button class="btn btn-primary">Update</button>
    </form>

@endsection