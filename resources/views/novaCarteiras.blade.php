@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Adicionar Carteira</div>

                <div class="card-body">
                    <form action="{{ route('salvaCarteira') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12 row">
                                <div class="col-md-6">
                                    <label for="mes_inicio" class="col-form-label">Mês Carteira:</label>
                                    <select class="form-control load" name="mes" id="mes">
                                        <option value="">Todos</option>
                                        <option value="1">Janeiro</option>
                                        <option value="2">Fevereiro</option> 
                                        <option value="3">Março</option> 
                                        <option value="4">Abril</option> 
                                        <option value="5">Maio</option> 
                                        <option value="6">Junho</option> 
                                        <option value="7">Julho</option> 
                                        <option value="8">Agosto</option> 
                                        <option value="9">Setembro</option> 
                                        <option value="10">Outubro</option> 
                                        <option value="11">Novembro</option> 
                                        <option value="12">Dezembro</option> 
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="ano_inicio" class="col-form-label">Ano Carteira:</label>
                                    <select class="form-control load" name="ano" id="ano">
                                        <option value="">Todos</option>
                                        @for ($i = 2015; $i <= date("Y"); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <label class="col-form-label">Corretora:</label>
                                <select class="form-control load" name="corretora_id" id="corretora_id">
                                    <option value="">Todas</option>
                                    @foreach(\App\Corretora::orderBy('nome')->get() as $corretora)
                                    <option value="{{ $corretora->id }}">{{ $corretora->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="col-form-label">Ativos:</label>
                                <select class="form-control select2" name="empresa_id[]" id="empresa_id" multiple="">
                                    @foreach(\App\Empresa::All() as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->ticker }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <button type="submit" class="btn btn-primary">Salvar</button> 
                    </form>    
                </div>     

            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
        $('.load').on('change', function() {
            if($('#ano').val() != '' && $('#mes').val() != '' && $('#corretora_id').val() != ''){
                $.ajax(
                {
                    url: '{{route('checkCarteira')}}',
                    type: "POST",
                    data: {
                        ano: $('#ano').val(), 
                        mes: $('#mes').val(),
                        corretora_id: $('#corretora_id').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data, textStatus, jqXHR)
                    {
                        console.log(data)
                        $('#empresa_id').val(data).trigger('change')

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        if(jqXHR.status == 419){
                            location.reload();
                        }
                        console.log("erro");
                    }
                });
            }

        });

        @if(\Request::exists('mes'))
        $('#mes').val('{{\Request::get('mes')}}');
        @endif

        @if(\Request::exists('ano'))
        $('#ano').val('{{\Request::get('ano')}}');
        @endif

        @if(\Request::exists('corretora_id'))
        $('#corretora_id').val('{{\Request::get('corretora_id')}}');
        @endif

    });
</script>
@endsection
