@extends('layouts.app')

@section('content')
<div class="container">
  <div class="jumbotron">
    <h1>Calendrier de présence</h1>
    <p>Consultez ou entrez les dates de présences de votre enfant</p>
  </div>
</div>
{!! Form::open(array('action' => array('CalController@showcalendrier'), 'method' => 'post')) !!}
    <div class="container">
    	<p><b>Selectionner Mois</b><br />
    	{!! Form::select('month', array(1 =>'Janvier', 2 =>'Fevrier', 3 =>'Mars', 4 =>'Avril', 5 =>'Mai', 6 =>'Juin', 7 =>'Juillet', 8 =>'Aout', 9 =>'Septembre', 10 =>'Octobre', 11 =>'Novembre', 12 =>'Decembre'), 'Janvier')!!}
    	<?php
		// Define the time zone based on the coordinated universal time
			date_default_timezone_set('UTC');
			//echo date(' F Y');
			echo "</p>";
			$annee = date ('Y');
			$annee1 = $annee+1;
			$annee0 = $annee-1;
		?>
		<p><b>Selectionner Année</b><br />
			{!! Form::select('year', array($annee0 =>$annee0, $annee => $annee, $annee1 => $annee1), $annee)!!}
		<br/><br>
		@if (Auth::user()->isAdmin())
			<p><b>Selectionner Enfant</b><br />
				{!! Form::select('user', $user)!!}
			<br/><br/>
		@endif

		{!!Form::submit('Afficher/Modifier', array('class' => 'btn btn-primary'))!!}
	</div>
{!! Form::close() !!}
@endsection