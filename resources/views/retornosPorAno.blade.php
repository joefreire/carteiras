@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Retornos Corretoras</div>

        <div class="col-md-12"> 
            <table  class="table table-striped table-bordered table-sm" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <td></td>
                    <td colspan="3">Retorno periodo</td>
                    <td colspan="3">2018</td>
                    <td colspan="3">2019</td>
                    <td colspan="3">2020</td>
                    <td colspan="3">2021</td>
                </tr>
                <tr>
                  <td></td>
                  <td>Retorno</td>
                  <td>Sharpe</td>
                  <td>Sortino</td>
                  <td>Retorno</td>
                  <td>Sharpe</td>
                  <td>Sortino</td>
                  <td>Retorno</td>
                  <td>Sharpe</td>
                  <td>Sortino</td>
                  <td>Retorno</td>
                  <td>Sharpe</td>
                  <td>Sortino</td>
                  <td>Retorno</td>
                  <td>Sharpe</td>
                  <td>Sortino</td>
              </tr>
          </thead>
          <tbody>
            @foreach($corretoras as $corretora)
            @php
            $qtdRetornos = $corretora->retornos->where('ano','>=', 2018)->count();
            $retorno2018 = $corretora->retornoAnual(2018);
            $sharpe2018 = $corretora->sharpe(2018);
            $sortino2018 = $corretora->sortino(2018);
            $retorno2019 = $corretora->retornoAnual(2019);
            $sharpe2019 = $corretora->sharpe(2019);
            $sortino2019 = $corretora->sortino(2019);
            $retorno2020 = $corretora->retornoAnual(2020);
            $sharpe2020 = $corretora->sharpe(2020);
            $sortino2020 = $corretora->sortino(2020);
            $retorno2021 = $corretora->retornoAnual(2021);
            $sharpe2021 = $corretora->sharpe(2021);
            $sortino2021 = $corretora->sortino(2021);
            @endphp
            @if($qtdRetornos == 48)
            <tr>

                <th>{{ $corretora->nome }}</th>
                <th>{{ number_format($corretora->retorno_periodo(),4,',','') }}</th>
                <th>{{ number_format($corretora->sharpe_periodo(),4,',','')  }}</th>
                <th>{{ number_format($corretora->sortino_periodo(),4,',','')  }}</th>
                <th>{{ number_format($retorno2018,4,',','') }}</th>
                <th>{{ number_format($sharpe2018,4,',','') }}</th>
                <th>{{ number_format($sortino2018,4,',','') }}</th>
                <th>{{ number_format($retorno2019,4,',','') }}</th>
                <th>{{ number_format($sharpe2019,4,',','') }}</th>
                <th>{{ number_format($sortino2019,4,',','') }}</th>
                <th>{{ number_format($retorno2020,4,',','') }}</th>
                <th>{{ number_format($sharpe2020,4,',','') }}</th>
                <th>{{ number_format($sortino2020,4,',','') }}</th>
                <th>{{ number_format($retorno2021,4,',','') }}</th>
                <th>{{ number_format($sharpe2021,4,',','') }}</th>
                <th>{{ number_format($sortino2021,4,',','') }}</th>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

</div>
</div>
</div>
</div>
@endsection

@section('scripts')

@endsection
