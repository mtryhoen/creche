@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ URL::asset('js/checkbox.js') }}"></script>
<div class="container">
	<li class="list-group-item">
		<div class="row" "list-group-item">
			<div class="col-xs-6 text-center">Dates  en  {{$dates[0]->year}}</div>
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
{!! Form::open(array('action' => array('CalController@savecalendrier'), 'method' => 'post')) !!}
	
	<div class="container">	
		<form class="form-inline">
			<li class="list-group-item">
				<div class="row" "list-group-item">
					<div class="col-xs-7 text-center"></div>
					<div class="col-xs-2 text-center small">
						<input type="checkbox" id="ckbCheckAll1"/> Tout sélectionner
					</div>
					<div class="col-xs-2 text-center small">
						<input type="checkbox" id="ckbCheckAll2"/> Tout sélectionner
					</div>
				</div>
			</li>
			<ul class="list-group">

				{{ Form::hidden('user', $user) }}
				<!--get all the dates of the month-->
				@foreach ($datesid as $date1)
					{{ Form::hidden('datesid[]', $date1) }}
				@endforeach
				@if($dateschecked->isEmpty())
					@foreach ($dates as $date)
						<li class="list-group-item">
					  		<div class="row" "list-group-item">
							  <div class="col-xs-2 text-center small">{{$date->dayName}}</div>
							  <div class="col-xs-2 text-center small">{{$date->day}}</div>
							  <div class="col-xs-2 small">{{$date->monthName}}</div>
							  
							  <div class="col-xs-1"></div>
							  <div class="col-xs-1 text-center small">
							  	@if($date->dayName != "samedi" and $date->dayName != "dimanche")
								   	{!!Form::checkbox('dateid[]', $date->id, true, ['class' => 'checkBoxClass1'])!!}
							    @endif
							  </div>
							  <div class="col-xs-1"></div>
							  <div class="col-xs-1 text-center small">
							  	@if($date->dayName != "samedi" and $date->dayName != "dimanche")
								   	{!!Form::checkbox('dateiddemi[]', $date->id, true, ['class' => 'checkBoxClass2'])!!}
							    @endif
							  </div>
							</div>
						</li>
					@endforeach
				@else
					@foreach ($dates as $date)
						<li class="list-group-item">
					  		<div class="row" "list-group-item">
							  <div class="col-xs-2 text-center small">{{$date->dayName}}</div>
							  <div class="col-xs-2 text-center small">{{$date->day}}</div>
							  <div class="col-xs-2 small">{{$date->monthName}}</div>
							  
							  <div class="col-xs-1"></div>
							  <div class="col-xs-1 text-center small">
							  	@if($date->dayName != "samedi" and $date->dayName != "dimanche")
								  	@foreach ($dateschecked as $i=>$datechecked)
								  		@if($date->id == $datechecked->calendar_id)
									   		{!!Form::checkbox('dateid[]', $date->id, true, ['class' => 'checkBoxClass1'])!!}
									   		@break;
									   	@elseif($i == (count($dateschecked)-1))
									   		{!!Form::checkbox('dateid[]', $date->id, false, ['class' => 'checkBoxClass1'])!!}
									   	@endif
									@endforeach
									@if(count($dateschecked) == 0)
										{!!Form::checkbox('dateid[]', $date->id, false, ['class' => 'checkBoxClass1'])!!}
									@endif
							    @endif
							  </div>
							  <div class="col-xs-1"></div>
							  <div class="col-xs-1 text-center small">
							  	@if($date->dayName != "samedi" and $date->dayName != "dimanche")
								  	@foreach ($datescheckeddemi as $i=>$datecheckeddemi)
								  		@if($date->id == $datecheckeddemi->calendar_id)
									   		{!!Form::checkbox('dateiddemi[]', $date->id, true, ['class' => 'checkBoxClass2'])!!}
									   		@break;
									   	@elseif($i == (count($datescheckeddemi)-1))
									   		{!!Form::checkbox('dateiddemi[]', $date->id, false, ['class' => 'checkBoxClass2'])!!}
									   	@endif
									@endforeach
									@if(count($datescheckeddemi) == 0)
										{!!Form::checkbox('dateiddemi[]', $date->id, false, ['class' => 'checkBoxClass2'])!!}
									@endif
							    @endif
							  </div>
							</div>
						</li>
					@endforeach
				@endif
			</ul>
		</form>
		<?php
		// Define the time zone based on the coordinated universal time
			$dateValue=date('Y-m-d H:i:s');
			$time=strtotime($dateValue);
			$curmonth=date("m",$time);
			$curyear=date("Y",$time);
			$curday=date("d",$time);
		?>
		@if ($date->year == $curyear)
			@if (Auth::user()->isAdmin() || ($date->month > $curmonth))
				{!!Form::submit('Sauvegarder', array('class' => 'btn btn-primary'))!!}
			@endif
		@elseif ($date->year > $curyear)
			{!!Form::submit('Sauvegarder', array('class' => 'btn btn-primary'))!!}
		@endif
	</div>
{!! Form::close() !!}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$("#ckbCheckAll1").click(function () {
	    $(".checkBoxClass1").prop('checked', $(this).prop('checked'));
	});
	$("#ckbCheckAll2").click(function () {
	    $(".checkBoxClass2").prop('checked', $(this).prop('checked'));
	});
});
</script>
@endsection