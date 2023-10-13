<!-- Stored in resources/views/child.blade.php -->
@extends('layouts')
@section('title', __('base.agent_list'))
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('base.agent_list')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('base.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('base.agent_list')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <form method="get" action="{{route('agent')}}">
                        <div class="card-body row">
                            <!-- Date -->
                            <div class="form-group col-4">
                                <label>{{__('base.agent_name')}} :</label>
                                <div class="input-group date" id="fromDate" data-target-input="nearest">
                                    <input  type="text" class="form-control" name="key" value="{{request()->get('key')}}" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group col-4">
                                <label>{{__('base.level')}} :</label>
                                <div class="input-group date" id="fromDate" data-target-input="nearest">
                                    <input  type="number" class="form-control" name="level" value="{{request()->get('level')}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-body">

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{__('base.search')}}</button>
                            <a href="{{route('agent')}}" class="btn btn-primary">{{__('base.quit_search')}}</a>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if (isset($error))
                            <div class="alert alert-info bg-danger">{{$error}}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        @include('share.flash')
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{__('base.no.')}}</th>
                                        <th>{{__('base.user_name')}}</th>
                                        <th>{{__('base.agent_name')}}</th>
                                        <th>{{__('base.phone_number')}}</th>
                                        <th>Email</th>
                                        <th>{{__('base.address')}}</th>
                                        <th>{{__('base.bank_name')}}</th>
                                        <th>{{__('base.code')}}</th>
                                        <th>{{__('base.date_created')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($data) && $data->total())
                                        @php $i = $data->firstItem();@endphp
                                        @foreach($data as $item)
                                            <tr>
                                                <td>
                                                    {{$i}}
                                                </td>
                                                <td>{{$item['username']}}</td>
                                                <td>{{$item['nameagent']}}</td>
                                                <td>{{$item['phone']}}</td>
                                                <td>{{$item['email']}}</td>
                                                <td>{{$item['address']}}</td>
                                                <td>{{empty($item['namebank']) ? '': $item['namebank']}}</td>
                                                <td>{{$item['code']}}</td>
                                                <td>{{empty($item['createtime']) ? '': $item['createtime']}}</td>
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
    </script>
@endsection