@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-9 m-auto details mt-100">
                <div class="card-header d-flex justify-content-between px-4 align-items-center ">
                    <h2 class="h1 title">مدفوعات المشتركين </h2>
                </div>
                <table id="datatable" class="table table-bordered table-sm  p-2 text-center" data-page-length="10">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>عدد الاشتراك</th>
                        <th>المبلع الكلي</th>
                        <th>المبلع المدفوع</th>
                        <th>المبلع المتبقي</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="font-bold">{{ $member->name }}</td>
                            <td>{{ $member->hands }}</td>
                            <td>{{ $member->wanted[0]->all_wanted }}</td>
                            <td>{{ $member->wanted[0]->mem_payment ?? 0}}</td>
                            <td>{{ $member->wanted[0]->mem_payment_left ?? 0 }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('add.payment',$member->id) }}" class="btn btn-info m-1"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
