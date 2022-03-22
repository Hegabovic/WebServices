<?php

class ApiHelper
{
    private $response=array("data"=>"","error"=>"");
    private  $validMethods=array("get","post","put","delete");
    private $allowedResorses=["items"];
    private $resource;
    private $resourcesIdentifier;
    private $databaseConnector;

    /*Constructor*/
    public function  __construct()
    {
        $requestParameters=explode("/",$_SERVER["REQUEST_URI"]);
        $this->resource= $requestParameters[3] ?? "";
        $this->resourcesIdentifier=$requestParameters[4] ?? "";
        $this->databaseConnector=new DatabaseConnector();
    }

    /*Methods*/
    public function validateMethod()
    {
        $method=strtolower($_SERVER["REQUEST_METHOD"]);
        if(!in_array($method,$this->validMethods))
        {
            $this->sendResopnse(405,"","invalid method");
        }
    }
    public function validateResource()
    {
        if(!in_array($this->resource,$this->allowedResorses))
        {
            $this->sendResopnse(400,"","Undefined Resource");
        }
    }
    public function sendResopnse(int $status, $data, $error)
    {
        $this->response["data"]=$data;
        $this->response["error"]=$error;
        http_response_code($status);
        header("Content-Type:application/json");
        echo json_encode($this->response);
        exit();
    }
    public function apiGet()
    {
        if($this->resourcesIdentifier==="")
        {
            $data=$this->databaseConnector->getItems();
            $this->sendResopnse("200",$data,"");
        } else
        {
            if(is_numeric($this->resourcesIdentifier))
            {
                $data=$this->databaseConnector->getItemDetails($this->resourcesIdentifier);
                if(!is_null($data))
                {
                    $this->sendResopnse("200",$data,"");
                }else{
                    $this->sendResopnse("200","","Item not found");
                }
            }
        }
    }
}