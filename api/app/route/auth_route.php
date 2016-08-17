<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Middleware\AuthMiddleware;

$app->group('/auth/', function () {
    $this->post('authenticate', function ($req, $res, $args) {
        $params = $req->getParsedBody(); 
        
        
        return $res->withHeader('Content-type', 'application/json')		    
                   ->write(json_encode($this->model->auth->authenticate($params['email'], $params['password']))
                   );
    });
});
