<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/8/2016
 */
class MySql extends F3instance
{// if I had more time I would replace this class with DAL framework

    private $db;

    /**
     * MySql constructor.
     */
    public function __construct()
    {
//        $this->db = new \DB\SQL('mysql:host=mysqlcluster7.registeredsite.com;port=3306;dbname=stg', 'ortal83cohen', "1Q1q1q1q");
        $this->db = new \DB\SQL('mysql:host=sql2.freemysqlhosting.net;port=3306;dbname=sql2106079', 'sql2106079', "vS6%gG3!");
    }

    public function getRecords()
    {
        return $this->db->exec('SELECT * FROM tbl_records INNER JOIN tbl_locations ON locationId = tbl_locations.id', array());
    }

    public function setRecords($request)
    {

        $this->db->begin();
        $this->db->exec("INSERT INTO tbl_locations ( name, lat, lon, type) VALUES
    (:name, :lat, :lon, :type);", array(":name" => $request["locationName"], ":lat" => $request["lat"], ":lon" => $request["lon"], ":type" => $request["type"]));

        $this->db->exec("INSERT INTO tbl_records ( locationId, lang, title, description, imageUrl, likes, unLikes, recordUrl) VALUES
	( :locationId, :lang, :title, :description, :imageUrl, :likes, :unLikes, :recordUrl);", array(":locationId" => $this->db->lastInsertId(), ":lang" => "en", ":title" => $request["title"]
        , ":description" => $request["description"], ":imageUrl" => $this->get("DOMAIN") . $this->get("IMAGE_LIBRARY") . $request["title"] . $this->get("IMAGE_TYPE"), ":likes" => 10, ":unLikes" => 20

        , ":recordUrl" => null));
        $this->db->commit();
    }
}