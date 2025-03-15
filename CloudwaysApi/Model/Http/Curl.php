<?php

namespace Learning\CloudwaysApi\Model\Http;

use Magento\Framework\Exception\LocalizedException;

class Curl
{

    public function execute(
        string $url,
        string $method = 'GET',
        array $headers = [],
        array $data = []
    ): array
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, true);

        if(!empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        if($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new LocalizedException(__('Invalid Json Response From Cloudways'));
        }

        if ($httpCode >= 400) {
            throw new LocalizedException(__('Cloudways Api Request Failed with Http Code %1', $httpCode));
        }

        return $decodedResponse;
    }

}
