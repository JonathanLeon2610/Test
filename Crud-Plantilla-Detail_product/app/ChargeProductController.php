<?php
session_start();
if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'create':
			$name=strip_tags($_POST['name']);
            $slug=strip_tags($_POST['slug']);
            $description=strip_tags($_POST['description']);
            $features=strip_tags($_POST['features']);
            $brand_id=strip_tags($_POST['brand_id']);
            $productController=new ChargeProductController();
            $imagen=$productController->loadImg($_FILES['uploadedfile']);
            $productController->createProduct($name,$slug,$description,$features,$brand_id,$imagen);
		    break; 
        case 'update':
            $name=strip_tags($_POST['name']);
            $slug=strip_tags($_POST['slug']);
            $description=strip_tags($_POST['description']);
            $features=strip_tags($_POST['features']);
            $brand_id=strip_tags($_POST['brand_id']);
            $detalleControlador=new ChargeProductController();
            // $detalleControlador->editProduct($name,$slug,$description,$features,$brand_id,'1');
            var_dump('name= '.$name.'&slug='.$slug.'&description='.$description.'&features='.$features.'&brand_id='.$brand_id.'&id=1',);
            break;
	}

}



class ChargeProductController{


    public function loadImg($img){
        $target_path = "../img";
        $target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            echo "El archivo ".  basename( $_FILES['uploadedfile']['name']). 
            " ha sido subido";
        } else{
            echo "Ha ocurrido un error, trate de nuevo!";
        }
        return $target_path;
    }



    public function createProduct($name,$slug,$description,$features,$brand_id,$imagen){
        // Insertar codigo de postman
        $curl = curl_init();
        $token=$_SESSION['token'];
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $name,'slug' => $slug,'description' => $description,'brand_id' => $brand_id,'cover'=> new CURLFile($imagen)),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token"
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
        $response=json_decode($response);

    }
    public function chargeProducts($token){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            // Aqui va el bearer toker
            "Authorization: Bearer $token"
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response,true);
        return $response["data"];
    }
    
        public static function chargeBrandsId(){
            $curl = curl_init();
            $token=$_SESSION['token'];
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token"
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response);
            if ( isset($response->code) && $response->code > 0) {
                return $response->data;
            }else{
                return array();
            }
        }

        public function chargeDetails($slug){
            $curl = curl_init();
            $token=$_SESSION['token'];
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/'.$slug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token"
            ),
            ));
    
            $response = curl_exec($curl);
            curl_close($curl);
            $response=json_decode($response);
            return $response->data;
                }

        public function editProduct($name,$slug,$description,$features,$brand_id,$id){
            $curl = curl_init();
            $token=$_SESSION['token'];
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => 'name= '.$name.'&slug='.$slug.'&description='.$description.'&features='.$features.'&brand_id='.$brand_id.'&id=1',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token"
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
        }
    }
    
?>