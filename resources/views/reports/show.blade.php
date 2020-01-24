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
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="20%">#</th>
                                <th>Total</th>
                                <th>Data da venda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $key => $sale)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $sale->total }}</td>
                                    <td>{{ $sale->created_at }}</td>
                                </tr>
                            @empty
                                <tr class="table-info">
                                    <td colspan="5" align="center">Nenhum produto encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- card footer -->
            <div class="card-footer small text-muted">
                Total Vendas : {{ $sales->total() }}
            </div>
        </div>
        {{ $sales->appends(Request::all())->links() }}
    </div>
    <!-- sidebar -->
    <div class="col-md-4">
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Menu</div>
            <!-- card body -->
            <div class="card-body pb-0">

            </div>
        </div>
    </div>
    <!-- end sidebar -->
</div>
@endsection
