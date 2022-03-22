<?php
use Illuminate\Database\Capsule\Manager as DbConnector;
class DatabaseConnector
{
    private $dbc;
    public function __construct()
    {
        $this->dbc=new DbConnector();
        $this->dbc->addConnection(
            [
                "driver" => _driver_,
                "host" => _host_,
                "database" => _database_,
                "username" => _username_,
                "password" => _password_
            ]
        );
        $this->dbc->setAsGlobal();
        $this->dbc->bootEloquent();
    }
   public function getDbc()
   {
       return $this->dbc;
   }
   public function getItems(): \Illuminate\Support\Collection

   {
       return $this->dbc::table("items")->get();
   }
   public function getItemsCount()
   {
       return $this->dbc::table("items")->count();
   }
 public function getItemDetails($id)
     {
         return $this->dbc::table("items")->find($id);

     }
}