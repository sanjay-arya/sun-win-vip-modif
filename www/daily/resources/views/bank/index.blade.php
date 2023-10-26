<!-- Stored in resources/views/child.blade.php -->
@extends('layouts')
@section('title', __('base.list_banks'))
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('base.list_banks')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('base.home')}}</a></li>
                            <li class="breadcrumb-item active">{{__('base.list_banks')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <form method="get" action="{{route('banks')}}">
                        <div class="card-body row">
                            <!-- Date -->
                            <div class="form-group col-4">
                                <label>{{__('base.bank_code')}} :</label>
                                <div class="input-group date" id="fromDate" data-target-input="nearest">
                                    <input  type="text" class="form-control" name="key" value="{{request()->get('key')}}" autocomplete="off">
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-body">

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{__('base.search')}}</button>
                            <a href="{{route('banks')}}" class="btn btn-primary">{{__('base.quit_search')}}</a>
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
                                        <th>{{__('base.bank_account')}}</th>
                                        <th>{{__('base.bank_code')}}</th>
                                        <th>{{__('base.account_number')}}</th>
                                        <th>{{__('base.branch')}}</th>
                                        <th></th>
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
                                                <td>{{$item['bank_acount']}}</td>
                                                <td>{{$item['bank_code']}}</td>
                                                <td>{{$item['bank_number']}}</td>
                                                <td>{{$item['bank_branch']}}</td>
                                                <td>
                                                    <a href="{{route('bank-edit', $item['id'])}}" class="mr-4">Sửa</a>

                                                    <span style="color:#007bff;cursor:pointer" onclick="deleteAction({{$item['id']}}, '{{$item['bank_acount']}}')">Erase</span>
                                                </td>
                                            @php $i++;@endphp
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
    <!-- Modal -->
    @include("bank.delete")
    <!-- Modal -->
@endsection
@section('script')
    <script>
        function deleteAction(id, bn) {
            $('#deleteModalCenter').modal('show')
            $('#delete-content').html('Are you sure you want to delete: ' + bn);
            $('#delete-modal-bank').val(id);
        }

        $("#form-delete").submit(function( event ) {
            var data = $(this).serializeArray();
            $.ajax({
                    type: 'post',
                    url: '{{route('bank-delete')}}',
                    data: data,
                    success: function (response) {
                        $('#deleteModalCenter').modal('hide');
                        console.log(response);
                        location.reload()
                    },
                    error: function (error) {
                        $('#deleteModalCenter').modal('hide');
                        console.log(error);
                        alert('Delete failed');
                    }
                }
            );
            event.preventDefault();
        });

    </script>
@endsection