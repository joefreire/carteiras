@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Carteiras Corretoras</div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <label for="mes_inicio" class="col-form-label">Mês Inicio Carteira:</label>
                                <select class="form-control" id="mes_inicio">
                                    <option value="">Todos</option>
                                    <option value="1">Janeiro</option>
                                    <option value="2">Fevereiro</option> 
                                    <option value="3">Marzo</option> 
                                    <option value="4">Abril</option> 
                                    <option value="5">Mayo</option> 
                                    <option value="6">Junio</option> 
                                    <option value="7">Julio</option> 
                                    <option value="8">Agosto</option> 
                                    <option value="9">Septiembre</option> 
                                    <option value="10">Octubre</option> 
                                    <option value="11">Noviembre</option> 
                                    <option value="12">Diciembre</option> 
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ano_inicio" class="col-form-label">Ano Inicio Carteira:</label>
                                <select class="form-control" id="ano_inicio">
                                    <option value="">Todos</option>
                                    @for ($i = 2015; $i <= date("Y"); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <label for="mes_fim" class="col-form-label">Mês Final Carteira:</label>
                                <select class="form-control" id="mes_fim">
                                    <option value="">Todos</option>
                                    <option value="1">Janeiro</option>
                                    <option value="2">Fevereiro</option> 
                                    <option value="3">Marzo</option> 
                                    <option value="4">Abril</option> 
                                    <option value="5">Mayo</option> 
                                    <option value="6">Junio</option> 
                                    <option value="7">Julio</option> 
                                    <option value="8">Agosto</option> 
                                    <option value="9">Septiembre</option> 
                                    <option value="10">Octubre</option> 
                                    <option value="11">Noviembre</option> 
                                    <option value="12">Diciembre</option> 
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ano_fim" class="col-form-label">Ano Final Carteira:</label>
                                <select class="form-control" id="ano_fim">
                                    <option value="">Todos</option>
                                    @for ($i = 2015; $i <= date("Y"); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <label class="col-form-label">Corretora:</label>
                            <select class="form-control" id="corretora">
                                <option value="">Todas</option>
                                @foreach(\App\Corretora::All() as $corretora)
                                <option value="{{ $corretora->id }}">{{ $corretora->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>      
                </div>     
                <div class="col-md-12"> 
                    <table class="table table-bordered" id="table" width="100%">
                        <thead>
                            <th>Mês</th>
                            <th>Ano</th>
                            <th>Corretora</th>
                            <th>Ativo</th>
                            <th>Preço Mes</th>
                            <th>Retorno</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script src="//cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

<script src="//cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'POST',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                d.corretora = $('#corretora').val();
                d.ano_inicio = $('#ano_inicio').val();
                d.ano_fim = $('#ano_fim').val();
                d.mes_inicio = $('#mes_inicio').val();
                d.mes_fim = $('#mes_fim').val();
            }
        },
        lengthMenu: [ [10, 25, 100, -1], [10, 25, 100, "Todos"] ],
        dom: '<"float-left"B<"toolbar">><"float-right">t<"bottom"<"float-left"lri><"float-right"p>>',
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columns: [
        {data: 'mes', name: 'carteiras.mes'},
        {data: 'ano', name: 'carteiras.ano'},        
        {data: 'corretora.nome', name: 'corretoras.nome'},
        {data: 'empresa.ticker', name: 'empresas.ticker'},
        {data: 'PrecoMes', searchable:false, orderable:false,},
        {data: 'Retorno', searchable:false, orderable:false,},
        ]
    });
    $('#corretora').on('change', function () {
        $('#table').DataTable().ajax.reload();
    });
    $('#ano_inicio').on('change', function () {
        $('#table').DataTable().ajax.reload();
    });
    $('#ano_fim').on('change', function () {
        $('#table').DataTable().ajax.reload();
    });
    $('#mes_inicio').on('change', function () {
        $('#table').DataTable().ajax.reload();
    });
    $('#mes_fim').on('change', function () {
        $('#table').DataTable().ajax.reload();
    });
</script>
@endsection
