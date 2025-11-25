<!-- filepath: resources/views/products/show.blade.php -->
<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
        <!-- Breadcrumb -->
            <div class="mb-6 flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-blue-600 transition">Inicio</a>
                <svg class="mx-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <a href="#" class="hover:text-blue-600 transition">{{ $product->brand->brand ?? 'Marca' }}</a>
                <svg class="mx-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-900">{{ $product->product }}</span>
            </div>

            <!-- Main Product Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 bg-white rounded-lg shadow-sm p-8 mb-8">
                
                <!-- Product Image -->
                <div class="flex flex-col items-center">
                    <div class="w-full max-w-md bg-gray-100 rounded-lg overflow-hidden mb-6 aspect-square flex items-center justify-center">
                        @if($product->photo && $product->photo !== 'default.png')
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->product }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-center text-gray-400">
                                <svg class="mx-auto h-24 w-24 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" opacity="0.2"/>
                                </svg>
                                <p>Imagen no disponible</p>
                            </div>
                        @endif
                    </div>

                    {{-- ADVERTENCIA DEBAJO DE LA IMAGEN --}}
                    @if($product->warning)
                        <div class="mb-6 w-full max-w-md p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                            <h3 class="text-sm font-semibold text-yellow-800 mb-2">⚠️ Advertencia Importante</h3>
                            <p class="text-sm text-yellow-700">{{ $product->warning }}</p>
                        </div>
                    @endif
                </div>
                
                <!-- Product Details -->
                <div class="flex flex-col justify-between">
                    <div class="mb-2">
                        <div class="flex items-center gap-2 mb-2">
                            @if($product->brand)
                                <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-600 bg-blue-50 rounded-full">
                                    {{ $product->brand->brand }}
                                </span>
                            @endif
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-0">{{ $product->product }}</h1> 
                    </div>

                    <div class="mb-4 border-b-2 pb-6">
                        <div class="flex items-baseline gap-4 mb-2">
                            <span class="text-4xl font-bold text-green-600">${{ number_format($product->sale_price, 2, ',', '.') }}</span>
                        </div>
                        <p class="text-sm text-blue-600 font-semibold">✓ Envío GRATIS a nivel nacional</p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Descripción del Producto</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $product->description ?? 'Sin descripción disponible' }}</p>
                    </div>

                    <!-- How to Use -->
                    @if($product->how_to_use)
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">💡 Cómo Usar</h3>
                            <p class="text-sm text-gray-700">{{ $product->how_to_use }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <svg class="h-12 w-12 mx-auto text-blue-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h3 class="font-semibold text-gray-900 mb-1">Entrega Rápida</h3>
                    <p class="text-sm text-gray-600">Entrega en 2-3 días hábiles</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <svg class="h-12 w-12 mx-auto text-green-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="font-semibold text-gray-900 mb-1">Garantía Original</h3>
                    <p class="text-sm text-gray-600">Producto 100% original</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <svg class="h-12 w-12 mx-auto text-purple-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="font-semibold text-gray-900 mb-1">Devoluciones Fáciles</h3>
                    <p class="text-sm text-gray-600">30 días para cambios</p>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Productos Relacionados</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('product.show', $related->id_product) }}" class="group cursor-pointer">
                                <div class="bg-gray-100 rounded-lg overflow-hidden mb-3 aspect-square flex items-center justify-center group-hover:shadow-lg transition">
                                    @if($related->photo && $related->photo !== 'default.png')
                                        <img src="{{ asset('images/products/' . $related->photo) }}" alt="{{ $related->product }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    @else
                                        <svg class="h-16 w-16 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" opacity="0.2"/>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition line-clamp-2">{{ $related->product }}</h3>
                                <p class="text-red-600 font-bold mt-2">${{ number_format($related->sale_price, 2, ',', '.') }}</p>
                                <div class="flex items-center gap-1 mt-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>