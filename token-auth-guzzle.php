use \GuzzleHttp\Client as Client;

       $bearerToken = 'your-bearer-token';
       $headers    =   [
            'headers' => [
            'Content-Type' => 'application/json',
              'Authorization' => 'Bearer ' .$bearerToken,
            ],
            'http_errors' => false,
        ];
        return $headers;
        
    $baseApiUrl = EndPoints::$BASE_URL;
    
    $url = $baseApiUrl . $endPoint;
    
    $client = new Client(self::getHttpHeaders());
    
    $response = $client->get($url, ['verify' => false]);

    $resp['statusCode'] = $response->getStatusCode();
    
    $resp['bodyContents'] = $response->getBody()->getContents();
    return $resp;
