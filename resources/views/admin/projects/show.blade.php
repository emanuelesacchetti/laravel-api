@extends('layouts.back')

@section('content')

<div class="container">
    <div class="row">
        <div class="col my-3 p-4 border">
            <h1>{{ $project->title }}</h1>

            <img src="{{ asset('storage/' . $project->cover_img)  }}" class="img-fluid my_img_show" alt="{{ $project->title }}">
            <h6>Slug: {{ $project->slug }}</h6>
            <h4>Tipologia: {{ $project->type?$project->type->name:'Nessuna tipologia' }}</h4>
            <h4>Creato il: {{ $project->date }}</h4>
            <p>{{ $project->content }}</p>
            <br>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna alla lista dei progetti</a>
        </div>

    </div>
</div>
@endsection
