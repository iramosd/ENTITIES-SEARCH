
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

                <x-card cardTitle="Ingresa la URL">
                    @section('card-body')
                        <form>
                            <div class="mb-3 mx-lg-5">
                                <input type="text" class="form-control" id="url" name="url" placeholder="http://mywebsite.com">
                            </div>
                            <div class="mb-3 mx-lg-5">
                                <button type="submit" class="btn btn-primary">Iniciar búsqueda</button>
                            </div>
                        </form>
                    @endsection
                </x-card>

            </div>
        </div>
    </div>
@stop
