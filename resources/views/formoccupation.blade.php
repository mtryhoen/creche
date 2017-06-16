@extends('layouts.app')

@section('content')
<div class="container">
  <div class="jumbotron">
    <h1>Occupation de la crèche</h1>
    <p>Consultez les prévisions d'occupation par mois</p>
  </div>
</div>
{!! Form::open(array('action' => array('OccController@showcalendrier'), 'method' => 'post')) !!}
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

		{!!Form::submit('Afficher', array('class' => 'btn btn-primary'))!!}
	</div>
{!! Form::close() !!}
@endsection