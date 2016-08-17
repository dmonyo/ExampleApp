<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\PersonValidation,
    App\Middleware\AuthMiddleware;

$app->group('/person/', function () {
    $this->get('', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'text/html')
                   ->write('Soy una ruta de prueba');
    });
    
    $this->get('list/{limit}/{page}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->person->getAll($args['limit'], $args['page'])));
    });    
    
    $this->get('get/{id}', function ($req, $res, $args) {       
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->person->get($args['id'])));
    });
    
    $this->post('insert', function ($req, $res, $args) {
        $r = PersonValidation::validate($req->getParsedBody());
        
        if(!$r->response){           
        
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }        
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->person->insert($req->getParsedBody()))); 
    });
    
    $this->put('update/{id}', function ($req, $res, $args) {
        $r = personValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){ 
                
        
        return $res->withHeader('Content-type', 'application/json')        
                       ->withStatus(422)
                       ->write(json_encode($r->errors));            
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->person->update($req->getParsedBody(), $args['id'])));   
    });
    
    $this->delete('delete/{id}', function ($req, $res, $args) {        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(json_encode($this->model->person->delete($args['id'])));   
    }); 
})->add(new AuthMiddleware($app));