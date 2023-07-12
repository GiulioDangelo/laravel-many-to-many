@extends('admin.layouts.base')

@section('contents')

    <h1>{{ $project->title }}</h1>
    <img src="{{ $project->url_image }}" alt="{{ $project->title }}">
    <p>{{ $project->content }}</p>
    <h3>Technologies: {{ implode(',', $project->technologies->pluck('name')->all()) }}</h3>
    {{-- <p>{{ $project->type->name }}</p> --}}

@endsection