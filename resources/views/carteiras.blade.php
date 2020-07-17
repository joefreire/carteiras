@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <table class="table table-bordered" id="table" width="100%">
                        <thead>
                            <th>Mês</th>
                            <th>Ano</th>
                            <th>Corretora</th>
                            <th>Ativo</th>
                        </tr>
                    </thead>
                </table>
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
        serverSide: false,
        ajax: {
            type: 'POST',
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        dom: 'Bfrtip',
        buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columns: [
        {data: 'mes', name: 'carteiras.mes'},
        {data: 'ano', name: 'carteiras.ano'},
        {data: 'empresa.ticker', name: 'empresas.ticker'},
        {data: 'corretora.nome', name: 'corretoras.nome'},
        ]
    });
</script>
@endsection
