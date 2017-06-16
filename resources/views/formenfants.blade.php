@extends('layouts.app')

@section('content')
<div class="container">
	<li class="list-group-item">
		<div class="row" "list-group-item">
			<div class="col-xs-12 text-center">Liste des enfants inscrits</div>			
		</div>
	</li>
</div>
<br>
<div class="container">
	<li class="list-group-item">
		<div class="row" "list-group-item">
			<div class="col-xs-1 text-left small">Prénom</div>
			<div class="col-xs-1"></div>
		  	<div class="col-xs-1 text-left small">Nom</div>
		  	<div class="col-xs-1"></div>
		  	<div class="col-xs-1 small">Tarif journalier</div>
		  	<div class="col-xs-1"></div>
		  	<div class="col-xs-2 small">Tarif demi-journée</div>		
		</div>
	</li>
</div>
{!! Form::open(array('action' => array('EnfantsController@save'), 'method' => 'post')) !!}
	
	<div class="container">	
		<form class="form-inline">
			<ul class="list-group">
				@foreach ($users as $user)
					<li class="list-group-item">
				  		<div class="row" "list-group-item">
						  	<div class="col-xs-1 text-left small">{{$user->firstname}}</div>
						  	<div class="col-xs-1"></div>
						  	<div class="col-xs-1 text-left small">{{$user->lastname}}</div>
						  	<?php		
								$userid = $user->id;
							?>
							<div class="col-xs-1"></div>
						  	<div class="col-xs-1 small">{!!Form::textarea('tariffull['.$userid.']', $user->tariffull, ['rows' => 1, 'cols' => 5])!!}</div>
						  	<div class="col-xs-1"></div>
						  	<div class="col-xs-2 small">{!!Form::textarea('tarifhalf['.$userid.']', $user->tarifhalf, ['rows' => 1, 'cols' => 5])!!}</div>
						  	<div class="col-xs-1">
							  	<input type="submit" name='{{$user->id}}' value="Supprimer" align="right" class="btn btn-danger btn-sm">
							</div>
						</div>
					</li>
				@endforeach
			</ul>
		</form>
		{!!Form::submit('Sauvegarder', array('class' => 'btn btn-primary'))!!}

	</div>
{!! Form::close() !!}
@endsection