@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Confirma tu forma de Pago</h1>

            <form action="{{ route('payPost.cart') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="t14tipopago">Forma de Pago:</label>
                    <select name="t14tipopago" id="t14tipopago" class="form-control">
                        <option value="">seleccione una forma de pago</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia Bancaria</option>
                    </select>
                </div>
                <div class="row form-group">
                    <div class="col-md-12 text-center">
                        <p>Estos son los datos para la transferencia bancaria y confirmar tu pedido</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="t14direccion">Dirección de Envío:</label>
                    <textarea name="t14direccion" id="t14direccion" class="form-control" rows="3"></textarea>
                </div>

                <div class="row form-group">
                    <div class="col-md-12 text-center">
                        <a href="{!! url('pago') !!}" class="btn btn-warning"><i class="fa fa-reply"></i> Cancelar</a>
                        <button type="submit" id="guardar" class="btn btn-success"><i class="fa fa-save"></i> Confirmar Pedido</button>
                        <input type="submit" id="btnSubmit" style="display: none;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    // alert('holra');
    <script type="text/javascript">
    $(document).ready(function() {


        $("#guardar").click(function(){
            $("#btnSubmit").click();
        });
    });
</script>
</script>
@endsection
