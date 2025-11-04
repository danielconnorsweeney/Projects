<?php
/**
 * Cat Api class using cURL
 */
class CatApi{
    private $api_key;
    private $base_url;
    public function __construct($api_key, $base_url){
        $this->api_key = $api_key;
        $this->base_url = $base_url;
    }

    // Make requests to Cat Api using cURL, error handling, throwing exceptions
    private function request($endpoint){
        // Cat API docs said best practice is store api key in the header
        $url = $this->base_url . $endpoint;
        $ch = curl_init($url); //
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['x-api-key: ' . $this->api_key]);
        $response = curl_exec($ch);

        // error handling
        if(curl_errno($ch)){
            http_response_code(404);
            throw new Exception("cURL Error: " . curl_error($ch));
        }

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        if($statusCode == 404){
            throw new Exception("Cat not found");
        }

        // stores content retrieved from Cat API into array
        $data = json_decode($response, true);
        return $data;
    }

    /**
     * fetch 10 random cat pics
     */
    public function getRandomCats()
    {
        try {
            $endpoint = "/images/search?limit=10&has_breeds=1"; // CAT API 10 random cat pics url
            $data = $this->request($endpoint);
            return $data ?? [];
        }catch(Exception $e){
            echo "<p>API Error: " . $e->getMessage() . "</p>";
            return[];
        }
    }

}