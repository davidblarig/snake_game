@extends('layouts.layoutSG')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista Temáticas</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('ThematicSG.create') }}" class="btn btn-info" >Añadir Temática</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Tipo</th>
               <th>Nombre</th>
               <th>Descripción</th>
               <th>Fondo</th>
               <th>Color Serpiente</th>
             </thead>
             <tbody>
              @if($thematicsList->count()) 
              @foreach($thematicsList as $thematic) 
              <tr>
                <td>{{$thematic->type}}</td>
                <td>{{$thematic->name}}</td>
                <td>{{$thematic->description}}</td>
                <td><img src="images/imagesSG/{{$thematic->background}}" width="150px" height="100px"></td>
                <td>{{$thematic->snake_color}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{route('ThematicSG.edit', $thematic->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{route('ThematicSG.destroy', $thematic->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">

                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                   </form>
                </td>
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="6">No hay registro !!</td>
              </tr>
              @endif
            </tbody>

          </table>
          <div class="pull-left">
            <div class="btn-group">
              <a href="{{ route('GameSG.index') }}" class="btn btn-info" >Volver</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection