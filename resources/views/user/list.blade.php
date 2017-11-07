@extends('layouts.app')
<?php
/**
 * @var \App\Models\User[] $users
 */
?>
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Клиенты</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
                <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ID</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ФИО</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ИНН</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Дата рождения</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Детали</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($users as $user)
                            <tr role="row" class="odd">
                                <td>{{ $user->id  }}</td>
                                <td>{{ $user->getFullName() }}</td>
                                <td>{{ $user->inn }}</td>
                                <td>{{ $user->birthday }}</td>
                                <td><a href="{{ route('user', ['id' => $user->id]) }}"><i class="fa fa-fw fa-gear"></i></a></td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">ID</th>
                            <th rowspan="1" colspan="1">ФИО</th>
                            <th rowspan="1" colspan="1">ИНН</th>
                            <th rowspan="1" colspan="1">Дата рождения)</th>
                            <th rowspan="1" colspan="1">Детали</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                </div>
            </div>
        <!-- /.box-body -->
        </div>
    </div>
@endsection