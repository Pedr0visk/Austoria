@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-10 col-sm-12">
        <!-- card -->
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Venda {{ $sale->id }}</div>
            <!-- card body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th width="2%">quantidade</th>
                                <th width="25%">Produto</th>
                                <th width="5%">Unid.</th>
                                <th width="3%">Sobtotal</th>
                                <th width="3%">Desconto</th>
                                <th width="7%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sale->items as $key => $item)
                            <tr>
                                <td width="2%">{{ $item->quantity }}x</td>
                                <td>{{ $item->product ? $item->product->name : 'Produto excluído' }}</td>
                                <td align="left">
                                    {{ number_format($item->price, 2, ',', '.') }} R$
                                </td>
                                <td align="center">
                                    {{ number_format($item->subtotalAmount, 2, ',', '.') }} R$
                                </td>
                                <td align="center">{{ $item->discount }} %</td>
                                <td>R$ {{ number_format($sale->payment->amount, 2, ',', '.') }} R$</td>
                            </tr>
                        @endforeach
                            <tr class="table-success">
                                <td align="center">
                                    <h2><strong> {{$sale->payment->pay_method_name}} </strong></h2>
                                </td>
                                <td colspan="6" align="right">
                                    Total =
                                    <h2><strong>R$ {{ $sale->payment->amount }}</strong></h2>
                                    <small>Sujeito à desconto de acordo com o método de pagamento</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
