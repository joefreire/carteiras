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
        },
        columns: [
        {data: 'mes', name: 'carteiras.mes'},
        {data: 'ano', name: 'carteiras.ano'},
        {data: 'empresa.ticker', name: 'empresas.ticker'},
        {data: 'corretora.nome', name: 'corretoras.nome'},
        ]
    });
</script>
@endsection
