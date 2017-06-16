@extends('layouts.app')

@section('content')

<style>
.button {
     background:none!important;
     border:none; 
     padding:0!important;
     font: inherit;
     font-weight: bold;
     color:#6495ED;
     /*border is optional*/
     /*border-bottom:1px solid #444; */
     cursor: pointer;
}
</style>

<div class="container">
	<li class="list-group-item">
		<div class="row" "list-group-item">
			<div class="col-xs-6 text-center small">Dates en  {{$dates[0]->year}}</div>
			<div class="col-xs-1"></div>
			<div class="col-xs-1 text-center small">
				Matin
			</div>
			<div class="col-xs-1"></div>
			<div class="col-xs-1 text-center small">
				Après-midi
			</div>
		</div>
	</li>
</div>
<br>
{!! Form::open(array('action' => array('UsersController@show'), 'method' => 'post')) !!}
	<div class="container">	
		<form class="form-inline">
			<ul class="list-group">
				@if(empty($datescheckedcount) and empty($datescheckeddemicount))
					Pas d'occupation prévue pour le moment.
				@else
					@foreach ($dates as $date)
						<li class="list-group-item">
					  		<div class="row" "list-group-item">
							  <div class="col-xs-2 text-center small">{{$date->dayName}}</div>
							  <div class="col-xs-2 small">{{$date->day}}</div>
							  <div class="col-xs-2 small">{{$date->monthName}}</div>
							  
							  <div class="col-xs-1"></div>
							  <div class="col-xs-1 text-center small">
							  	@if($date->dayName != "samedi" and $date->dayName != "dimanche")
								  	@foreach ($datescheckedcount as $key=>$datecheckedcount)
								  		@if($date->id == $key)
								  			<?php		
												$dateid = $date->id;
											?>
											{!!Form::submit($datecheckedcount, array('class' => 'button', 'name' => 'am-'.$dateid ))!!}
									   		@break;
									   	@endif
									@endforeach
							    @endif
							  </div>
							  
							  <div class="col-xs-1"></div>
							  <div class="col-xs-1 text-center small">
							  	@if($date->dayName != "samedi" and $date->dayName != "dimanche")
								  	@foreach ($datescheckeddemicount as $key=>$datecheckeddemicount)
								  		@if($date->id == $key)
									   		<?php		
												$dateid = $date->id;
											?>
											{!!Form::submit($datecheckeddemicount, array('class' => 'button', 'name' => 'pm-'.$dateid ))!!}
									   		@break;
									   	@endif
									@endforeach
							    @endif
							  </div>
							  
							</div>
						</li>
					@endforeach
				@endif
			</ul>
		</form>

	</div>
{!! Form::close() !!}
@endsection