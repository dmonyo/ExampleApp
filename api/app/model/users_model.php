<?php
namespace App\Model;

use App\Lib\Response;

class UsersModel
{
    private $db;
    private $table = 'users';
    private $response;
    
    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }
    
    public function getAll($l, $p)
    {
        if ($l > 0 && $p > 0) {
             $data = $this->db->from($this->table)                         
                         ->limit($l)
                         ->offset($p)
                         ->orderBy('id DESC')
                         ->fetchAll();

        } else {
            $data = $this->db->from($this->table)
                         ->orderBy('id DESC')
                         ->fetchAll();

        }
        
       
        
        $total = $this->db->from($this->table)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;
        
        return [
            'total' => $total,
            'data'  => $data
            
        ];
    }
    
    public function get($id)
    {
        return $this->db->from($this->table, $id)
                        ->fetch();
    }
    
    public function insert($data)
    {
        $data['password'] = sha1($data['password']);

        $this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    public function update($data, $id)
    {
        if(isset($data['password'])){
            $data['password'] = sha1($data['password']);            
        }
        
        $this->db->update($this->table, $data, $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    
    public function delete($id)
    {
        $this->db->deleteFrom($this->table, $id)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
}