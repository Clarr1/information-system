// adding cart

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".add-to-cart").forEach(btn => {
        btn.addEventListener("click", function () {
            let id = this.dataset.id;

    fetch("/cart/add", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({ product_id: id })
})
.then(async res => {
    let data = await res.json();

    if (!res.ok) {
        console.error("Server error:", data);
        return;
    }

    console.log("Success:", data);
    location.reload();
});
        });
    });
});

// removing cart
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".remove-from-cart").forEach(btn => {
        btn.addEventListener("click", function () {
            let id = this.dataset.id;   
            fetch("/cart/remove", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: id })
            })
            .then(async res => {
                let data = await res.json();

                if (!res.ok) {
                    console.error("Server error:", data);
                    return;
                }

                console.log("Success:", data);
                location.reload();
            });
        });
    });
});

// purchasing cart
window.updateQty = function(id, action) {

    fetch(`/cart/${action}/${id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        }
    })
    .then(async res => {

        const data = await res.json();

        if (!res.ok) {
            console.error("Server error:", data);
            return;
        }

        if (data.status === 'success') {

            document.getElementById(`qty-${id}`).innerText = data.qty;
            document.getElementById(`subtotal-${id}`).innerText = data.subtotal;
            document.querySelector('.pos-total-amount').innerText = data.total;
            document.querySelector('.cart-count-badge').innerText = data.cart_count;

            if (data.qty === 0) {
                document.getElementById(`row-${id}`).remove();
            }
        }
    });
}

// checkout
document.addEventListener("DOMContentLoaded", function () {

    const cashInput = document.getElementById("cashInput");
    const changeOutput = document.getElementById("changeOutput");
    const totalElement = document.querySelector('.pos-total-amount');

    if (!cashInput || !changeOutput || !totalElement) {
        return;
    }

    const total = parseFloat(
        totalElement.innerText.replace(/[^\d.]/g, '')
    ) || 0;

    cashInput.addEventListener("input", function () {

        let cash = parseFloat(this.value) || 0;
        let change = cash - total;

        if (change < 0) {
            changeOutput.value = "₱0.00 (Insufficient Cash)";
        } else {
            changeOutput.value = "₱" + change.toFixed(2);
        }
    });

});
