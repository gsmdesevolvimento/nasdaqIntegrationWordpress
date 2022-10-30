<?php

if (!defined('ABSPATH')) {
    exit('Access denied');
}

$nasdaqSymbolSelected = get_option('nasdaq_company_selected');

if (empty($nasdaqSymbolSelected)) {
    $nasdaqSymbolSelected = 'GOOG';
}

$nasdaqData = Nasdaq::getDataByCurl('https://api.nasdaq.com/api/quote/' . $nasdaqSymbolSelected . '/chart?assetclass=stocks');

if (is_array($nasdaqData) && array_key_exists('data', $nasdaqData)) :

    $nasdaqData = $nasdaqData['data'];

?>

<div class="nasdaq-application">

    <div class="nasdaq-container">

        <div class="nasdaq-content">

            <div class="nasdaq-left">

                <div class="nasdaq-titles">

                    <h1 class="nasdaq-title">

                        <span class="nasdaq-company">

                            <?php echo $nasdaqData['company']; ?>

                            <span class="nasdaq-company-symbol">(<?php echo $nasdaqData['symbol']; ?>)</span>

                        </span>

                    </h1>

                </div>

                <div class="nasdaq-pricings">

                    <div class="nasdaq-pricing nasdaq-fix--margin loaded">
                        
                        <div class="nasdaq-pricing-details nasdaq-pricing-details--current nasdaq-pricing-details--increase">

                            <div class="nasdaq-pricing-last-price">

                                <span class="nasdaq-pricing-price"><?php echo $nasdaqData['lastSalePrice']; ?></span>

                                <div class="nasdaq-pricing-changes">
                                    <span class="nasdaq-pricing-change"><?php echo $nasdaqData['netChange']; ?></span>
                                    <span class="nasdaq-pricing-percent">(+<?php echo $nasdaqData['percentageChange']; ?>)</span>
                                </div>

                                <div class="nasdaq-pricing-volume">
                                    <span class="nasdaq-pricing-icon">Previous:</span>
                                    <span class="nasdaq-volume"><?php echo $nasdaqData['previousClose']; ?></span>
                                </div>

                                <div class="nasdaq-timestamp">
                                    <span class="nasdaq-status"><?php echo $nasdaqData['timeAsOf']; ?></span>
                                </div>

                                <span class="nasdaq-bar"></span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php endif; ?>