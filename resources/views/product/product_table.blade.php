<x-layout>

@include('components.alert')


<div class="min-w-full px-8 py-6 tbl-wrap">
    <div class="overflow-x-auto">

        <!-- Top Bar -->
        <div class="tbl-header">
            <div>
                <h2>Products</h2>
                <p>Manage your product inventory</p>
            </div>
            <button class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Product Id</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Product Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Quantity</th>
                    <th class="px-6 py-3"></th>
                    <th class="px-6 py-3"></th>
                    
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            @foreach ($products as $product)
                <tr class = "{{ $product->quantity <= $product->low_stock_threshold ? 'low-stock-row' : '' }}" id="row-{{ $product->product_id }}" class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $product->product_id }}</td>
                    <td class="px-6 py-4">{{ $product->product_name }}</td>
                    <td class="px-6 py-4">{{ $product->category }}</td>
                    <td class="px-6 py-4">{{ $product->price }}</td>

                    <td>
                            @if($product->quantity == 0)
                                <span class="status-out">Out of Stock</span>
                            @elseif($product->quantity <= $product->low_stock_threshold)
                                <span class="status-low">Low Stock</span>
                            @else
                                <span class="status-ok">In Stock</span>
                            @endif
                    </td>
                    

                    <td>
                        <a href="/products/{{ $product->product_id }}/edit" class="text-blue-500 hover:text-blue-700">
                            Edit
                        </a>
                    </td>

                    <td>
                        <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="confirmDelete({{ $product->product_id }})">
                            Delete
                        </button>
                        <form id="delete-form-{{ $product->product_id }}"
                            action="/delete-product/{{ $product->product_id }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>

    </div>
</div>

</x-layout>