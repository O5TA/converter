<?php

class CurrencyConverter
{
    public $url;

    function setSettings($url)
    {
        $this->url = $url;
    }

    function getRate($currency)
    {
        $ch = curl_init();
        $timeout = 5; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        $j = json_decode($file_contents, true);
        return $j['rates'][$currency];

    }

    function convert($amount, $currency)
    {

        return $amount * $this->getRate($currency);

    }

}

$converter = new CurrencyConverter;
$converter->setSettings("https://openexchangerates.org/api/latest.json?app_id=d253d9d228ad40c290366441656d172e");
echo $converter->convert($_POST['amount'], "CNY");

?>
