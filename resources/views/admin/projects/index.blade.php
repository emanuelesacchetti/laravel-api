@extends('layouts.back')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Progetti') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Tipologia</th>
                        <th scope="col">Cover_img</th>
                        <th scope="col">Date</th>
                        <th scope="col">Slug</th>
                        <th scope='col'>Tecnologia</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->type?->name }}</td>
                        <td>
                            @if ($project->cover_img)

                            @endif
                            <img src="{{ asset('storage/' . $project->cover_img) }}" class='my_img_index' alt=""></td>
                        <td>{{ $project->date }}</td>
                        <td>{{ $project->slug }}</td>
                        <td>
                            @foreach ($project->technologies as $technology)
                                {{ $technology->name }}
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.projects.show', $project->slug) }}">VEDI</a>
                            <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project->slug) }}">MODIFICA</a>

                            <form class="form_delete_project" action="{{route('admin.projects.destroy', ['project' => $project->slug])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
              </table>

                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Confermi di voler eliminare l'elemento selezionato?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger">Conferma eliminazione</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
