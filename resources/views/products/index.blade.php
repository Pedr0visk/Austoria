@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-8 col-sm-12">
        <!-- card -->
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Produtos</div>
            <!-- card body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>nome</th>
                                <th>preço</th>
                                <th>categoria</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $key => $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $key }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <!-- <td>
                                        <a href="{{ route('products.edit', $product) }}"><i class="fa fa-pencil"></i></a>
                                        <delete-action action="{{ route('products.destroy', $product) }}" class="ml-2 text-danger">
                                            <i class="fa fa-trash"></i>
                                        </delete-action>
                                    </td> -->
                                </tr>
                            @empty
                                <tr class="table-info">
                                    <td colspan="5" align="center">products empty or not found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- card footer -->
            <div class="card-footer small text-muted">
                Total Produtos : {{ $products->total() }}
            </div>
        </div>
        {{ $products->appends(Request::all())->links() }}
    </div>
    <!-- sidebar -->
    <div class="col-md-4">
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Cadastrar Produto</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <input type="text" name="name" placeholder="nome" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" name="price" placeholder="preço" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <select class="form-control" id="category" name="category_id">
                                <option value="">Selecione uma Categoria</option>
                                @forelse($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
            <div class="card-header">Filtrar Produtos</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ route('products.index') }}">
                    <div class="form-group mb-3 p-2">
                        <input id="search-box" name="name" type="text" class="form-control" placeholder="Pesquisar produto..." value="{{ Request::get('name') }}">
                    </div>

                    <div class="form-group mb-3 p-2">
                        <select class="form-control" id="category" name="category">
                            <option value="">Selecione uma Categoria</option>
                            @forelse($categories as $category)
                                @if( Request::get('category') == $category->id)
                                    <option selected value="{{ $category->id}}">{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id}}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3 p-2">
                        <label for="">De:</label>
                        <input type="range" name="min_price" id="minPriceInputId" value="{{ Request::get('min_price')}}" min="2" max="1000" oninput="minPriceOutputId.value = minPriceInputId.value">
                        <output name="minPriceOutputName" id="minPriceOutputId">{{ Request::get('min_price')}}</output> R$
                    </div>

                    <div class="form-group mb-3 p-2">
                        <label for="">Até:</label>
                        <input type="range" name="max_price" id="maxPriceInputId" value="{{ Request::get('max_price')}}" min="2" max="1000" oninput="maxPriceOutputId.value = maxPriceInputId.value">
                        <output name="maxPriceOutputName" id="maxPriceOutputId">{{ Request::get('max_price')}}</output> R$
                    </div>

                    <button class="btn btn-success btn-block mb-3" type="submit">Filtrar <i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <!-- end sidebar -->
</div>
@endsection
