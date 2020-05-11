@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Atualizar Produto</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ $product->path() }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <input value="{{ $product->name }}" type="text" name="name" placeholder="nome" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <input value="{{ $product->price }}" type="text" name="price" placeholder="preço" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            @include('partials.categories.select', ['selectedCategoryName' => $product->category->name])
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit"></i> Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
