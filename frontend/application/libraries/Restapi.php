<?php
class RestApiMethod{
    const POST   = 'POST';
    const GET    = 'GET';
    const PUT    = 'PUT';
    const PATCH  = 'PATCH';
    const DELETE = 'DELETE';
}

class RestApiErrorCode{
    const UNAUTHORIZED = 'Unauthorized';
    const UNPROCESSABLE_ENTITY = 'Unprocessable Entity';
    const PAGE_NOT_FOUND = 'Page not found';
    const INTERNAL_SERVER_ERROR  = 'Internal server error';
    const METHOD_NOT_ALLOWED = 'Method not allowed';
    const DEFAULT_ERROR = 'An unexpected error occurred';
}

class RestApi{
    // Is initialized
    private static $isReady = false;
    
    // Token name
    private static $token_name;
    
    // Codeigniter reference
    private static $ci;

    // Rest Api URL
    private static $base_url;
    
    // Unprocessable Entity validation fields data
    private static $entity_validation_fields;
    
    public static function initialize($base_url, $token_name) {
        if(!self::$isReady) {
            self::$ci =& get_instance();
            self::$base_url   = $base_url;
            self::$token_name = $token_name;
            self::$isReady    = true;
        }
    }
    
    public static function call($method, $url, $parameters = []) {
        // clear entity_validation_fields
        self::$entity_validation_fields = [];
        
        $curl = curl_init();

        // Method type
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        
        // Parameters to the request
        if($method === RestApiMethod::POST){
            curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
        } else { // put
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
        }
        
        // Url
        curl_setopt($curl, CURLOPT_URL, self::$base_url . $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        // Token
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            self::$token_name . ':' . self::getToken()
        ]);

        $result = curl_exec($curl);
        
        // Verify current status code
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        // User Agent
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        
        curl_close($curl);
        
        // Fetch data
        $_result = json_decode( $result );
        
        switch($code){
            case 200: // Its OK
                break;
            case 401:
                self::destroyToken();
                throw new Exception(RestApiErrorCode::UNAUTHORIZED);
                break;
            case 404:
                throw new Exception(RestApiErrorCode::PAGE_NOT_FOUND);
                break;
            case 405:
                throw new Exception(RestApiErrorCode::METHOD_NOT_ALLOWED);
                break;
            case 422: // Show invalid entity fields
                self::$entity_validation_fields = $_result;
                throw new Exception(RestApiErrorCode::UNPROCESSABLE_ENTITY);
                break;
            case 500:
                throw new Exception(RestApiErrorCode::INTERNAL_SERVER_ERROR);
                break;
            default:
                throw new Exception(RestApiErrorCode::DEFAULT_ERROR);
                break;
        }
        
        // return data
        if(empty($_result)) return $result;
        else return $_result;
            
    }
    
    private static function getToken() {
        return self::$ci->session->userdata(self::$token_name);
    }
    
    public static function setToken($token){
        self::$ci->session->set_userdata(self::$token_name, $token);
    }
    
    public static function getUserData() {
        $token = self::$ci->session->userdata(self::$token_name);
        
        if(!empty($token)){
            $token = explode('.', $token)[1];
            return json_decode(base64_decode($token))->data;
        }
        
        return null;
    }
    
    public static function destroyToken(){
        self::$ci->session->sess_destroy();
    }
    
    public static function getEntityValidationFieldsError(){
        return self::$entity_validation_fields;
    }
}
RestApi::initialize(
    'http://localhost/slimAPI/public/',
    'MYAPP-TOKEN'
);