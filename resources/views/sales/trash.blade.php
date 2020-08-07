@extends('layouts.app')

@section('main-content')

<div class="row">
    <div class="col-md-12 col-sm-12">
        <!-- card -->
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Vendas Excluídas</div>
            <!-- card body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Transação</th>
                                <th>Subtotal</th>
                                <th>Total</th>
                                <th><i class="fa fa-calendar"></i> data</th>
                                <th>Recuperar</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $key => $sale)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $sale->customer()->withTrashed()->first()->name }}</td>
                                    <td>{{ $sale->payment->pay_method_name }}</td>
                                    <td>{{ number_format($sale->subtotal, 2, ',', '.') }}</td>
                                    <td>{{ $sale->payment->amount }}</td>
                                    <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                                    <td><a href="{{ route('sales.restore', $sale->id) }}" class="btn btn-small btn-success"><i class="fa fa-undo"></i></a></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#detroySale">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="table info">
                                    <td colspan="8" align="center">Items de venda vazio.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- card footer -->
            <div class="card-footer small text-muted text-white">
                Total Item : {{ $sales->total() }}
            </div>
        </div>
        {{ $sales->appends(Request::all())->links() }}
    </div>
</div>
@endsection
