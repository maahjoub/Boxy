@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card-header d-flex justify-content-between px-4 align-items-center ">
                    <h2 class="h1 title">إضافة مشترك </h2>
                    <a href="/" class="btn btn-primary btn-sm add p-1">العودة <i class="fa fa-arrow-left"></i></a>
                </div>
                <div class="card-body">
                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="form-group m-1">
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="أدخل إسم المشترك">
                        </div>
                        <div class="form-group m-1">
                            @error('name')
                                <div class="alert alert-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group m-1">
                            <input type="text" class="form-control" name="hand" value="{{old('hand')}}" placeholder="أدخل عدد الاشتراك">
                        </div>
                        <div class="form-group m-1">
                            @error('hand')
                                <div class="alert alert-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group m-1">
                            <button type="submit" class="form-control btn btn-secondary">إضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
