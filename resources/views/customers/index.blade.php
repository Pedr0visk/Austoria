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
            <div class="card-header">Clientes</div>
            <!-- card body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>nome</th>
                                <th>instagram</th>
                                <th>Histórico</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $key => $customer)
                                <tr>
                                    <td>{{ $customers->firstItem() + $key }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>@ {{ $customer->instagram }}</td>
                                    <td align="center">
                                        <a href="{{ route('customers.history', $customer->id) }}" class="btn btn-primary"><i class="fa fa-history"></i></a>
                                        </td>
                                    <td>
                                        <a href="{{ $customer->path() }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('customers.destroy', $customer->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="table-info">
                                    <td colspan="5" align="center">Nenhum cliente encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- card footer -->
            <div class="card-footer small text-muted">
                Total Produtos : {{ $customers->total() }}
            </div>
        </div>
        {{ $customers->appends(Request::all())->links() }}
    </div>
    <!-- sidebar -->
    <div class="col-md-4">
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Cadastrar Cliente</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <input type="text" name="name" placeholder="nome" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <input type="email" name="email" placeholder="Example@gmail.com..." class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" name="phone" placeholder="(24) 99999-9999" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <input type="date" name="dob" placeholder="31/08/1997" class="form-control">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Buscar Cliente</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ route('customers.index') }}">
                    <div class="form-group mb-3 p-2">
                        <input id="search-box" name="name" type="text" class="form-control" placeholder="Nome do cliente..." value="{{ Request::get('name') }}">
                    </div>
                    <button class="btn btn-info btn-block mb-3" type="submit">Filtrar <i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <!-- end sidebar -->
</div>
@endsection
