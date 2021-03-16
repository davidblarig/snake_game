@extends('layouts.layoutSG')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Ranking</h3></div>
          <!--<div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('RankingSG.create') }}" class="btn btn-info" >Añadir Ranking</a>
            </div>
          </div>-->
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Puntuación</th>
               <th>Fecha</th>
               <th>Modo</th>
             </thead>
             <tbody>
              @if($rankings->count())  
              @foreach($rankings as $ranking)  
              <tr>
                <td>{{$ranking->score}}</td>
                <td>{{$ranking->date}}</td>
                <td>{{$ranking->mode}}</td>
                <!--<td><a class="btn btn-primary btn-xs" href="{{action('RankingSG.edit', $ranking->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                <td>
                  <form action="{{action('RankingSG.destroy', $ranking->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">

                   <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                 </td>-->
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
              </tr>
              @endif
            </tbody>

          </table>
        </div>
      </div>
      <!--{{ $rankings->links() }}-->
      <div class="pull-left">
        <div class="btn-group">
          <a href="{{ route('ThematicSG.store') }}" class="btn btn-info" >Volver</a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection