<form onload="" action="https://ganvadeba.credo.ge/widget/" id="credo-form" method="post">
    <input type="hidden" name="credoinstallment"
           value='{"merchantId":"12010", "orderCode":"{{$orderId}}",
"check":"{{$check}}",
"products":{{$data}}
               }'/>
</form>

<script>
    window.onload = function () {
        document.querySelector('#credo-form').submit();
    }
</script>




