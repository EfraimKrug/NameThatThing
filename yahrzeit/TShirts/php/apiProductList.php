<?php

require 'apiBase.php';

$apiKey = 'aj8lew54-qdnh-aam0:cswl-uizia5v89ov4';

$pf = new PrintfulApiClient($apiKey);

try {

    $productList = $pf->get('sync/products');
    echo json_encode($productList);

} catch (PrintfulApiException $e) { //API response status code was not successful
    echo 'Printful API Exception: ' . $e->getCode() . ' ' . $e->getMessage();
} catch (PrintfulException $e) { //API call failed
    echo 'Printful Exception: ' . $e->getMessage();
    var_export($pf->getLastResponseRaw());
}

?>
