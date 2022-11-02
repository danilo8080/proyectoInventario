@extends('plantilla')
@section('info')
    <!-- Modal add dispositivo-->
    <div class="modal fade" id="agregarDispositivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo dispositivo</h5>
                    <button type="button" class="btn-close cerrar_modal_dispositivo" data-bs-dismiss="modal" aria-label="Cancelar"></button>
                </div>
                <div class="modal-body">
                    <ul id="saveform_errorList"></ul>
                    <div class="form-group">
                        <label for="">Dispositivo ID</label>
                        <input type="number" class="agregarDispositivoId form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="nombre form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Empresa</label><br>
                        <select class="empresa" aria-label="Default select example">
                            <option value="" selected>seleccione una empresa</option>
                            @foreach ($empresas as $item)
                            <option value="{{ $item->empresaId }}">{{ $item->nombre }}</option>         
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cerrar_modal_dispositivo" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary agregar_dispositivo">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add dispositivo end-->

<!-- Modal edit dispositivo-->
<div class="modal fade" id="editarDispositivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar dispositivo</h5>
                <button type="button" class="btn-close cerrar_modal_dispositivo" data-bs-dismiss="modal" aria-label="Cancelar"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errorList"></ul>
                <div class="form-group">
                    <input type="hidden" id="editarDispositivoId" class="dispositivoId form-control">
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="editarNombre form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Empresa</label><br>
                    <select class="editarEmpresa" aria-label="Default select example">
                        <option value="" selected>seleccione una empresa</option>
                        @foreach ($empresas as $item)
                        <option value="{{ $item->empresaId }}">{{ $item->nombre }}</option>         
                        @endforeach
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar_modal_dispositivo" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary actualizar_dispositivo">Guardar </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit dispositivo end-->


