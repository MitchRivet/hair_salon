<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Client::deleteAll();
        }

        function test_save()
        {
            $client_name = "Sharon";
            $test_client = new Client($client_name);

            $test_client->save();

            $result = Client::getAll();
            $this->assertEquals($test_client, $result[0]);

        }

        function test_getAll()
        {
            $client_name = "Lauren";
            $client_name2 = "Katie";
            $test_client = new Client($client_name);
            $test_client->save();
            $test_client2 = new Client($client_name2);
            $test_client2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            $client_name = "Lauren";
            $client_name2 = "Katie";
            $test_client = new Client($client_name);
            $test_client->save();
            $test_client2 = new Client($client_name2);
            $test_client2->save();

            Client::deleteAll();

            $result = Client::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            $client_name = "Lauren";
            $id = 1;
            $test_client = new Client($client_name, $id);

            $result = $test_client->getId();

            $this->assertEquals(1, $result);
        }

        function test_Find()
        {
            $client_name = "Lauren";
            $client_name2 = "Katie";
            $test_client = new Client($client_name);
            $test_client->save();
            $test_client2 = new Client($client_name2);
            $test_client2->save();

            $id = $test_client->getId();
            $result = Client::find($id);

            $this->assertEquals($test_client, $result); 
        }
    }
?>
