@extends('layouts.layoutSG')
@section('content')
<div class="row">
	<section class="content">
		<div class="col-md-8 col-md-offset-2">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Error!</strong> Revise los campos obligatorios.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(Session::has('success'))
			<div class="alert alert-info">
				{{Session::get('success')}}
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nueva Temática</h3>
				</div>
				<div class="panel-body">					
					<div class="table-container">
						<form method="POST" action="{{ route('ThematicSG.update',$thematic->id) }}"  role="form" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PUT">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="type" id="type" class="form-control input-sm" value="{{$thematic->type}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="name" id="name" class="form-control input-sm" value="{{$thematic->name}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<textarea name="description" class="form-control input-sm"  placeholder="Descripción">{{$thematic->description}}</textarea>
							</div>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="file" name="background" id="background" class="form-control input-sm" >
										<img src="{{ url('images/imagesSG/'.$thematic->background) }}" width='100px'>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group form-control input-sm">
										<label for="snake_color">Color de la serpiente:</label>
										<select name="snake_color" id="snake_color">
											<option value="{{$thematic->snake_color}}" selected disabled hidden>{{$thematic->snake_color}}</option>
											<option value="Verde">Verde</option>
											<option value="Rojo">Rojo</option>
											<option value="Azul">Azul</option>
										</select>
									</div>
								</div>
							</div>
							
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('ThematicSG.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	

							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
	@endsection