<!-- Modal delete dispositivo-->
<div class="modal fade" id="eliminarDispositivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar dispositivo</h5>
                <button type="button" class="btn-close cerrar_modal_dispositivo" data-bs-dismiss="modal" aria-label="Cancelar"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errorList"></ul>

                <input type="hidden" id="eliminarDispositivoId" class="dispositivoId form-control">

                <h4>¿Estas seguro que quieres eliminar este dispositivo?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar_modal_dispositivo" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary eliminar_dispositivo">Continuar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal delete dispositivo end-->

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
                    <p>Buscar por dispositivo ID: </p>
                    <input type="text" name="dispositivoId" id="buscarId" class="form-control form-control-mb3" placeholder="ID">
                </div>
                <div class="col-md-2">
                    <p>Buscar por nombre: </p>
                    <input type="text" name="nombre" class="form-control form-control-mb3" id="buscarNombre" placeholder="Nombre">
                </div>
                <div class="col-md-2">
                    <p>Buscar por empresa ID: </p>
                    <input type="text" class="form-control form-control-mb3" id="buscarEmpresaId" placeholder="Empresa ID">
                </div>
                <div class="col-md-2">
                    <p>Buscar por nombre de empresa: </p>
                    <input type="text" class="form-control form-control-mb3" id="buscarNombreEmpresa" placeholder="Nombre Empresa">
                </div>
                <div class="col-md-4">
                    <br>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#agregarDispositivo" style="float: right; margin: 2px" class="btn btn-success"><i class='fas fa-mobile-alt'></i> Agregar Dispositivo <i class='fa fa-tv'></i> </a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Dispositivo ID</th>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbodyDispositivo">
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
        buscarDispositivos();

        function buscarDispositivos()
        {
            var data = {
                'buscarId': $('#buscarId').val(),
                'buscarNombre': $('#buscarNombre').val(),
                'buscarEmpresaId': $('#buscarEmpresaId').val(),
                'buscarNombreEmpresa': $('#buscarNombreEmpresa').val()

            }
            $.ajax({
                type: "GET",
                url: "{{route('dispositivo.cargar')}}",
                data: data,
                dataType: "json",
                success: function(response){

                    $('.tbodyDispositivo').html("");
                    $.each(response.dispositivos, function(key, item){
                        
                        var correo = (item.correo === null) ? 'no tiene correo' : item.correo;

                        $('.tbodyDispositivo').append('<tr>\
                            <td>'+item.dispositivoId+'</td>\
                            <td>'+item.nombre+'</td>\
                            <td>'+item.nombreEmpresa+'</td>\
                            <td><button type="button" value="'+item.dispositivoId+'" class="editar_dispositivo btn btn-primary"><i class="fas fa-edit"></i></button> <button type="button" value="'+item.dispositivoId+'" class="eliminar_dispositivo_boton btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>\
                        </tr>'
                        );

                    });
                }

            });
        }

        $(document).on('change', '#buscarId', function () {
            buscarDispositivos();
        });
        $(document).on('change', '#buscarNombre', function () {
            buscarDispositivos();
        });
        $(document).on('change', '#buscarEmpresaId', function () {
            buscarDispositivos();
        });
        $(document).on('change', '#buscarNombreEmpresa', function () {
            buscarDispositivos();
        });

        $(document).on('click', '.editar_dispositivo',function(e){
            e.preventDefault();

            var dispositivo_id = $(this).val();

            $('#editarDispositivo').modal('show');
            $.ajax({
                type: "GET",
                url: "/editarDispositivo/"+dispositivo_id,
                success: function (response){
                    if(response.status == 404){
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    }
                    else{
                        $('#editarDispositivoId').val(response.dispositivo.dispositivoId);
                        $('.editarNombre').val(response.dispositivo.nombre);
                        $('.editarContacto').val(response.dispositivo.contacto);
                        $('.editarCorreo').val(response.dispositivo.correo);
                        $('.editarEmpresa').val(response.dispositivo.empresaId);

                    }
                }
            });
        });


        $(document).on('click','.actualizar_dispositivo', function(e){
            e.preventDefault();
            var dispositivo_id = $('#editarDispositivoId').val();
            var data = {
                'nombre': $('.editarNombre').val(),
                'contacto': $('.editarContacto').val(),
                'correo': $('.editarCorreo').val(),
                'empresaId': $('.editarEmpresa').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                url: "/actualizarDispositivo/"+dispositivo_id,
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

                        $('#editarDispositivo').modal('hide');
                        buscarDispositivos();
                    }
                }
            });
        });

        $(document).on('click', '.cerrar_modal_dispositivo',function(e){
            e.preventDefault();
            $('#agregarDispositivo').find('input').val("");
            $('#editarDispositivo').find('input').val("");
        });



        $(document).on('click', '.agregar_dispositivo',function(e){

            e.preventDefault();
            
            var data = {
                'dispositivoId': $('.agregarDispositivoId').val(),
                'nombre': $('.nombre').val(),
                'contacto': $('.contacto').val(),
                'correo': $('.correo').val(),
                'empresaId': $('.empresa').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('dispositivo.agregar')}}",
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
                        $('#agregarDispositivo').modal('hide');
                        $('#agregarDispositivo').find('input').val("");
                        buscarDispositivos();

                    }
                }
            });

        });


        $(document).on('click', '.eliminar_dispositivo_boton', function (e) {
            e.preventDefault();

            var dispositivo_id = $(this).val();
            $('#eliminarDispositivoId').val(dispositivo_id);
            $('#eliminarDispositivo').modal('show');

        });


        $(document).on('click','.eliminar_dispositivo',function(e){
            e.preventDefault();

            var dispositivo_id = $('#eliminarDispositivoId').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: "/eliminarDispositivo/"+dispositivo_id,
                success: function (response) {
                    if(response.status == 200){
                        $('#deleteform_errorList').html("");
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);

                        $('#eliminarDispositivo').modal('hide');
                    }
                    else{
                        $('#updateform_errorList').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    }
                }
            });

            buscarDispositivos();
        });
    });

</script>

@endsection