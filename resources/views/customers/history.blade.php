@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-sm-12">
        <!-- card -->
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Histórico de vendas do(a) cliente <span class="mx-2 text-primary">{{ $customer->name }}</span></div>
            <!-- card body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%"><i class="fa fa-calendar"></i> data da venda</th>
                                <th width="60%"><i class="fas fa-shopping-cart"></i> carrinho</th>
                                <th width="10%"><i class="fa fa-dollar-sign"></i> total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customer->sales as $key => $sale)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td align="center">{{ $sale->created_at->format('d-m-Y') }}</td>
                                    <td align="left">
                                        @foreach($sale->items as $item)
                                        {{ $item->quantity}}x {{ $item->product->name}},
                                        @endforeach
                                    </td>
                                    <td align="center">
                                        <strong>{{ $sale->total }}</strong>
                                    </td>
                                </tr>
                            @empty
                                <tr class="table-info">
                                    <td colspan="5" align="center">Nenhuma venda encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
