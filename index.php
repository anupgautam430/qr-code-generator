<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>QR Code Generator</h1>
        <form id="qrForm" action="" method="POST" enctype="multipart/form-data">
            <label for="qrText">Enter Text or URL:</label>
            <input type="text" id="qrText" name="qrText" required value="<?= isset($_POST['qrText']) ? htmlspecialchars($_POST['qrText']) : '' ?>">

            <button type="submit">Generate QR Code</button>
        </form>

        <?php
        use chillerlan\QRCode\QRCode;
        use chillerlan\QRCode\QROptions;

        require_once('vendor/autoload.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['qrText'])) {
            $qrText = $_POST['qrText'];

            $options = new QROptions([
                'eccLevel' => QRCode::ECC_L,
                'outputType' => QRCode::OUTPUT_MARKUP_SVG,
                'version' => 5,
            ]);

            $qrcode = (new QRCode($options))->render($qrText);
            echo "<h2>QR Code Preview</h2>";
            echo "<div class='qr-preview'><img src='$qrcode' alt='QR Code'></div>";
        }
        ?>
    </div>
</body>
</html>
