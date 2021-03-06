@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-sm-12">
        <!-- card -->
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Vendas</div>
            <!-- card body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Forma de pagamento</th>
                                <th>Total</th>
                                <th><i class="fa fa-calendar"></i> data</th>
                                <th>detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $key => $sale)
                                <tr>
                                    <td>{{ $sales->firstItem() + $key }}</td>
                                    <td>{{ $sale->customer()->withTrashed()->first()->name }}</td>
                                    <td>{{ $sale->payment->pay_method_name }}</td>
                                    <td>{{ $sale->total }}</td>
                                    <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                                    <td><a href="{{ $sale->path() }}" class="btn btn-small btn-success"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @empty
                                <tr class="table-info">
                                    <td colspan="6" align="center">Nenhuma venda encontrada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- card footer -->
            <div class="card-footer small text-muted">
                Total Item : {{ $sales->total() }}
            </div>
        </div>
        {{ $sales->appends(Request::all())->links() }}
    </div>
    <!-- sidebar -->
    <div class="col-md-4">
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Filtro</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ route('sales.search') }}">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="">Início</label>
                            <input name="start_date" value="{{ Request::get('start_date') }}" type="date" class="form-control mb-3">
                        </div>
                        <div class="col-12">
                            <label for="">Fim</label>
                            <input name="end_date" value="{{ Request::get('end_date') }}" type="date" class="form-control mb-3">
                        </div>
                        <div class="col-12 mb-3">
                            @include('partials.paymethods.select')
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-3 widget-content">
            <div class="widget-content-outer">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="widget-heading">Lucro</div>
                        <div class="widget-subheading">TOTAL</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-success">{{ $totalAmount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end sidebar -->
</div>
@endsection
