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
                <div class="cart-item-row" id="row-{{ $id }}">
                    <div class="cart-item-name">{{ $item['name'] }}</div>
                    <div class="cart-item-qty flex items-center gap-2">

                        <button class="btn btn-xs btn-outline"
                                onclick="updateQty({{ $id }}, 'decrease')">
                            −
                        </button>

                        <span id="qty-{{ $id }}">{{ $item['qty'] }}</span>

                        <button class="btn btn-xs btn-outline"
                                onclick="updateQty({{ $id }}, 'increase')">
                            +
                        </button>

                    </div>
                    <div class="cart-item-sub" id="subtotal-{{ $id }}">
                            &#8369;{{ number_format($item['subtotal'], 2) }}
                        </div>
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

        <h3 class="text-lg font-bold mb-4">Checkout Confirmation</h3>

        @if(count($cart) > 0)

            <table class="table w-full">
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
                            <td>₱{{ number_format($item['price'],2) }}</td>
                            <td>₱{{ number_format($item['subtotal'],2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mt-4">
                <span class="font-semibold">Total Amount:</span>
                <h4 class="text-lg font-bold">₱{{ number_format($total,2) }}</h4>
            </div>

            {{-- FORM --}}
            <form action="{{ route('purchase.checkout') }}" method="POST" id="checkoutForm" class="mt-5 space-y-3">
                @csrf

                <div>
                    <label class="font-semibold">Cash Given by Customer</label>
                    <input type="number"
                           name="cash"
                           id="cashInput"
                           class="input input-bordered w-full mt-1"
                           min="0"
                           step="0.01"
                           required>
                </div>

                <div>
                    <label class="font-semibold">Total Amount</label>
                    <input type="text"
                           id="totalAmount"
                           class="input input-bordered w-full"
                           value="₱{{ number_format($total, 2) }}"
                           readonly>
                </div>

                <div>
                    <label class="font-semibold">Change</label>
                    <input type="text"
                           id="changeOutput"
                           class="input input-bordered w-full"
                           value="₱0.00"
                           readonly>
                </div>

                <button type="submit" class="btn btn-neutral w-full mt-2">
                    Confirm Purchase
                </button>
                <button type="button"
        class="btn btn-soft w-full mt-2"
        onclick="document.getElementById('my_modal_3').close()">
    Cancel
</button>
            </form>

        @else
            <p class="text-center py-6">Your cart is empty.</p>
        @endif

    </div>
</dialog>
</x-layout>