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
                            <td class="w-all">{{ $member->wanted[0]->all_wanted }}</td>
                            <td class="w-mem">{{ $member->wanted[0]->mem_payment ?? 0}}</td>
                            <td class="w-mem-l">{{ $member->wanted[0]->all_wanted - $member->wanted[0]->mem_payment }}</td>
                            @if($member->wanted[0]->all_wanted == $member->wanted[0]->mem_payment)
                                <td class="d-flex justify-content-center align-items-center">
                                    <span class="btn btn-danger m-1"  ><i class="fa fa-lock"></i></span>
                                </td>
                            @else
                                <td class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('add.payment',$member->id) }}" class="btn btn-info m-1"><i class="fa fa-plus"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let memMoney = document.querySelectorAll('.w-mem'), leftMoney = document.querySelectorAll('.w-mem-l'), wAll = document.querySelectorAll('.w-all')
        memMoney.forEach((item) => {item.innerHTML = numbersWithComa(item.innerText)})
        wAll.forEach((item) => {item.innerHTML = numbersWithComa(item.innerText)})
        leftMoney.forEach((item) => {item.innerHTML = numbersWithComa(item.innerText)})
        function numbersWithComa(n) {
            return n.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,",");
        }
    </script>
@endsection
