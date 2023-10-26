<!-- Stored in resources/views/child.blade.php -->
@extends('layouts')
@section('title', __('base.game_stats'))
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('base.game_stats')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('base.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('base.game_stats')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <form method="get" action="{{route('game')}}">
                        <div class="card-body row">
                            <div class="form-group col-4">
                                <label>{{__('base.since')}} :</label>
                                <div class="input-group date" id="fromDate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#fromDate" name="ft" value="{{request()->get('ft')}}">
                                    <div class="input-group-append" data-target="#fromDate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-4">
                                <label>{{__('base.to')}} :</label>
                                <div class="input-group date" id="toDate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#toDate"  name="et" value="{{request()->get('et')}}">
                                    <div class="input-group-append" data-target="#toDate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-body">

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{__('base.search')}}</button>
                            <a href="{{route('game')}}" class="btn btn-primary">Quit searching</a>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-12">
                        @if (isset($error))
                        <div class="alert alert-info bg-danger">{{$error}}</div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Mini game</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Game Name</th>
                                        <th>Pay rewards</th>
                                        <th>Money bet</th>
                                        <th>Money refunded</th>
                                        <th>Waste</th>
                                        <th>Money wins in the game</th>
                                        <th>Money beats Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($data['listReportSlotMiniGame']))
                                        @foreach($data['listReportSlotMiniGame'] as $item)
                                            <tr>
                                                <td>{{$item['actionName']}}</td>
                                                <td>{{number_format($item['moneyWin'], 0, '.', ',')}}</td>
                                                <td>{{number_format($item['moneyLost'], 0, '.', ',')}}</td>
                                                <td>{{number_format($item['moneyOther'], 0, '.', ',')}}</td>
                                                <td>{{number_format($item['fee'], 0, '.', ',')}}</td>
                                                <td>{{number_format($item['revenue'], 0, '.', ',')}}</td>
                                                <td>{{number_format($item['revenuePlayGame'], 0, '.', ',')}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Card game</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Game Name</th>
                                        <th>Pay rewards</th>
                                        <th>Money bet</th>
                                        <th>Money refunded</th>
                                        <th>Waste</th>
                                        <th>Money wins in the game</th>
                                        <th>Money beats Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($data['listReportGameBai']))
                                    @foreach($data['listReportGameBai'] as $item)
                                    <tr>
                                        <td>{{$item['actionName']}}</td>
                                        <td>{{number_format($item['moneyWin'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['moneyLost'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['moneyOther'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['fee'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['revenue'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['revenuePlayGame'], 0, '.', ',')}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Other Games</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Game Name</th>
                                        <th>Pay rewards</th>
                                        <th>Money bet</th>
                                        <th>Money refunded</th>
                                        <th>Waste</th>
                                        <th>Money wins in the game</th>
                                        <th>Money beats Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($data['listReportGameKhac']))
                                    @foreach($data['listReportGameKhac'] as $item)
                                    <tr>
                                        <td>{{$item['actionName']}}</td>
                                        <td>{{number_format($item['moneyWin'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['moneyLost'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['moneyOther'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['fee'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['revenue'], 0, '.', ',')}}</td>
                                        <td>{{number_format($item['revenuePlayGame'], 0, '.', ',')}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $(function () {
                //Date picker
                $('#fromDate').datetimepicker({
                    format: 'Y-MM-DD',
                    defaultDate: '{{date("Y-m-d",strtotime("-7 days"))}}'
                });
                $('#toDate').datetimepicker({
                    format: 'Y-MM-DD',
                    defaultDate:new Date()
                });
            })
        })
    </script>
@endsection