@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <!-- card header -->
            <div class="card-header">Atualizar Cliente</div>
            <!-- card body -->
            <div class="card-body pb-0">
                <form action="{{ $customer->path() }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <input value="{{ $customer->name }}" type="text" name="name" placeholder="nome" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <input value="{{ $customer->instagram }}" type="text" name="instagram" placeholder="@userinstagram" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <input value="{{ $customer->phone }}" type="text" name="phone" placeholder="(24) 99999-9999" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <input value="{{ $customer->dob->format('Y-m-d') }}" type="date" name="dob" placeholder="31/08/1997" class="form-control">
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
