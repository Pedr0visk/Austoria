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
                                <th width="85%">nome</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $key }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">x</button>
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
                Total Categorias : {{ $categories->total() }}
            </div>
        </div>
        {{ $categories->appends(Request::all())->links() }}
    </div>
    <!-- sidebar -->
    <div class="col-md-4">
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Adicionar Categoria</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <input type="text" name="name" placeholder="nome" class="form-control">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-plus"></i> Adicionar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end sidebar -->
</div>
@endsection
