@extends('layouts.app')

@section('content')
	<div class="container">
		@foreach ($dates as $date)
			<li class="list-group-item">
				<div class="row" "list-group-item">
						<div class="col-xs-12 text-center">{{$date->dayName}} {{$date->day}} {{$date->monthName}} {{$date->year}}</div>
				</div>
			</li>
		@endforeach
	</div>
	<br>
	<div class="container">
		<div class="col-xs-2 text-left">Matinée</div>
	</div>
	<br>

	<div class="container">	
		<form class="form-inline">
			<ul class="list-group">
				@if(empty($usersam))
					Pas d'occupation prévue pour ce jour.
				@else
					@foreach ($usersam as $userslist)
					@foreach ($userslist as $user)
						<li class="list-group-item">
					  		<div class="row" "list-group-item">
							  <div class="col-xs-4 text-center">{{$user->firstname}}</div>
							  <div class="col-xs-4">{{$user->lastname}}</div>
							  <div class="col-xs-4">{{$user->email}}</div>  
							</div>
						</li>
					@endforeach
					@endforeach
				@endif
			</ul>
		</form>

	</div>

	<br>
	<div class="container">
		<div class="col-xs-2 text-left">Après-Midi</div>
	</div>
	<br>

	<div class="container">	
		<form class="form-inline">
			<ul class="list-group">
				@if(empty($userspm))
					Pas d'occupation prévue pour ce jour.
				@else
					@foreach ($userspm as $userslist)
						@foreach ($userslist as $user)
							<li class="list-group-item">
						  		<div class="row" "list-group-item">
								  <div class="col-xs-4 text-center">{{$user->firstname}}</div>
								  <div class="col-xs-4">{{$user->lastname}}</div>
								  <div class="col-xs-4">{{$user->email}}</div>  
								</div>
							</li>
						@endforeach
					@endforeach
				@endif
			</ul>
		</form>

	</div>
@endsection