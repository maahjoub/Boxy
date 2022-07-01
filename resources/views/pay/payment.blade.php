@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4 m-auto">
                <form action="{{ route('pay.store', $member->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $member->id }}">
                    <div class="form-group">
                        <input class="m-1 form-control" type="text" name="money"  placeholder="ادخل المبلغ">
                        @error('money')
                        <div class="alert alert-danger">{{ $message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="m-1 form-control" name="date" type="text" id="datepicker" onchange="this.dispatchEvent(new InputEvent('input'))" placeholder="اختر التاريخ">
                        @error('date')
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
@endsection
