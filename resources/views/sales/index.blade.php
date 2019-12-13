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
                                <th ><i class="fa fa-calendar"></i> data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sales as $key => $sale)
                                <tr>
                                    <td>{{ $sales->firstItem() + $key }}</td>
                                    <td>{{ $sale->customer->name }}</td>
                                    <td>{{ $sale->subtotal }}</td>
                                    <td>{{ $sale->total }}</td>
                                    <td>23/03/2019</td>
                                </tr>
                            @empty
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

                <fieldset class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="opcao1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                Hoje
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="opcao2">
                                <label class="form-check-label" for="gridRadios2">
                                Esse mês
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="opcao2">
                                <label class="form-check-label" for="gridRadios2">
                                Esse ano
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="col-12">
                        <label for="">Início</label>
                        <input type="date" class="form-control mb-3">
                    </div>
                    <div class="col-12">
                        <label for="">Fim</label>
                        <input type="date" class="form-control mb-3">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="formControlRange">Por preço:</label>
                        <input type="range" class="form-control-range" id="formControlRange">
                        <label for="">20</label>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> Filtrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end sidebar -->
</div>
@endsection
