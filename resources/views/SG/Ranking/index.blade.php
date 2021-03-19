@extends('layouts.layoutSG')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Ranking</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('RankingSG.create') }}" class="btn btn-info" >Añadir Ranking</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
                <th>Nombre</th>
                <th>Puntuación</th>
                <th>Fecha</th>
                <th>Modo</th>
             </thead>
             <tbody>
              @if($rankingList->count())  
              @foreach($rankingList as $ranking)  
              <tr>
                <td>{{$ranking->name}}</td>
                <td>{{$ranking->score}}</td>
                <td>{{$ranking->date}}</td>
                <td>{{$ranking->mode}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{route('RankingSG.edit', $ranking->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{route('RankingSG.destroy', $ranking->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">

                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                  </form>
                 </td>
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
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
      {{ $rankingList->links() }}
    </div>
  </div>
</section>

@endsection