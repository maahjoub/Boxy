@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="repotr-header">
            <div class="row">
                    <div class="card-header text-center d-flex justify-content-around">
                        <span class="header-title">التقرير العام </span>
                        <form action="{{route('deleteAll')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning m-1"><i class="fa fa-trash-o"> </i>حذف الجميع</button>
                        </form>
                    </div>
                <div class="stats">
                    <div class="col-md-3 text-center alert-info m-1 p-2">
                        <span class="title">عدد الاشتراك الكلي </span>
                        <h4 class="count text-info">{{ $allHands }}</h4>
                    </div>
                    <div class="col-md-3 text-center alert-danger m-1 p-2">
                        <span class="title">المبلغ الكلي</span>
                        <h4 id="all_money" class="all_money count text-danger">{{$allMoney}}</h4>
                    </div>
                    <div class="col-md-3 text-center alert-primary m-1 p-2">
                        <span class="title ">المبلغ المدفوع</span>
                        <h4 class="mem-mony count text-primary">{{ $memMoney }}</h4>
                    </div>
                    <div class="col-md-3 text-center alert-success m-1 p-2">
                        <span class="title">المبلغ المتبقي</span>
                        <h4 class="left-money count text-success">{{ $leftMoney }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let money = document.querySelector('.all_money'),
            memMony = document.querySelector('.mem-mony'),
            leftMoney = document.querySelector('.left-money')
        money.innerHTML = numbersWithComa(money.innerText)
        memMony.innerHTML = numbersWithComa(memMony.innerText)
        leftMoney.innerHTML = numbersWithComa(leftMoney.innerText)
        function numbersWithComa(n) {
            return n.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,",");
        }
    </script>
@stop
