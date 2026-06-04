<x-layout>

@include('components.alert')


<div class="ap-wrap px-8 py-6">
    <div class="ap-card">

        <div class="ap-card-header">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Add Product</h1>
                <p>Fill in the details to add a new product</p>
            </div>
        </div>

        <div class="ap-card-body">
            <form id="productForm" method="POST" action="/add-product" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf

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
                                    class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"/>
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
                                    <option value="Category 1">Category 1</option>
                                    <option value="Category 2">Category 2</option>
                                    <option value="Category 3">Category 3</option>
                                    <option value="Category 4">Category 4</option>
                                    <option value="Category 5">Category 5</option>
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
                                    class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"/>
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
                                    class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"/>
                                <span class="text-red-500 text-sm error-product_quantity"></span>
                                <x-form-error name="product_quantity" />
                            </div>
                        </div>
                    </x-form-field>

                        {{-- Low Stock Threshold --}}
                        <div class="ap-field">
                            <x-form-label for="low_stock_threshold">
                                <span class="ap-label">Low Stock Threshold</span>
                            </x-form-label>
                            <div class="mt-2">
                                <x-form-input
                                    id="low_stock_threshold"
                                    type="number"
                                    name="low_stock_threshold"
                                    placeholder="Enter low stock threshold (default: 10)"
                                    class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"/>
                                <span class="text-red-500 text-sm error-low_stock_threshold"></span>
                                <x-form-error name="low_stock_threshold" />
                            </div>

                </div>

                {{-- Button --}}
                <hr class="ap-divider" style="grid-column: 1 / -1;">
                <div class="md:col-span-2 pt-4" style="grid-column: 1 / -1;">
                    <x-form-button class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded-md">
                        Add Product
                    </x-form-button>
                </div>

            </form>
        </div>

    </div>
</div>

</x-layout>