@extends('Defaults.Views.layouts.master')

@section('title', 'Users Lists')

@section('content')

<div class="row">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Records</h3>
			<div class="box-tools pull-right">
            	<button type="button" class="btn btn-sm btn-primary" style="color: #FFF; margin-top: 5px;" data-toggle="modal" data-target="#formModal">Add New</button>
            </div>
		</div>
		<div class="box-body">

			{!! $html->table() !!}

		</div>
	</div>
</div>

@include('Defaults.Views.partials.modals.form')

@stop

@push('scripts')

	 <!-- Datatable scripts -->
	 {!! $html->scripts() !!}	 

 	@if(\Session::has('errors'))
 		<script type="text/javascript">
 			$('#formModal').modal('show');
 		</script>
 	@endif 

 	<script type="text/javascript">

 		function getData(id){

 			$.ajax({
 				url: 'users/' + id + '/edit',
 				method: 'GET',
 				dataType: 'json',
 				success: function(data){
 					$('#email').val(data.data.email);
 					$('#last_name').val(data.data.last_name);
 					$('#first_name').val(data.data.first_name);
 					$('#formModal').modal('show');
 				},
 				error: function(err){
 					console.log(err)
 				}
 			});
 		}

 	</script>
	 
@endpush