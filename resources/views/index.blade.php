
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <x-card cardTitle="Ingresa la URL">
                    @section('card-body')
                        <form method="get">
                            <div class="mb-3 mx-lg-5">
                                <input type="text" class="form-control" id="url" name="url" placeholder="http://mywebsite.com">
                            </div>
                            <div class="mb-3 mx-lg-5">
                                <button type="button" id="submit-button" onclick="getEntities()" class="btn btn-primary" required>
                                    Buscar entidades
                                </button>
                            </div>
                            <div class="mb-3 mx-lg-5 d-none" id="error-message">
                                <div class="alert alert-danger" role="alert">
                                    Hay campos requeridos vacíos. Por favor, rellene todos los campos.
                                </div>
                            </div>
                        </form>
                    @endsection
                </x-card>
                <div class="d-flex justify-content-center visually-hidden" id="spinner-container">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table id="entities-table" class="table table-striped table-hover d-none" style="width:60%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script>

    function getEntities() {
        $("#entities-table").addClass("d-none");
        $("#error-message").addClass("d-none");

        if($( "#url" ).val().trim() === "") {
            $("#error-message").removeClass("d-none");
            return;
        }

        $("#spinner-container").removeClass("visually-hidden");
        $("#submit-button").addClass("disabled");

        $('#entities-table').DataTable( {
            ajax: {
                url: '/api/entities',
                method: 'get',
                dataType: 'json',
                data: {
                    url: $( "#url" ).val(),
                },
                dataSrc: function (data) {
                    return data.data;
                },
                error: function(e) {
                    console.log(e);
                },
                complete: function() {
                    $("#spinner-container").addClass("visually-hidden");
                    $("#submit-button").removeClass("disabled");
                    $("#entities-table").removeClass("d-none").addClass("display");
                }
            },
            columns: [
                { data: 'name' },
                { data: 'type_' },
            ]
        } );
    }
</script>


