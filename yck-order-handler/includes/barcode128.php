<?php
function generateBarcode128($code) {
    $barcode = '<img src="https://barcode.tec-it.com/barcode.ashx?data=' . urlencode($code) . '&code=Code128&translate-esc=false" alt="Barcode">';
    return $barcode;
}