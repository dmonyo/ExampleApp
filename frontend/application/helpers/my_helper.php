<?php
function paginacion_config($base_url, $total, $limite){
    $config['base_url']   = $base_url;
    $config['total_rows'] = $total;
    $config['per_page']   = $limite;
    
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    
    return $config;
}

function encode_image_to_base64($file){
    if($file !== null){
        $path = $file["tmp_name"];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        if(getimagesize($path) !== false){
            return 'data:image/' . $type . ';base64,' . base64_encode($data);        
        }
    }
    
    return null;
}

function test_header_data(){
    return [
        'user' => (object)[
            'Nombre' => 'Eduardo',
            'Correo' => 'erodriguez@anexsoft.com'
        ]
    ];
}