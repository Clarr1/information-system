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
