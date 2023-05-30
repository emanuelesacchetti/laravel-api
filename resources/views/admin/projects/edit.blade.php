@extends('layouts.back')

@section('content')
    <h3>Modifica questo progetto</h3>
    <form action="{{ route('admin.projects.update', ['project'=> $project->slug]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $project->title) }}">
            @error('title')
                <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Seleziona tipologia</label>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                <option @selected(old('type_id', $project->type_id)=='') value="">Nessuna tipologia</option>
                @foreach ($types as $type)
                    <option @selected(old('type_id', $project->type_id)== $type->id) value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover_img" class="form-label">Cambia un'immagine di copertina</label>
            @if ($project->cover_img)
                <img src="{{ asset('storage/' . $project->cover_img)  }}" class="img-fluid d-block my_img_edit" alt="{{ $project->title }}">
            @else
                <input type="file" class="form-control @error('cover_img') is-invalid @enderror" id="cover_img" name="cover_img">
            @endif
            @error('cover_img')
                <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Data di creazione</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $project->date) }}">
            @error('date')
                <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Descizione</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="5" name="content">{{ old('content', $project->content) }}</textarea>
            @error('content')
                <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for=""></label>
            @foreach ($technologies as $technology)

                @if ($errors->any())
                    <input @if (in_array($technology->id, old('technologies', []))) checked @endif id="technology_{{ $technology->id }}" type="checkbox" name="technologies[]"  value="{{ $technology->id }}">
                @else
                    <input @if ($project->technologies->contains($technology->id)) checked @endif id="technology_{{ $technology->id }}" type="checkbox" name="technologies[]"  value="{{ $technology->id }}">
                @endif

                <label for="technology_{{ $technology->id }}" class="form-label">{{ $technology->name }}</label>
                <br>
            @endforeach
            @error('technologies')
                <div class='invalid-feedback'>{{ $message }}</div>
            @enderror
        </div>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna alla lista dei progetti</a>

        <button class="btn btn-primary" type="submit">Conferma modifica</button>
    </form>

@endsection
