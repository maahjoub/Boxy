@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-9 m-auto details mt-100">
                <div class="card-header d-flex justify-content-between px-4 align-items-center ">
                    <h2 class="h1 title">المشتركين </h2>
                    <a href="{{ route('add.form') }}" class="btn btn-primary btn-sm add p-1">إضافة مشترك <i class="fa fa-plus"></i></a>
                </div>
                <table id="datatable" class="table table-bordered table-sm  p-2 text-center" data-page-length="10">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>عدد الاشتراك</th>
                        <th>عدد الاشتراك المصروف</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="font-bold">{{ $member->name }}</td>
                            <td>{{ $member->hands }}</td>
                            <td>{{ count($member->check) }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                @if($member->deleted_at == null)
                                    <a href="{{ route('edit.form',$member->id) }}" class="btn btn-info m-1"><i class="fa fa-edit"></i></a>
                                    @php
                                        $checkout = null
                                     @endphp
                                    @foreach($member->check as $check)
                                        @php $checkout = count($member->check) @endphp
                                    @endforeach
                                        @if($member->hands > $checkout)
                                            <form action="{{route('check.out', $member->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $member->id }}">
                                                <button type="submit" class="btn btn-success m-1">صرفة<i class="fa fa-check"> </i></button>
                                            </form>
                                        @else
                                            <button type="submit" disabled class="btn btn-secondary m-1">صرفة<i class="fa fa-check"> </i></button>
                                        @endif
                                    @if($checkout > 0)
                                        <form action="{{route('uncheck.out', $member->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $member->id }}">
                                            <button type="submit" class="btn btn-warning m-1"><i class="fa fa-undo"> </i></button>
                                        </form>
                                    @else
                                        <span type="submit" class="btn btn-secondary m-1"><i class="fa fa-undo"> </i></span>
                                    @endif
                                    <form action="{{route('destroy', $member->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                @else
                                    <form action="{{route('forceDestroy', $member->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                    <a href="{{ route('posts.restore', $member->id) }}" class="btn btn-warning m-1"><i class="fa fa-recycle"></i></a>
                                @endif
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
