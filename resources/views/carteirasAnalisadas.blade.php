@extends('layouts.app')

@section('content')
<div class="col-md-12">
		@foreach($corretoras as $corretora)
		{{-- <div class="card"> --}}
		@if($corretora->todo_perido()){{-- 
		<div class="card-header">{{ $corretora->nome }}</div> --}}
			{{ $corretora->id }},
		@php
		$carteiras = \App\Carteira::with('empresa')->where('ano','>=','2018')->where('ano','<=','2021')->where('corretora_id',$corretora->id)->orderBy('ano','asc')->get();
		@endphp
		@foreach($carteiras as $carteira)
	
{{-- 		<table  class="table table-striped table-bordered table-sm" cellspacing="0"
		width="100%">
		<thead>
			<tr>
				<td>Mes</td>
				<td>Ano</td>
				<td>Ativo</td>
				<td>Retorno</td>
			</tr>
		</thead>
		<tbody>         
			<tr>
				<th>{{ $carteira->mes }}</th>
				<th>{{ $carteira->ano }}</th>
				<th>{{ $carteira->empresa->ticker }}</th>
				<th></th>
			</tr>
		</tbody>
	</table>
 --}}	@endforeach
	@endif
</div>
@endforeach

</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
