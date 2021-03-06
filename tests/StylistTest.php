<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll(); 
        }

        function test_getStylistName()
        {
            $stylist_name = "Liz";
            $test_stylist = new Stylist($stylist_name);

            $result = $test_stylist->getStylistName();

            $this->assertEquals($stylist_name, $result);
        }

        function test_getId()
        {
            $stylist_name = "Liz";
            $id = 1;
            $test_stylist = new Stylist($stylist_name, $id);

            $result = $test_stylist->getId();

            $this->assertEquals(true, is_numeric($result));

        }

        function test_save()
        {
            $stylist_name = "Liz";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $result = Stylist::getAll();

            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            $stylist_name = "Liz";
            $stylist_name2 = "Gwen";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            $stylist_name = "Liz";
            $stylist_name2 = "Gwen";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            Stylist::deleteAll();
            $result = Stylist::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $stylist_name = "Liz";
            $stylist_name2 = "Gwen";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();

            $result = Stylist::find($test_stylist->getId());

            $this->assertEquals($test_stylist, $result);
        }

        function testGetClients()
        {
            $stylist_name = "Liz";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $test_stylist_id = $test_stylist->getId();

            $client_name = "Lauren";
            $test_client = new Client($client_name, $id, $test_stylist_id);
            $test_client->save();

            $client_name2 = "Katie";
            $test_client2 = new Client($client_name2, $id, $test_stylist_id);
            $test_client2->save();

            $result = $test_stylist->getClients();

            $this->assertEquals([$test_client, $test_client2], $result);
        }
    }
?>
