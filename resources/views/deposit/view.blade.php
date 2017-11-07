@extends('layouts.app')
<?php
/**
 * @var \App\Models\Deposit $deposit
 */
?>
@section('content')
    <div class="row">
        <div class="col-md-6">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Депозит "{{ $deposit->id }}"</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tbody>

                        <tr>
                            <th style="width:50px;">ID</th>
                            <th>{{ $deposit->id }}</th>
                        </tr>
                        <tr>
                            <th style="width:50px;">Ставка</th>
                            <th>{{ $deposit->interest_rate }}</th>
                        </tr>
                        <tr>
                            <th style="width:50px;">Баланс</th>
                            <th>{{ $deposit->balance }}</th>
                        </tr>

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
            <h3 class="box-title">Транзакции</h3>
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
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Тип</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Сумма</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php /** @var \App\Models\Transaction $transaction */?>
                            @foreach ($deposit->transactions as $transaction)
                                <tr role="row" class="odd">
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->direction }}</td>
                                    <td>{{ $transaction->total }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Тип</th>
                                <th rowspan="1" colspan="1">Сумма</th>
                                <th rowspan="1" colspan="1">Дата</th>
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