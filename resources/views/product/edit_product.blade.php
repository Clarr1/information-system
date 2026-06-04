<x-layout>

@include('components.alert')

<div class="ap-wrap px-8 py-6">
    <div class="ap-card">

        <div class="ap-card-header">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
                <p>Update the details for this product</p>
            </div>
        </div>

        <div class="ap-card-body">
            <form id="edit_product_form" method="POST" action="/products/{{ $product->product_id }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                @method('PATCH')

                <div class="ap-grid" style="grid-column: 1 / -1;">

                    {{-- Product Name --}}
                    <x-form-field>
                        <div class="ap-field">
                            <x-form-label for="product_name">
                                <span class="ap-label">Product Name</span>
                            </x-form-label>
                            <div class="mt-2">
                                <x-form-input
                                    id="product_name"
                                    type="text"
                                    name="product_name"
                                    placeholder="Enter product name"
                                    class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    value="{{ $product->product_name }}"/>
                                <span class="text-red-500 text-sm error-product_name"></span>
                                <x-form-error name="product_name" />
                            </div>
                        </div>
                    </x-form-field>

                    {{-- Product Category --}}
                    <x-form-field>
                        <div class="ap-field">
                            <x-form-label for="product_category">
                                <span class="ap-label">Product Category</span>
                            </x-form-label>
                            <div class="mt-2 select-wrap">
                                <select
                                    id="product_category"
                                    name="product_category"
                                    class="w-full border-gray-300 rounded-md h-9 focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select category</option>
                                    <option value="Category 1" {{ $product->category === 'Category 1' ? 'selected' : '' }}>Category 1</option>
                                    <option value="Category 2" {{ $product->category === 'Category 2' ? 'selected' : '' }}>Category 2</option>
                                    <option value="Category 3" {{ $product->category === 'Category 3' ? 'selected' : '' }}>Category 3</option>
                                    <option value="Category 4" {{ $product->category === 'Category 4' ? 'selected' : '' }}>Category 4</option>
                                    <option value="Category 5" {{ $product->category === 'Category 5' ? 'selected' : '' }}>Category 5</option>
                                </select>
                                <span class="text-red-500 text-sm error-product_category"></span>
                                <x-form-error name="product_category" />
                            </div>
                        </div>
                    </x-form-field>

                    {{-- Product Price --}}
                    <x-form-field>
                        <div class="ap-field">
                            <x-form-label for="product_price">
                                <span class="ap-label">Product Price</span>
                            </x-form-label>
                            <div class="mt-2">
                                <x-form-input
                                    id="product_price"
                                    type="number"
                                    name="product_price"
                                    placeholder="Enter price"
                                    class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    value="{{ $product->price }}"/>
                                <span class="text-red-500 text-sm error-product_price"></span>
                                <x-form-error name="product_price" />
                            </div>
                        </div>
                    </x-form-field>

                    {{-- Product Quantity --}}
                    <x-form-field>
                        <div class="ap-field">
                            <x-form-label for="product_quantity">
                                <span class="ap-label">Product Quantity</span>
                            </x-form-label>
                            <div class="mt-2">
                                <x-form-input
                                    id="product_quantity"
                                    type="number"
                                    name="product_quantity"
                                    placeholder="Enter quantity"
                                    class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                    value="{{ $product->quantity }}"/>
                                <span class="text-red-500 text-sm error-product_quantity"></span>
                                <x-form-error name="product_quantity" />
                            </div>
                        </div>
                    </x-form-field>

                </div>

                {{-- Button --}}
                <hr class="ap-divider" style="grid-column: 1 / -1;">
                <div class="md:col-span-2 pt-4" style="grid-column: 1 / -1;">
                    <x-form-button class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded-md">
                        Update changes
                    </x-form-button>
                </div>

            </form>
        </div>

    </div>
</div>

</x-layout>