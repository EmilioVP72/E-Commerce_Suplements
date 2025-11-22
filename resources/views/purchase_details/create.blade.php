@extends('administration')

@section('content')
<div class="container">
    <h1 class="my-4">Crear Nuevo Detalle de Compra</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('purchase_details.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="id_purchase" class="form-label">Compra</label>
                    <select class="form-select @error('id_purchase') is-invalid @enderror" id="id_purchase" name="id_purchase" required>
                        <option value="">Seleccionar compra...</option>
                        @foreach($purchases as $purchase)
                            <option value="{{ $purchase->id_purchase }}" {{ old('id_purchase') == $purchase->id_purchase ? 'selected' : '' }}>Compra #{{ $purchase->id_purchase }}</option>
                        @endforeach
                    </select>
                    @error('id_purchase')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_product" class="form-label">Producto</label>
                    <select class="form-select @error('id_product') is-invalid @enderror" id="id_product" name="id_product" required>
                        <option value="">Seleccionar producto...</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id_product }}" {{ old('id_product') == $product->id_product ? 'selected' : '' }}>{{ $product->product }}</option>
                        @endforeach
                    </select>
                    @error('id_product')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Cantidad</label>
                    <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" step="0.01" required>
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('purchase_details.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Detalle de Compra</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
