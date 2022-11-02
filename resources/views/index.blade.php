@extends('plantilla')
@section('info')
    <!-- Modal add empresa-->
    <div class="modal fade" id="agregarEmpresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva empresa</h5>
                    <button type="button" class="btn-close cerrar_modal_empresa" data-bs-dismiss="modal" aria-label="Cancelar"></button>
                </div>
                <div class="modal-body">
                    <ul id="saveform_errorList"></ul>
                    <div class="form-group">
                        <label for="">Empresa ID</label>
                        <input type="number" class="agregarEmpresaId form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="nombre form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Contacto</label>
                        <input type="number" class="contacto form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Correo</label>
                        <input type="email" class="correo form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cerrar_modal_empresa" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary agregar_empresa">Guardar </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add empresa end-->

<!-- Modal edit empresa-->
<div class="modal fade" id="editarEmpresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar empresa</h5>
                <button type="button" class="btn-close cerrar_modal_empresa" data-bs-dismiss="modal" aria-label="Cancelar"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errorList"></ul>
                <div class="form-group">
                    <input type="hidden" id="editarEmpresaId" class="empresaId form-control">
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="editarNombre form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Contacto</label>
                    <input type="number" class="editarContacto form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Correo</label>
                    <input type="email" class="editarCorreo form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar_modal_empresa" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary actualizar_empresa">Guardar </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal edit empresa end-->


<!-- Modal delete empresa-->
<div class="modal fade" id="eliminarEmpresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar empresa</h5>
                <button type="button" class="btn-close cerrar_modal_empresa" data-bs-dismiss="modal" aria-label="Cancelar"></button>
            </div>
            <div class="modal-body">
                <ul id="updateform_errorList"></ul>

                <input type="hidden" id="eliminarEmpresaId" class="empresaId form-control">

                <h4>¿Estas seguro que quieres eliminar esta empresa?</h4>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrar_modal_empresa" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary eliminar_empresa">Continuar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal delete empresa end-->

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
                    <p>Buscar por empresa ID: </p>
                    <input type="text" name="empresaId" id="buscarId" class="form-control form-control-mb3" placeholder="ID">
                </div>
                <div class="col-md-2">
                    <p>Buscar por nombre: </p>
                    <input type="text" name="nombre" class="form-control form-control-mb3" id="buscarNombre" placeholder="nombre">
                </div>
                <div class="col-md-4">
                    <br>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#agregarEmpresa" style="float: right; margin: 2px" class="btn btn-success"><i class='fa fa-building'></i> Agregar Empresa </a>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="employedsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Empresa ID</th>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Correo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tbodyEmpresa">
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

        buscarEmpresas();

        function buscarEmpresas()
        {
            var data = {
                'buscarId': $('#buscarId').val(),
                'buscarNombre': $('#buscarNombre').val(),
            }
            $.ajax({
                type: "GET",
                url: "{{route('empresa.cargar')}}",
                data: data,
                dataType: "json",
                success: function(response){

                    $('.tbodyEmpresa').html("");
                    $.each(response.empresas, function(key, item){
                        
                        var correo = (item.correo === null) ? 'no tiene correo' : item.correo;

                        $('.tbodyEmpresa').append('<tr>\
                            <td>'+item.empresaId+'</td>\
                            <td>'+item.nombre+'</td>\
                            <td>'+item.contacto+'</td>\
                            <td>'+correo+'</td>\
                            <td><button type="button" value="'+item.empresaId+'" class="editar_empresa btn btn-primary"><i class="fas fa-edit"></i></button> <button type="button" value="'+item.empresaId+'" class="eliminar_empresa_boton btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>\
                        </tr>'
                        );

                    });
                }

            });
        }

        $(document).on('change', '#buscarId', function () {
            buscarEmpresas();
        });
        $(document).on('change', '#buscarNombre', function () {
            buscarEmpresas();
        });

        $(document).on('click', '.editar_empresa',function(e){
            e.preventDefault();

            var empresa_id = $(this).val();

            $('#editarEmpresa').modal('show');
            $.ajax({
                type: "GET",
                url: "/editarEmpresa/"+empresa_id,
                success: function (response){
                    if(response.status == 404){
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    }
                    else{
                        $('#editarEmpresaId').val(response.empresa.empresaId);
                        $('.editarNombre').val(response.empresa.nombre);
                        $('.editarContacto').val(response.empresa.contacto);
                        $('.editarCorreo').val(response.empresa.correo);
                    }
                }
            });
        });


        $(document).on('click','.actualizar_empresa', function(e){
            e.preventDefault();
            var empresa_id = $('#editarEmpresaId').val();
            console.log(empresa_id);
            var data = {
                'nombre': $('.editarNombre').val(),
                'contacto': $('.editarContacto').val(),
                'correo': $('.editarCorreo').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                url: "/actualizarEmpresa/"+empresa_id,
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

                        $('#editarEmpresa').modal('hide');
                        buscarEmpresas();
                    }
                }
            });
        });

        $(document).on('click', '.cerrar_modal_empresa',function(e){
            e.preventDefault();
            $('#agregarEmpresa').find('input').val("");
            $('#editarEmpresa').find('input').val("");
        });



        $(document).on('click', '.agregar_empresa',function(e){

            e.preventDefault();
            
            var data = {
                'empresaId': $('.agregarEmpresaId').val(),
                'nombre': $('.nombre').val(),
                'contacto': $('.contacto').val(),
                'correo': $('.correo').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('empresa.agregar')}}",
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
                        $('#agregarEmpresa').modal('hide');
                        $('#agregarEmpresa').find('input').val("");
                        buscarEmpresas();

                    }
                }
            });

        });


        $(document).on('click', '.eliminar_empresa_boton', function (e) {
            e.preventDefault();

            var empresa_id = $(this).val();
            $('#eliminarEmpresaId').val(empresa_id);
            $('#eliminarEmpresa').modal('show');

        });


        $(document).on('click','.eliminar_empresa',function(e){
            e.preventDefault();

            var empresa_id = $('#eliminarEmpresaId').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: "/eliminarEmpresa/"+empresa_id,
                success: function (response) {
                    if(response.status == 200){
                        $('#deleteform_errorList').html("");
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);

                        $('#eliminarEmpresa').modal('hide');
                    }
                    else{
                        $('#updateform_errorList').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                    }
                }
            });

            buscarEmpresas();
        });
    });

</script>

@endsection