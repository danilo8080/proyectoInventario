@extends('plantilla')
@section('info')
    <!-- Modal add caracteristica-->
    <div class="modal fade" id="agregarCaracteristica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva caracteristica</h5>
                    <button type="button" class="btn-close cerrar_modal_caracteristica" data-bs-dismiss="modal" aria-label="Cancelar"></button>
                </div>
                <div class="modal-body">
                    <ul id="saveform_errorList"></ul>
                    <div class="form-group">
                        <label for="">Caracteristica ID</label>
                        <input type="number" class="agregarCaracteristicaId form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="nombre form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <input type="text" class="descripcion form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Dispositivo</label><br>
                        <select class="dispositivo" aria-label="Default select example">
                            <option value="" selected>seleccione un dispositivo</option>
                            @foreach ($dispositivos as $item)
                            <option value="{{ $item->dispositivoId }}">{{ $item->nombre }}</option>         
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cerrar_modal_caracteristica" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary agregar_caracteristica">Guardar </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add caracteristica end-->

<!-- Modal edit caracteristica-->
<div class="modal fade" id="editarCaracteristica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar caracteristica</h5>
                <button type="button" class="btn-close cerrar_modal_caracteristica" data-bs-dismiss="modal" aria-label="Cancelar"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errorList"></ul>
                <div class="form-group">
                    <input type="hidden" id="editarCaracteristicaId" class="caracteristicaId form-control">
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="editarNombre form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Descripcion</label>
                    <input type="text" class="editarDescripcion form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Dispositivo</label><br>
                    <select class="editarDispositivo" aria-label="Default select example">
                        <option value="" selected>seleccione un dispositivo</option>
                        @foreach ($dispositivos as $item)
                        <option value="{{ $item->dispositivoId }}">{{ $item->nombre }}</option>         
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar_modal_caracteristica" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary actualizar_caracteristica">Guardar </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit caracteristica end-->


<!-- Modal delete caracteristica-->
<div class="modal fade" id="eliminarCaracteristica" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar caracteristica</h5>
                <button type="button" class="btn-close cerrar_modal_caracteristica" data-bs-dismiss="modal" aria-label="Cancelar"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errorList"></ul>

                <input type="hidden" id="eliminarCaracteristicaId" class="caracteristicaId form-control">

                <h4>¿Estas seguro que quieres eliminar esta caracteristica?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar_modal_caracteristica" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary eliminar_caracteristica">Continuar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal delete caracteristica end-->

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" ALIGN="center">System electrónic s.a.s </h6>
            <br>
        </div>

        <div class="card-body">
            <div id="success_message"></div>
            <div class="row">
                <div class="col-md-2">
                    <p>Buscar por caracteristica ID: </p>
                    <input type="text" name="caracteristicaId" id="buscarId" class="form-control form-control-mb3" placeholder="ID">
                </div>
                <div class="col-md-2">
                    <p>Buscar por nombre: </p>
                    <input type="text" name="nombre" class="form-control form-control-mb3" id="buscarNombre" placeholder="Nombre">
                </div>
                <div class="col-md-2">
                    <p>Buscar por descripcion: </p>
                    <input type="text" name="descripcion" class="form-control form-control-mb3" id="buscarDescripcion" placeholder="Descripcion">
                </div>
                <div class="col-md-2">
                    <p>Buscar por dispositivo ID: </p>
                    <input type="text" class="form-control form-control-mb3" id="buscarDispositivoId" placeholder="Dispositivo ID">
                </div>
                <div class="col-md-2">
                    <p>Buscar por nombre del dispositivo: </p>
                    <input type="text" class="form-control form-control-mb3" id="buscarNombreDispositivo" placeholder="Nombre Dispositivo">
                </div>
                <div class="col-md-2">
                    <br>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#agregarCaracteristica" style="float: right; margin: 2px" class="btn btn-success"><i class="fa fa-list"></i> Agregar Caracteristica </a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="employedsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Caracteristica ID</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Dispositivo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbodyCaracteristica">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')
