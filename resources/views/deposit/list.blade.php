@extends('layouts.app')
<?php
/**
 * @var \App\Models\Deposit[] $deposits
 */
?>
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Депозиты</h3>
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
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Пользователь</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Ставка</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Стартовый взнос</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Текущий баланс</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Создан</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Детали</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php /** @var \App\Models\Deposit $deposit */?>
                            @foreach ($deposits as $deposit)
                                <tr role="row" class="odd">
                                    <td>{{ $deposit->id  }}</td>
                                    <td>{{ $deposit->user->getFullName() }}</td>
                                    <td>{{ $deposit->interest_rate }}</td>
                                    <td>{{ $deposit->start_value }}</td>
                                    <td>{{ $deposit->balance }}</td>
                                    <td>{{ $deposit->created_at }}</td>
                                    <td><a href="{{ route('deposit', ['id' => $deposit->id]) }}"><i class="fa fa-fw fa-gear"></i></a></td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Пользователь</th>
                                <th rowspan="1" colspan="1">Ставка</th>
                                <th rowspan="1" colspan="1">Стартовый взнос</th>
                                <th rowspan="1" colspan="1">Текущий баланс</th>
                                <th rowspan="1" colspan="1">Создан</th>
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