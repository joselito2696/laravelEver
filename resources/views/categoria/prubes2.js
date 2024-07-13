document.querySelector("#cart-recap").addEventListener("submit", function (e) {
    console.log("pasoAqui");
    $.ajax({
        method: "GET",
        url: "/cart.js",
        dataType: "json",
        success: function (r) {
            var u = r.items.findIndex(
                (_item) => _item.variant_id === 47535479816425
            );
            var cantidad = localStorage.getItem("cantidad");
            if (cantidad > 0) {
                if (u >= 0) {
                    let updates = {
                        [47535479816425]: 0,
                    };
                    console.log("paso aqui3:", updates);
                    $.ajax({
                        method: "POST",
                        url: "/cart/update.js",
                        dataType: "json",
                        data: { updates },
                        success: function (r) {
                            console.log("ok23:", r);
                            localStorage.removeItem("checkout_init");
                            location.reload();
                        },
                        error: function (e) {
                            console.log("ok:", e.message);
                            $("body").show();
                        },
                    });

                    window.location.href = "/checkout";
                } else {
                    $.ajax({
                        method: "GET",
                        url: "/cart/add.js",
                        dataType: "json",
                        data: {
                            id: 47535479816425,
                            quantity: 1,
                        },
                        success: function (r) {
                            window.location.href = "/checkout";
                        },
                    });
                    e.preventDefault();
                }
            }

            localStorage.setItem("checkout_init", "true");
        },
    });
    e.preventDefault();
    return;
});
