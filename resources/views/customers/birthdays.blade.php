@extends('layouts.app')

@section('main-content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row">
    <div class="col-md-8 col-sm-12">
        <!-- card -->
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">
                <span> Aniversariantes do mês </span>
            </div>
            <!-- card body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 table-striped">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>nome</th>
                                <th>instagram</th>
                                <th>  <i class="fa fa-birthday-cake"> </i> Data de aniversário</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $key => $customer)
                                <tr>
                                    <td>{{ $customers->firstItem() + $key }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>@ {{ $customer->instagram }}</td>
                                    <td align="center">
                                        {{ $customer->dob->format('d/m') }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="table-info">
                                    <td colspan="5" align="center">Nenhum aniversariante esse mês.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- card footer -->
            <div class="card-footer small text-muted">
                Número de aniversariantes : {{ $customers->total() }}
            </div>
        </div>
        {{ $customers->appends(Request::all())->links() }}
    </div>
</div>
@endsection
