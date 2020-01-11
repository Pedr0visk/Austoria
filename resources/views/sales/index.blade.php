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
                                <th>SubTotal</th>
                                <th>Total</th>
                                <th><i class="fa fa-calendar"></i> data</th>
                                <th>detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $key => $sale)
                                <tr>
                                    <td>{{ $sales->firstItem() + $key }}</td>
                                    <td>{{ $sale->customer ? $sale->customer->name : 'Cliente excluido' }}</td>
                                    <td>{{ $sale->subtotal }}</td>
                                    <td>{{ $sale->total }}</td>
                                    <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                                    <td><a href="{{ $sale->path() }}" class="btn btn-small btn-success"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @empty
                                <tr class="table info">
                                    <td colspan="7" align="center">Items de venda vazio.</td>
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
            <div class="card-header">
                <a href="#" class="btn btn-info mr-2"><i class="fa fa-folder-open"></i></a>
                <a href="#" class="btn btn-warning mr-2"><i class="fa fa-download"></i></a>
                <a href="#" class="btn btn-danger"><i class="fa fa-edit"></i></a>
            </div>
            <div class="card-header">Filtro</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ route('sales.search') }}">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="">Início</label>
                            <input name="start_date" type="date" class="form-control mb-3">
                        </div>
                        <div class="col-12">
                            <label for="">Fim</label>
                            <input name="end_date" type="date" class="form-control mb-3">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="formControlRange">Por preço:</label>
                            <input class="form-control" type="range" name="total" id="maxPriceInputId" value="1" min="1" max="1000" oninput="maxPriceOutputId.value = maxPriceInputId.value">
                            <output name="maxPriceOutputName" id="maxPriceOutputId">1</output> R$
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end sidebar -->
</div>
@endsection
