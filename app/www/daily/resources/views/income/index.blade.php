<!-- Stored in resources/views/child.blade.php -->
@extends('layouts')
@section('title', __('base.my_income'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('base.my_income')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('base.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('base.my_income')}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="get" action="{{route('income')}}">
                    <div class="card-body row">
                        <!-- Date -->
                        <div class="form-group col-4">
                            <label>{{__('base.month')}} :</label>
                            <div class="input-group date" id="fromDate" data-target-input="nearest">
                                <input disabled type="text" class="form-control datetimepicker-input" data-target="#fromDate" name="t" value="{{request()->get('t')}}" autocomplete="off">
                                <div class="input-group-append" data-target="#fromDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-body">

                    </div>
                    <!-- /.card-body -->
                    {{--<div class="card-footer">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{route('income')}}" class="btn btn-primary">Bỏ tìm kiếm</a>
                    </div>--}}
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    @if (isset($error))
                    <div class="alert alert-info bg-danger">{{$error}}</div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>{{__('base.total_charge')}}</th>
                                    <th>{{__('base.total_draw')}}</th>
                                    <th>{{__('base.total_refund')}}</th>
                                    <th>{{__('base.total_promotion')}}</th>
                                    <th>{{__('base.fee')}}</th>
                                    <th>{{__('base.profit')}}</th>
                                    <th>{{__('base.discount')}}</th>
                                    <th>{{__('base.active_members')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data) && $data->total())
                                    @foreach($data as $item)
                                    <tr>
                                        <td>
                                            <span class="{{($item['totalDeposit'] < 0) ? 'text-danger': 'text-green'}}">
                                                {{$item['totalDeposit']}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{($item['totalWithdraw'] < 0) ? 'text-danger': 'text-green'}}">
                                                {{$item['totalWithdraw']}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{($item['totalFund'] < 0) ? 'text-danger': 'text-green'}}">
                                            {{$item['totalFund']}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{($item['totalBonus'] < 0) ? 'text-danger': 'text-green'}}">
                                            {{$item['totalBonus']}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{($item['feeGameThrd'] < 0) ? 'text-danger': 'text-green'}}">
                                            {{$item['feeGameThrd']}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{($item['profit'] < 0) ? 'text-danger': 'text-green'}}">
                                            {{$item['profit']}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{($item['commission'] < 0) ? 'text-danger': 'text-green'}}">
                                            {{$item['commission']}}
                                            </span>
                                        </td>
                                        <td>{{$item['memberActives']}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            {{__('base.not_found')}}
                                        </td>
                                    </tr>
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
        //$.datetimepicker.setLocale('pl');
        //Date picker
            $('#fromDate').datetimepicker({
            format: 'Y-MM',
            defaultDate: '{{date("Y-m")}}'
        });

    })
</script>
@endsection