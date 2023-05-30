@extends('layouts.back')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Tipologie') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">N° Projects</th>
                        <!--<th scope="col">Actions</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td>{{ count($type->projects) }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
              </table>
                <!--
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
                -->
        </div>
    </div>
</div>
@endsection