<!-- Stored in resources/views/child.blade.php -->
@extends('layouts')
@section('title', __('base.list_player'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('base.list_player')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('base.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('base.list_player')}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="get" action="{{route('users')}}">
                    <div class="card-body row">
                        <div class="form-group col-4">
                            <label for="nn">{{__('base.nick_name')}}</label>
                            <input type="text" class="form-control" id="nn"  name="nn" autocomplete="off" value="{{request()->get('nn')}}">
                        </div>
                        <!-- Date -->
                        <div class="form-group col-4">
                            <label>{{__('base.since')}} :</label>
                            <div class="input-group date" id="fromDate" data-target-input="nearest">
                                <input disabled type="text" class="form-control datetimepicker-input" data-target="#fromDate" name="ft" value="{{request()->get('ft')}}">
                                <div class="input-group-append" data-target="#fromDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-4">
                            <label>{{__('base.to')}} :</label>
                            <div class="input-group date" id="toDate" data-target-input="nearest">
                                <input disabled type="text" class="form-control datetimepicker-input" data-target="#toDate"  name="et" value="{{request()->get('et')}}">
                                <div class="input-group-append" data-target="#toDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('base.search')}}</button>
                        <a href="{{route('users')}}" class="btn btn-primary">{{__('base.quit_search')}}</a>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    @if (isset($error))
                        <div class="alert alert-info bg-danger">{{$error}}</div>
                    @endif
                </div>

                <div class="col-12 mb-2 text-right">
                    <span class="mr-3">{{__('base.total_revenue')}} : {{number_format($totalData['total_doanhthu'], 0, '.', ',')}}</span>
                    <span class="mr-3">{{__('base.total_draw')}} : {{number_format($totalData['total_rut'], 0, '.', ',')}}</span>
                    <span class="mr-3">{{__('base.deposit_amount')}} : {{number_format($totalData['total_nap'], 0, '.', ',')}}</span>
                    <span class="mr-3">{{__('base.total_promotion')}} : {{number_format($totalData['total_km'], 0, '.', ',')}}</span>
                    <span class="mr-3">{{__('base.total_records')}} : @if(!empty($data)) {{$data->total()}} @endif</span>
                </div>

                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{__('base.no.')}}</th>
                                        <th>{{__('base.nick_name')}}</th>
                                        <th>{{__('base.balance')}}</th>
                                        <th>{{__('base.withdrawal_amount')}}</th>
                                        <th>{{__('base.deposit_amount')}}</th>
                                        <th>{{__('base.registration_date')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$firstItem}}</td>
                                            <td>{{$item['nick_name']}}</td>
                                            <td>{{number_format($item['vin'], 0, '.', ',')}}</td>
                                            <td>{{number_format($item['t_rut'], 0, '.', ',')}}</td>
                                            <td>{{number_format($item['t_nap'], 0, '.', ',')}}</td>
                                            <td>{{$item['create_time']}}</td>
                                        </tr>
                                    @php $firstItem++; @endphp
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="float-right mt-3">
                                @if(!empty($data))
                                    {{ $data->appends($params)->links() }}
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
<script>
    $(function () {
        //Date picker
        $('#fromDate').datetimepicker({
            format: 'Y-MM-DD',
            defaultDate: '{{$carbonNow->startOfMonth()->toDateString()}}'
        });
        $('#toDate').datetimepicker({
            format: 'Y-MM-DD',
            defaultDate:'{{$carbonNow->endOfMonth()->toDateString()}}'
        });
    })
</script>
@endsection