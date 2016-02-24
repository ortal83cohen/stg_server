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
        $host = $this->get("MYSQL_HOST");
        $this->db = new \DB\SQL("mysql:host=$host;port=3306;dbname=stg", 'ortal83cohen', "1Q1q1q1q");
//        $this->db = new \DB\SQL('mysql:host=sql2.freemysqlhosting.net;port=3306;dbname=sql2106079', 'sql2106079', "vS6%gG3!");
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
        $id = $this->db->lastInsertId();
        $this->db->exec("INSERT INTO tbl_records ( locationId, lang, title, description, imageUrl, likes, unLikes, recordUrl) VALUES
	( :locationId, :lang, :title, :description, :imageUrl, :likes, :unLikes, :recordUrl);", array(":locationId" => $id, ":lang" => "en", ":title" => $request["title"]
        , ":description" => $request["description"], ":imageUrl" => str_replace(' ', '', $this->get("DOMAIN") . $this->get("IMAGE_LIBRARY") . $request["title"] . $id . $this->get("IMAGE_TYPE")), ":likes" => 0, ":unLikes" => 0
        , ":recordUrl" => str_replace(' ', '', $this->get("DOMAIN") . $this->get("RECORD_LIBRARY") . $request["title"] . $id . $this->get("RECORD_TYPE"))));
        $this->db->commit();
        return $id;
    }

    public function updateRecords($request)
    {
        $this->db->begin();
        if ($request["status"] == "like") {
            $this->db->exec("UPDATE tbl_records set likes = likes +1 WHERE id = :id",
                array(":id" => $request["id"]));
        }
        if ($request["status"] == "unlike") {
            $this->db->exec("UPDATE tbl_records set unlikes = unlikes +1 WHERE id = :id",
                array(":id" => $request["id"]));
        }
        $this->db->commit();
    }

    public function setUser($request)
    {
        $this->db->begin();

        $this->db->exec("INSERT INTO tbl_users ( id, email, imageUrl, firstName,lastName) VALUES
    (:id, :email, :imageUrl, :firstName,:lastName);", array(":id" => $request["userId"], ":email" => $request["email"], ":imageUrl" => $request["imageUrl"]
        , ":firstName" => $request["firstName"], ":lastName" => $request["lastName"]));

        $this->db->commit();
    }

    public function setUsersLogin($request)
    {
        $this->db->begin();

        $this->db->exec("INSERT INTO tbl_users_login ( userId) VALUES
    (:userId);", array(":userId" => $request["userId"]));

        $this->db->commit();
    }

    public function updateUsers($request)
    {
//        $this->db->begin();
//
//        $this->db->exec("UPDATE tbl_users set ... WHERE id = :id",
//            array(":id" => $request["id"]));
//
//        $this->db->commit();
    }
}