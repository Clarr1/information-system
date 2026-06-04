<x-layout>
@include('components.alert')

<div class="pos-wrap">

    {{-- ── LEFT: PRODUCT CARDS ── --}}
    <div class="pos-left">
        <div class="pos-left-header">
            <h5>Products</h5>
            <span>{{ count($products) }} items</span>
        </div>

        <div class="pos-products-grid">
            @foreach ($products as $product)
                <div class="product-card">
                   
                    <div class="card-name">{{ $product->product_name }}</div>
                    <div class="card-price">&#8369;{{ number_format($product->price, 2) }}</div>
                    <div class="card-stock {{ $product->quantity <= 5 ? 'low' : '' }}">
                        Stock: {{ $product->quantity }}
                    </div>
                    <button class="btn btn-soft btn-sm add-to-cart"
                            data-id="{{ $product->product_id }}">
                        Add
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── RIGHT: CART ── --}}
    <div class="pos-right">
        <div class="pos-right-header">
            <h5>Cart</h5>
            <span class="cart-count-badge">{{ count($cart) }}</span>
        </div>

        <div class="pos-cart-list">
            @forelse ($cart as $id => $item)
                <div class="cart-item-row">
                    <div class="cart-item-name">{{ $item['name'] }}</div>
                    <div class="cart-item-qty">x{{ $item['qty'] }}</div>
                    <div class="cart-item-sub">&#8369;{{ number_format($item['subtotal'], 2) }}</div>
                    <button class="btn btn-soft btn-error btn-sm remove-from-cart"
                            data-id="{{ $id }}">
                        Remove
                    </button>
                </div>
            @empty
                <div class="cart-empty-msg">Cart is empty</div>
            @endforelse
        </div>

        <div class="pos-cart-footer">
            <div class="pos-total-row">
                <span class="pos-total-label">Total</span>
                <span class="pos-total-amount">&#8369;{{ number_format($total ?? 0, 2) }}</span>
            </div>

            <button class="btn btn-neutral w-100 mt-2"
                    onclick="my_modal_3.showModal()">
                Check Out
            </button>
        </div>
    </div>

</div>

{{-- ── CHECKOUT MODAL ── --}}
<dialog id="my_modal_3" class="modal">
    <div class="modal-box max-w-2xl">

        <div class="modal-top">
            <h3 class="text-lg font-bold mb-4">Checkout Confirmation</h3>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">&#x2715;</button>
            </form>
        </div>

        @if(count($cart) > 0)

            <table class="table w-full modal-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $item)
                        @php $total += $item['subtotal']; @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td class="td-price">&#8369;{{ number_format($item['price'],2) }}</td>
                            <td class="td-price">&#8369;{{ number_format($item['subtotal'],2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal-total-box mt-4 text-end">
                <span class="label">Total Amount</span>
                <h4 class="font-bold amount">&#8369;{{ number_format($total,2) }}</h4>
            </div>

            <div class="mt-5 flex justify-end gap-2 modal-actions">
                <form method="dialog">
                    <button class="btn">Cancel</button>
                </form>
                <form action="{{ route('purchase.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirm Purchase</button>
                </form>
            </div>

        @else
            <p>Your cart is empty.</p>
        @endif

    </div>
</dialog>

</x-layout>