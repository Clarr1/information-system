<x-layout>

<div class="min-w-full px-8 py-6">
<div class="overflow-x-auto">

<table class="min-w-full divide-y divide-gray-200">
      <!-- Top Bar -->
  <div class="flex justify-end mb-4">
    <button class="btn btn-ghost btn-circle">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /> </svg>
    </button>
  </div>
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
            <tr id = "row-{{ $product->product_id }}" class="hover:bg-gray-50">
                <td class="px-6 py-4">{{ $product->product_id }}</td>
                <td class="px-6 py-4">{{ $product->product_name }}</td>
                <td class="px-6 py-4">{{ $product->category }}</td>
                <td class="px-6 py-4">{{ $product->price }}</td>
                <td class="px-6 py-4">{{ $product->quantity }}</td>

                <td>
                    <a href="/products/{{ $product->product_id }}/edit" class="text-blue-500 hover:text-blue-700">
                        Edit
                    </a>
                </td>

                <td>
                     {{-- <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="confirmDelete({{ $product->product_id }})">
                            Delete
                        </button>
                    <form  id="delete-form-{{ $product->product_id }}" action="/products/{{ $product->product_id }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form> --}}
                    <td>
                        <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="deleteProduct({{ $product->product_id }})">Delete</button>
                    </td>
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