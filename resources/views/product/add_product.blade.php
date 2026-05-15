<x-layout>

@include('components.alert')

<div class="px-8 py-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">
        Add Product
    </h1>

<form id = "productForm" method="POST" action="/add-product" class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @csrf

    {{-- Product Name --}}
    <x-form-field>
        <x-form-label for="product_name">Product Name</x-form-label>
        <div class="mt-2">
            <x-form-input
                id="product_name"
                type="text"
                name="product_name"
                placeholder="Enter product name"
                class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"/>
                <span class="text-red-500 text-sm error-product_name"></span>
        </div>
    </x-form-field>

    {{-- Product Category --}}
{{-- Product Category --}}
<x-form-field>
    <x-form-label for="product_category">Product Category</x-form-label>
    <div class="mt-2">
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
    </div>
</x-form-field>

    {{-- Product Price --}}
    <x-form-field>
        <x-form-label for="product_price">Product Price</x-form-label>
        <div class="mt-2">
            <x-form-input
                id="product_price"
                type="number"
                name="product_price"
                placeholder="Enter price"
                class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"/>
                <span class="text-red-500 text-sm error-product_price"></span>
        </div>
    </x-form-field>

    {{-- Product Quantity --}}
    <x-form-field>
        <x-form-label for="product_quantity">Product Quantity</x-form-label>
        <div class="mt-2">
            <x-form-input
                id="product_quantity"
                type="number"
                name="product_quantity"
                placeholder="Enter quantity"
                class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"/>
                <span class="text-red-500 text-sm error-product_quantity"></span>
        </div>
    </x-form-field>

    {{-- Button --}}
    <div class="md:col-span-2 pt-4">
        <x-form-button class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded-md">
            Add Product
        </x-form-button>
    </div>
</form>

</div>
</x-layout>