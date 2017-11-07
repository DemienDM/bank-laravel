@extends('layouts.app')

<?php
/**
 * @var array $balanceStat
 * @var array $usersStat
 */
?>

@section('content')
    <div class="row">
        <div class="col-md-6">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Статистика по возростным группам</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>
                        <tr>
                            <th><b>Возрастная группа</b></th>
                            <th><b>Средняя сумма вклада</b></th>
                        </tr>
                        @foreach ($usersStat as $userAgeStat)
                        <tr>
                            @foreach ($userAgeStat as $statItem)
                                <td>{{$statItem}}</td>
                            @endforeach
                        </tr>
                        @endforeach



                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Прибыль и потери по месяцам</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Месяц</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Прибыль</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Убыток</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($balanceStat as $balanceStatItem)
                                <tr role="row" class="odd">
                                    <td>{{ $balanceStatItem->month }}</td>
                                    <td>{{ $balanceStatItem->profit }}</td>
                                    <td>{{ $balanceStatItem->loss }}</td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

@endsection