<script>
    $(document).ready(function (){

        buscarCaracteristicas();

        function buscarCaracteristicas()
        {
            var data = {
                'buscarId': $('#buscarId').val(),
                'buscarNombre': $('#buscarNombre').val(),
                'buscarDescripcion': $('#buscarDescripcion').val(),
                'buscarDispositivoId': $('#buscarDispositivoId').val(),
                'buscarNombreDispositivo': $('#buscarNombreDispositivo').val(),

            }
            $.ajax({
                type: "GET",
                url: "{{route('caracteristica.cargar')}}",
                data: data,
                dataType: "json",
                success: function(response){

                    $('.tbodyCaracteristica').html("");
                    $.each(response.caracteristicas, function(key, item){
                        
                        var correo = (item.correo === null) ? 'no tiene correo' : item.correo;

                        $('.tbodyCaracteristica').append('<tr>\
                            <td>'+item.caracteristicaId+'</td>\
                            <td>'+item.nombre+'</td>\
                            <td>'+item.descripcion+'</td>\
                            <td>'+item.nombreDispositivo+'</td>\
                            <td><button type="button" value="'+item.caracteristicaId+'" class="editar_caracteristica btn btn-primary"><i class="fas fa-edit"></i></button> <button type="button" value="'+item.caracteristicaId+'" class="eliminar_caracteristica_boton btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>\
                        </tr>'
                        );

                    });
                }

            });
        }

        $(document).on('change', '#buscarId', function () {
            buscarCaracteristicas();
        });
        $(document).on('change', '#buscarNombre', function () {
            buscarCaracteristicas();
        });
        $(document).on('change', '#buscarDescripcion', function () {
            buscarCaracteristicas();
        });
        $(document).on('change', '#buscarDispositivoId', function () {
            buscarCaracteristicas();
        });
        $(document).on('change', '#buscarNombreDispositivo', function () {
            buscarCaracteristicas();
        });

        $(document).on('click', '.editar_caracteristica',function(e){
            e.preventDefault();

            var caracteristica_id = $(this).val();

            $('#editarCaracteristica').modal('show');
            $.ajax({
                type: "GET",
                url: "/editarCaracteristica/"+caracteristica_id,
                success: function (response){
                    if(response.status == 404){
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    }
                    else{
                        $('#editarCaracteristicaId').val(response.caracteristica.caracteristicaId);
                        $('.editarNombre').val(response.caracteristica.nombre);
                        $('.editarDescripcion').val(response.caracteristica.descripcion);
                        $('.editarDispositivo').val(response.caracteristica.dispositivoId);
                    }
                }
            });
        });


        $(document).on('click','.actualizar_caracteristica', function(e){
            e.preventDefault();
            var caracteristica_id = $('#editarCaracteristicaId').val();
            var data = {
                'nombre': $('.editarNombre').val(),
                'descripcion': $('.editarDescripcion').val(),
                'dispositivoId': $('.editarDispositivo').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                url: "/actualizarCaracteristica/"+caracteristica_id,
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 400){
                        $('#updateform_errorList').html("");
                        $('#updateform_errorList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values) { 
                            $('#updateform_errorList').append('<li>'+err_values+'</li>');
                        });
                    }
                    else if(response.status == 404){
                            $('#updateform_errorList').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                    }
                    else{
                        $('#updateform_errorList').html("");
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);

                        $('#editarCaracteristica').modal('hide');
                        buscarCaracteristicas();
                    }
                }
            });
        });

        $(document).on('click', '.cerrar_modal_caracteristica',function(e){
            e.preventDefault();
            $('#agregarCaracteristica').find('input').val("");
            $('#editarCaracteristica').find('input').val("");
        });

        $(document).on('click', '.agregar_caracteristica',function(e){
            e.preventDefault();
            
            var data = {
                'caracteristicaId': $('.agregarCaracteristicaId').val(),
                'nombre': $('.nombre').val(),
                'descripcion': $('.descripcion').val(),
                'dispositivoId': $('.dispositivo').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('caracteristica.agregar')}}",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 400){
                        $('#saveform_errorList').html("");
                        $('#saveform_errorList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values) { 
                        $('#saveform_errorList').append('<li>'+err_values+'</li>');
                        });
                    }
                    else{
                        $('#saveform_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#agregarCaracteristica').modal('hide');
                        $('#agregarCaracteristica').find('input').val("");
                        buscarCaracteristicas();

                    }
                }
            });

        });


        $(document).on('click', '.eliminar_caracteristica_boton', function (e) {
            e.preventDefault();

            var caracteristica_id = $(this).val();
            $('#eliminarCaracteristicaId').val(caracteristica_id);
            $('#eliminarCaracteristica').modal('show');

        });


        $(document).on('click','.eliminar_caracteristica',function(e){
            e.preventDefault();

            var caracteristica_id = $('#eliminarCaracteristicaId').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: "/eliminarCaracteristica/"+caracteristica_id,
                success: function (response) {
                    if(response.status == 200){
                        $('#deleteform_errorList').html("");
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);

                        $('#eliminarCaracteristica').modal('hide');
                    }
                    else{
                        $('#updateform_errorList').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    }
                }
            });

            buscarCaracteristicas();
        });
    });

</script>

@endsection