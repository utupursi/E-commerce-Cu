<html>
<head>
    <title>TBCPAY</title>
    <script type="text/javascript" language="javascript">
        function redirect() {
            document.returnform.submit();
        }
    </script>
</head>
<body onLoad="javascript:redirect()">
<form name="returnform" action="https://ecommerce.ufc.ge/ecomm2/ClientHandler" method="POST">
    <input type="hidden" name="trans_id" value="{{ $transactionId }}">
    <noscript>
        <center>Please click the submit button below.<br>
            <input type="submit" name="submit" value="Submit">
        </center>
    </noscript>
</form>
</body>
</html>
