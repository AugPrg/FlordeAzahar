@extends('adminlte::page')

@section('title'){!! $titulo !!}
@endsection

@section('content_header')
{!! $titulo !!}
@stop

@section('content')
   @if (session('mensaje'))
    <div class="alert alert-success alert-dismissable">
        {{ session('mensaje') }}
    </div>
@endif

<div class="modal" id="modalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirmación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de eliminar el soporte?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                <button type="button" onclick="eliminarSoporteConfirmado();" class="btn btn-danger">Sí</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-primary">
            <div class="card-header bg-primary">
                <h4 class="m-b-0 m-t-0 text-white">Datos Básicos</h4>
            </div>
            <div class="card-body">
                @if (isset($editMode))
                <form action="{{ route('admin.category.update', ['category' => $registro->t02id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                @else
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @endif
                    @csrf

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="t02nombre">Nombre de la categoria</label>
                            <input type="text" id="t02nombre" name="t02nombre" class="form-control" value="{{ $registro->t02nombre }}" >
                        </div>

                        <div class="col-md-4">
                            <label for="t06publicado">Tipo de categoria</label><br>
                            <input id="BLOG" name="t02grupo" type="radio" value="BLOG" {{ $registro->t02grupo === 'BLOG' ? 'checked' : '' }}> Blog<br>
                            <input id="PRODUCTO" name="t02grupo" type="radio" value="PRODUCTO" {{ $registro->t02grupo === 'PRODUCTO' ? 'checked' : '' }}> Producto
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="card-body">
                            <div class="col-md-12">
                                <label for="images">Agrega Imagenes al Producto</label><br>
                                <input id="images" type="file" name="images[]" accept="image/*" multiple>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row form-group">
                        <div class="col-md-12 text-center">
                            <a href="{!! url('admin/products/images') !!}" class="btn btn-warning"><i class="fa fa-reply"></i> Cancelar</a>
                            <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <input type="submit" id="btnSubmit" style="display: none;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="folder" id="folder">
@stop

@section('css')
@stop

@section('js')
<script>
$(document).ready(function() {
    $("#guardar").click(function(){
        $("#btnSubmit").click();
    });
});
</script>
@stop
