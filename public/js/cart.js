$(document).ready(function () {
    // when + button click
    $('.btn-plus').click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("MMK", ""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html(`${$total} MMK`);

        summaryCalculation();

    })

    // when - button click
    $('.btn-minus').click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("MMK", ""));
        $qty = Number($parentNode.find('#qty').val());

        $total = $price * $qty;
        $parentNode.find('#total').html(`${$total} MMK`);

        summaryCalculation();
    })

    // calculate final price for order
    function summaryCalculation() {
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function (index, row) {
            $totalPrice += Number($(row).find('#total').text().replace("MMK", ""));
        });

        $("#subTotalPrice").html(`${$totalPrice} MMK`);
        $("#finalPrice").html(`${$totalPrice + 3000} MMK`);
    }
})
