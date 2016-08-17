<?php
class PersonModel extends CI_Model{
     public function listar($l = 10, $p = 0){
        return RestApi::call(
            RestApiMethod::GET,
            "person/list/$l/$p"
        );
    }

    public function getAll(){
        $l = -1; $p = -1;
        return RestApi::call(
            RestApiMethod::GET,
            "person/list/$l/$p"
        );
    }

    
    public function get($id){
        return RestApi::call(
            RestApiMethod::GET,
            "person/get/$id"
        );
    }
    
    public function insert($data){
        return RestApi::call(
            RestApiMethod::POST,
            "person/insert",
            $data
        );
    }
    
    public function update($data, $id){
        return RestApi::call(
            RestApiMethod::PUT,
            "person/update/$id",
            $data
        );
    }
    
    public function delete($id){
        return RestApi::call(
            RestApiMethod::DELETE,
            "person/delete/$id"
        );
    }

}