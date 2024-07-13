document.querySelector("#cart-form").addEventListener("submit", function (e) {
    console.log(itemCoord);
    console.log(itemCoord, itemProduct);
    if (!itemCoord && flag) {
        document
            .querySelector("#error-for-map")
            .setAttribute("style", "display: block;");
        var elmnt = document.getElementById("map-pos");
        elmnt.scrollIntoView();
        e.preventDefault();
        iziToast.info({
            message: "Especifica tu ubicación en el mapa",
            position: "center",
            close: true,
            timeout: 3000,
            theme: "dark",
            backgroundColor: "#000",
            color: "#fff",
            messageColor: "#fff",
        });
        return;
    }

    if (itemProduct === null) {
        e.preventDefault();
        iziToast.info({
            message:
                "Llegamos a otras zonas, no enviamos a ese destino. Escoge una nueva ubicación.",
            position: "center",
            close: true,
            timeout: 3000,
            theme: "dark",
            backgroundColor: "#000",
            color: "#fff",
            messageColor: "#fff",
        });
        return;
    } else {
        $.ajax({
            method: "GET",
            url: "/cart.js",
            dataType: "json",
            success: function (r) {
                var variants = [
                    32697977045089, 32697977536609, 32697977667681,
                    32697977798753, 32697977929825, 32697977962593,
                    32697978126433, 32697929859169, 32697932513377,
                    32697975111777, 32697975504993, 32697975603297,
                    32697976062049, 32697976094817, 32697976422497,
                    32697976717409, 32697927991393, 32697877823585,
                    32697920585825, 32697887555681, 32697883230305,
                    32697872154721,
                ];
                var indices = [];
                variants.forEach(function (valor, indice, array) {
                    var u = r.items.findIndex(
                        (_item) => _item.variant_id === valor
                    );
                    if (u >= 0) {
                        indices.push(valor);
                    }
                });

                if (indices.length <= 0) {
                    $.ajax({
                        method: "GET",
                        url: "/cart/add.js",
                        dataType: "json",
                        data: {
                            id: itemProduct,
                            quantity: 1,
                            properties: {
                                "_Coordinates for delivery (lat, long)":
                                    itemCoord,
                            },
                        },
                        success: function (r) {
                            $.ajax({
                                url: "/cart/update.js",
                                dataType: "json",
                                type: "POST",
                                data: {
                                    note: $("#cartSpecialInstructions").val(),
                                },
                                success: function () {
                                    window.location.href = "/checkout";
                                },
                                error: function (jqxhr, status, exception) {
                                    console.log(exception);
                                },
                            });
                        },
                        error: function (e) {},
                    });
                } else {
                    var data = { updates: {} };
                    for (var i = 0; i < indices.length; i++) {
                        data.updates[indices[i]] = 0;
                    }
                    $.ajax({
                        method: "GET",
                        url: "/cart/update.js",
                        dataType: "json",
                        data: data,
                        success: function (r) {
                            $.ajax({
                                method: "GET",
                                url: "/cart/add.js",
                                dataType: "json",
                                data: {
                                    id: itemProduct,
                                    quantity: 1,
                                    properties: {
                                        "_Coordinates for delivery (lat, long)":
                                            itemCoord,
                                    },
                                },
                                success: function (r) {
                                    $.ajax({
                                        url: "/cart/update.js",
                                        dataType: "json",
                                        type: "POST",
                                        data: {
                                            note: $(
                                                "#cartSpecialInstructions"
                                            ).val(),
                                        },
                                        success: function () {
                                            window.location.href = "/checkout";
                                        },
                                        error: function (
                                            jqxhr,
                                            status,
                                            exception
                                        ) {
                                            console.log(exception);
                                        },
                                    });
                                },
                                error: function (e) {},
                            });
                        },
                        error: function (e) {},
                    });
                }

                localStorage.setItem("checkout_init", "true");
            },
            error: function (e) {},
        });
        e.preventDefault();
        return;
    }

    flag = true;
});
