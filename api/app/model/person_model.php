<?php
namespace App\Model;

use App\Lib\Response;

class PersonModel
{
    private $db;
    private $table = 'person';
    private $response;
    
    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }
    
    /*
    function listAll
    params: $limit, $page
    result: person list (array())
    */
    public function getAll($limit = -1, $page = -1)
    {      
      if ($limit < 0 && $page < 0) {
          # code...
          $data = $this->db->from($this->table)
                       ->orderBy('id DESC')
                       ->fetchAll();
      } else {
          # code...
          $data = $this->db->from($this->table)
                       ->limit($limit)
                       ->offset($page)
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

    /*
    function get
    params: $id
    result: person data (array())
    */
    
    public function get($id)
    {
      return $this->db->from($this->table, $id)
                      ->fetch();
    }
    
    /*
    function insert
    params: $data
    result: true or false
    */
    public function insert($data)
    {      
        
      $query = $this->db->insertInto($this->table, $data);
      $insert = $query->execute();

      print_r($insert);
      die;
      
      return $this->response->SetResponse(true);
    }
    
    public function update($data, $id)
    {       
        
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