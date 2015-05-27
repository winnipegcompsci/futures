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
$x796_client = new X796(new X796_ApiKeyAuthentication(X796_API_KEY, X796_SECRET_KEY, X796_APP_ID));

///////////////////////////////////////////////////////////////////////////////
$params = array('api_key' => OKC_API_KEY);
$okc_userinfo = $okc_client->fixUserinfoFutureApi($params);

$now = time();

$params = array(
    'accessKey' => BITVC_API_KEY,
    'created' => $now,
    'coinType' => 1,   
);
$bitvc_userinfo = $bitvc_client->getFutureBalance($params);

$params = array(
    'apikey' => X796_API_KEY
);
$x796_userinfo = $x796_client->getUserBalance($params);


///////////////////////////////////////////////////////////////////////////////
$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
$okc_ticker = $okc_client->tickerFutureApi($params);

$params = array();
$bitvc_ticker = $bitvc_client->getFutureTicker($params);

$params = array('type' => 'weekly');
$x796_ticker = $x796_client->getFutureTicker($params);
///////////////////////////////////////////////////////////////////////////////
$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week', 'size' => '100' );
$okc_depth = $okc_client->depthFutureApi($params);

$params = array();
$bitvc_depth = $bitvc_client->getFutureDepth($params);

$params = array('type' => 'weekly');
$x796_depth = $x796_client->getFutureDepth($params);
///////////////////////////////////////////////////////////////////////////////
$params = array('symbol' => 'btc_usd', 'contract_type' => 'this_week');
$okc_trades = $okc_client->tradesFutureApi($params);

$params = array();
$bitvc_trades = $bitvc_client->getFutureTrades($params);

$params = array('type' => 'weekly');
$x796_trades = $x796_client->getFutureTrades($params);
///////////////////////////////////////////////////////////////////////////////

?>

<table border="1px solid black">
<tr>
    <th>Item</th>
    <th>OKCoin</th>
    <th>BitVC </th>
    <th>796 </th>
</tr>

<tr>
    <td>User Info</td>
    <td><pre><?= print_r($okc_userinfo, TRUE) ?></pre></td>
    <td><pre><?= print_r($bitvc_userinfo, TRUE) ?></pre></td>
    <td><pre><?= print_r($x796_userinfo, TRUE) ?></pre></td>
</tr>


<tr>
    <td>Tickers</td>
    <td><pre><?= print_r($okc_ticker, TRUE) ?></pre></td>
    <td><pre><?= print_r($bitvc_ticker, TRUE) ?></pre></td>
    <td><pre><?= print_r($x796_ticker, TRUE) ?></pre></td>
</tr>

<tr>
    <td>Market Depth</th>
    <td><pre><?= print_r($okc_depth, TRUE) ?></pre></td>
    <td><pre><?= print_r($bitvc_depth, TRUE) ?></pre></td>
    <td><pre><?= print_r($x796_depth, TRUE) ?></pre></td>
</tr>

<tr>
    <td>Market Trades</th>
    <td><pre><?= print_r($okc_trades, TRUE) ?></pre></td>
    <td><pre><?= print_r($bitvc_trades, TRUE) ?></pre></td>
    <td><pre><?= print_r($x796_trades, TRUE) ?></pre></td>
</tr>

</table>