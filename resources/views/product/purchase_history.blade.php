<x-layout>


<div class="container mt-4 tbl-wrap">

    <div class="d-flex justify-content-between align-items-center mb-3 tbl-header">
        <div>
            <h4 class="mb-0">Purchase History</h4>
            <p>All completed transactions</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th class="text-center">Qty</th>
                            <th>Total Price</th>
                            <th>Cash Received</th>
                            <th>Change</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($purchases as $key => $purchase)
                            <tr>
                                <td class="td-num">{{ $key + 1 }}</td>

                                <td>
                                    <strong>{{ $purchase->product_name }}</strong>
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-secondary">
                                        {{ $purchase->quantity }}
                                    </span>
                                </td>

                                <td class="td-price">
                                    &#8369;{{ number_format($purchase->total_price, 2) }}
                                </td>

                                <td class="td-price">
                                    &#8369;{{ number_format($purchase->cash_received, 2) }}
                                </td>

                                <td>
                                    <span class="text-success">
                                        &#8369;{{ number_format($purchase->change_amount, 2) }}
                                    </span>
                                </td>

                                <td class="text-muted">
                                    {{ $purchase->created_at->format('M d, Y h:i A') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4 td-empty">
                                    No purchase history found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

</x-layout>