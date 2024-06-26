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
                        <option value="">selecciona una forma de pago</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia Bancaria</option>
                    </select>
                </div>
                <div class="row form-group">
                    <div class="col-md-12 text-center" id="banco">
                        <p>Estos son los datos para la transferencia bancaria y confirmar tu pedido</p>
                        <img src="https://heladeriaflordeazahar.com/public/storage/images/t06banners/WhatsApp%20Image%202024-05-13%20at%2018.47.44.jpeg" alt="Datos Bancarios" id="datosBancarios">
                        <p style="text-decoration: solid;"><b>Escribenos al whatsapp para confirmar tu transferencia<a href="https://wa.link/cxvdva">229 667 4807</a></b></p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12 text-center" id="efectivo">
                        <p>Puedes ir al local y pagar en efectivo o puedes pedir que el domiciliario recoja el efectivo en tu casa</p>
                        {{-- <img src="https://heladeriaflordeazahar.com/public/storage/images/t06banners/WhatsApp%20Image%202024-05-13%20at%2018.47.44.jpeg" alt="Datos Bancarios" id="datosBancarios"> --}}
                        <p style="text-decoration: solid;"><b>Escribenos al whatsapp para confirmarnos que opcion es la mas comoda<a href="https://wa.link/p15czk">229 667 4807</a></b></p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-center" id="pagar">
                        <label for="t14paga">Con cuanto va a pagar</label>
                        <input type="number" name="t14paga" id="t14paga">
                    </div>
                    <div class="col-md-6 text-center" id="cambio">
                        <label for="t14cambio">El domiciliario llevara de cambio</label>
                        <input type="number" name="t14cambio" id="t14cambio" readonly>
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


<script type="text/javascript">
    var cuenta = {{ $total }};
    $(document).ready(function() {
        $('#banco').parent().hide();
        $('#efectivo').parent().hide();
        $('#pagar').parent().hide();
        $('#cambio').parent().hide();


        $('#t14tipopago').on('change', function(){
            if(!$(this).val() == ''){
                if($(this).val() == 'transferencia'){
                    $('#banco').parent().show();
                    $('#efectivo').parent().hide();
                    $('#pagar').parent().hide();
                    $('#cambio').parent().hide();

                }
                if($(this).val() == 'efectivo'){
                    $('#efectivo').parent().show();
                    $('#pagar').parent().show();
                    $('#cambio').parent().show();
                    $('#banco').parent().hide();
                }
            }else{
                $('#banco').parent().hide();
                $('#efectivo').parent().hide();
                $('#pagar').parent().hide();
                $('#cambio').parent().hide();
            }
        });


        $('#pagar').on('change', function(){
            // console.log($('#t14paga').val());
            var resultado = $('#t14paga').val() - cuenta;
            $('#t14cambio').val(resultado);
            console.log(resultado);

        });

        $("#guardar").click(function(){
            $("#btnSubmit").click();
        });
    });
</script>
@endsection
