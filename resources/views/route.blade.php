@extends('adminlte::page')

@section('title', 'Rute | Flicker')

@section('content_header')
<h1>Pesawat</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">Cari Data Rute</h1>
        <div class="box-tools pull-right">
            <a href="{{url('admin/route/new')}}"><button class="btn btn-success">Tambah</button></a>
        </div>
    </div>
    <div class="box-body">
        <table id="table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Dari</th>
                    <th>Ke</th>
                    <th>Harga</th>
                    <th>Pesawat</th>
                    <th>Berangkat Pada</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($route as $a)
                <tr>
                    <td>{{$a->id}}</td>
                    <td>{{$a->airportFrom->code}}<br>({{$a->airportFrom->city}})</td>
                    <td>{{$a->airportTo->code}}<br>({{$a->airportTo->city}})</td>
                    <td>{{$a->price}}</td>
                    <td>{{$a->plane->code}} <br> ({{$a->plane->airline->name}})</td>
                    <td>{{$a->depart_at}}</td>
                    <td>
                        <a href="{{url('admin/route/'.$a->id)}}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{url('admin/route/'.$a->id.'/delete')}}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
        The footer of the box
    </div><!-- box-footer -->
</div><!-- /.box -->
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('#table').dataTable();
    });

</script>
@stop
