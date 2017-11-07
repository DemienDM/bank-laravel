@extends('layouts.app')

@section('content')
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
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Депозит ID</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Пользователь</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Тип</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Сумма</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php /** @var \App\Models\Transaction $transaction */?>
                        @foreach ($transactions as $transaction)
                            <tr role="row" class="odd">
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->deposit->id }}</td>
                                <td>{{ $transaction->deposit->user->getFullName() }}</td>
                                <td>{{ $transaction->direction }}</td>
                                <td>{{ $transaction->total }}</td>
                                <td>{{ $transaction->created_at }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">ID</th>
                            <th rowspan="1" colspan="1">Депозит ID</th>
                            <th rowspan="1" colspan="1">Пользователь</th>
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