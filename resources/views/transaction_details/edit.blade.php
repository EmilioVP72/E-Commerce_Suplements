@extends('administration')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Detalle de Transacción</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('transaction_details.update', $transactionDetail->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_transaction" class="form-label">Transacción</label>
                    <select class="form-select @error('id_transaction') is-invalid @enderror" id="id_transaction" name="id_transaction" required>
                        <option value="">Seleccionar transacción...</option>
                        @foreach($transactions as $transaction)
                            <option value="{{ $transaction->id_transaction }}" {{ old('id_transaction', $transactionDetail->id_transaction) == $transaction->id_transaction ? 'selected' : '' }}>Transacción #{{ $transaction->id_transaction }}</option>
                        @endforeach
                    </select>
                    @error('id_transaction')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_product" class="form-label">Producto</label>
                    <select class="form-select @error('id_product') is-invalid @enderror" id="id_product" name="id_product" required>
                        <option value="">Seleccionar producto...</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id_product }}" {{ old('id_product', $transactionDetail->id_product) == $product->id_product ? 'selected' : '' }}>{{ $product->product }}</option>
                        @endforeach
                    </select>
                    @error('id_product')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Cantidad</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $transactionDetail->quantity) }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $transactionDetail->price) }}" step="0.01" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('transaction_details.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Detalle de Transacción</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
