<!-- Stored in resources/views/child.blade.php -->
@extends('layouts')
@section('title', __('base.day_report'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('base.day_report')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('base.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('base.day_report')}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="get" action="{{route('daily-report')}}">
                    <div class="card-body row">
                        <div class="form-group col-4">
                            <label>{{__('base.day')}} :</label>
                            <div class="input-group date" id="fromDate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#fromDate" name="t" value="{{request()->get('t')}}">
                                <div class="input-group-append" data-target="#fromDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{__('base.search')}}</button>
                        <a href="{{route('daily-report')}}" class="btn btn-primary">{{__('base.quit_search')}}</a>
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
                    {{__('base.total_records')}} : @if(!empty($data)) {{$data->total()}} @endif
                </div>
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>{{__('base.no.')}}</th>
                                    <th>{{__('base.day')}}</th>
                                    <th>{{__('base.nick_name')}}</th>
                                    <th>{{__('base.total_charge')}}</th>
                                    <th>{{__('base.total_draw')}}</th>
                                    <th>{{__('base.total_refund')}}</th>
                                    <th>{{__('base.total_bonus')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data) && $data->total())
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$firstItem}}</td>
                                            <td>{{$item['time_report']}}</td>
                                            <td>{{$item['nick_name']}}</td>
                                            <td>{{$item['deposit']}}</td>
                                            <td>{{$item['withdraw']}}</td>
                                            <td>{{$item['t_refund']}}</td>
                                            <td>{{$item['t_bonus']}}</td>
                                        </tr>
                                        @php $firstItem++; @endphp
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="float-right mt-3">
                                @if(!empty($data))
                                {{ $data->links() }}
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
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
            defaultDate: '{{date("Y-m-d",strtotime("-30 days"))}}'
        });
    })
</script>
@endsection