<?php

    class Client
    {
        private $client_name;

        function __construct($client_name)
        {
            $this->client_name = $client_name;
        }

        function setClientName($new_client_name)
        {
            $this->client_name = (string) $new_client_name;
        }

        function getClientName()
        {
            return $this->client_name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (client_name) VALUES ('{$this->getClientName()}');");
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $client_name = $client['client_name'];
                $new_client = new Client($client_name);
                array_push($clients, $new_client);
            }

            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;"); 
        }
    }
?>
