<x-layout>

<div class="px-8 py-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">
        Edit Product
    </h1>

<form id = "edit_product_form" method="POST" action="/products/{{ $product->product_id }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @csrf
    @method('PATCH')

    {{-- Product Name --}}
    <x-form-field>
        <x-form-label for="product_name">Product Name</x-form-label>
        <div class="mt-2">
            <x-form-input
                id="product_name"
                type="text"
                name="product_name"
                placeholder="Enter product name"
                class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ $product->product_name }}"/>
                <span class="text-red-500 text-sm error-product_name"></span>
        </div>
    </x-form-field>

{{-- Product Category --}}
<x-form-field>
    <x-form-label for="product_category">Product Category</x-form-label>
    <div class="mt-2">
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
                class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" value="{{ $product->price }}"/>
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
                class="w-full border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"  value="{{ $product->quantity }}"/>
               <span class="text-red-500 text-sm error-product_quantity"></span>
        </div>
    </x-form-field>

    <div class="md:col-span-2 pt-4">
        <x-form-button class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded-md">
            Update changes
        </x-form-button>
    </div>
</form>

</x-layout>