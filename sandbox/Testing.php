<title> Sample Testing </title>

<?php 
require 'bitvc/BitVC.php';
require 'okcoin/OKCoin.php';
require 'x796/X796.php';

// Define Exchanges and Keys.
const OKC_API_KEY = "a3df6a8b-2799-4988-9336-e4ce74b88408";
const OKC_SECRET_KEY = "C890A97000A0A5102CF6462F4F7BDCC1";

const X796_API_KEY = "9ff4f593-0fd9-aaf9-b09a-8e2b-6b2f449c";
const X796_SECRET_KEY = "QVx4ZB572LlRqtl9eQzGxm5DEhvZFM0G5JIOrUi3QPQNlinzGoVHfhIg77U9";
const X796_APP_ID = "11378";

const BITVC_API_KEY = "0b5b1c1e-1dfe73d7-c622be59-fac3a9cc";
const BITVC_SECRET_KEY = "bff88cbb-989f6e67-8e3049f6-7ed1de64";

$okc_client = new OKCoin(new OKCoin_ApiKeyAuthentication(OKC_API_KEY, OKC_SECRET_KEY));
$bitvc_client = new BitVC(new BitVC_ApiKeyAuthentication(BITVC_API_KEY, BITVC_SECRET_KEY));
// $x796_client = new X796(new X796_ApiKeyAuthentication(X796_API_KEY, X796_SECRET_KEY, X796_APP_ID));

echo "<h2>Future Tickers</h2>";
$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
$ticker = $okc_client->tickerFutureApi($params);
echo "OKCOIN::(This Week) <pre>" . print_r($ticker, TRUE) . "</pre>";

$params = array();
$ticker = $bitvc_client->getFutureTicker($params);
echo "BitVC::(This Week) <pre>" . print_r($ticker, TRUE) . "</pre>";

// $params = array();
// $ticker = $x796_client->getFutureTicker($params);
// echo "796::(This Week) <pre>" . print_r($ticker, TRUE) . "</pre>";

