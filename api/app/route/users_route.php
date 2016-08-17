<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\UsersValidation,
    App\Middleware\AuthMiddleware;

$app->group('/users/', function () {
    $this->get('list/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->users->getAll($args['l'], $args['p']))
                   );
    });
    
    $this->get('get/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->users->get($args['id']))
                   );
    });
    
    $this->post('insert', function ($req, $res, $args) {
        $r = UsersValidation::validate($req->getParsedBody());
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->users->insert($req->getParsedBody()))
                   ); 
    });
    
    $this->put('update/{id}', function ($req, $res, $args) {
        $r = UsersValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));            
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->users->update($req->getParsedBody(), $args['id']))
                   );   
    });
    
    $this->delete('delete/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->users->delete($args['id']))
                   );   
    });
})->add(new AuthMiddleware($app));