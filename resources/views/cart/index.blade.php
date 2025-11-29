<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mi Carrito') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if($items->count() > 0)
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cart Items -->
                    <div class="col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Productos en tu carrito</h3>
                            
                            <div class="space-y-4">
                                @foreach($items as $item)
                                    <div class="flex items-center gap-4 border-b pb-4" data-cart-id="{{ $item->id_cart }}">
                                        <div class="flex-1">
                                            <h4 class="font-semibold">{{ $item->product->product }}</h4>
                                            <p class="text-sm text-gray-500">
                                                Precio: ${{ number_format($item->product->sale_price, 2) }}
                                            </p>
                                        </div>
                                        
                                        <div class="flex items-center gap-2">
                                            <input 
                                                type="number" 
                                                value="{{ $item->quantity }}"
                                                min="1"
                                                max="{{ $item->product->stock }}"
                                                class="quantity-input w-16 px-2 py-1 border rounded"
                                                data-cart-id="{{ $item->id_cart }}"
                                            >
                                        </div>
                                        
                                        <div class="w-24 text-right">
                                            <p class="font-semibold">${{ number_format($item->subtotal, 2) }}</p>
                                        </div>
                                        
                                        <button 
                                            type="button"
                                            class="remove-btn px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm"
                                            data-cart-id="{{ $item->id_cart }}"
                                        >
                                            Eliminar
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-fit">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Resumen de orden</h3>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between">
                                    <span>Subtotal:</span>
                                    <span class="font-semibold">${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Impuestos (0%):</span>
                                    <span class="font-semibold">$0.00</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold border-t pt-3">
                                    <span>Total:</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <button 
                                type="button"
                                class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md font-semibold"
                            >
                                Pagar ahora
                            </button>

                            <button 
                                type="button"
                                class="w-full mt-2 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md font-semibold clear-cart-btn"
                            >
                                Vaciar carrito
                            </button>

                            <a 
                                href="{{ route('home') }}"
                                class="block w-full mt-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold text-center"
                            >
                                Continuar comprando
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Tu carrito está vacío</p>
                        <a 
                            href="{{ route('home') }}"
                            class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold"
                        >
                            Continuar comprando
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const cartId = this.dataset.cartId;
                const quantity = this.value;

                fetch(`/cart/${cartId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity: parseInt(quantity) })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                        location.reload();
                    }
                });
            });
        });

        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const cartId = this.dataset.cartId;

                if (confirm('¿Deseas eliminar este producto?')) {
                    fetch(`/cart/${cartId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    });
                }
            });
        });

        // Clear cart
        document.querySelector('.clear-cart-btn').addEventListener('click', function() {
            if (confirm('¿Deseas vaciar tu carrito?')) {
                fetch('/cart', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        });
    </script>
</x-app-layout>