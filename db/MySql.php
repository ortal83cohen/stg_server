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
    }

    public function getRecords($request)
    {
        return $this->db->exec('SELECT tbl_records.*,tbl_locations.*,(tbl_records.id not in ((select recordId from tbl_users_votes WHERE userId = :userId))) as canVote FROM tbl_records INNER JOIN tbl_locations ON locationId = tbl_locations.id LEFT JOIN tbl_users ON userId = tbl_users.id LIMIT ' .$request["offset"].",". $request["limit"], array(":userId" => $request["userId"]));
    }

    public function getUserRecords($request)
    {
        return $this->db->exec('SELECT tbl_records.*,tbl_locations.* FROM tbl_records INNER JOIN tbl_locations ON locationId = tbl_locations.id LEFT JOIN tbl_users ON userId = tbl_users.id WHERE userId = :userId ', array(":userId" => $request["userId"]));
    }

    public function getServiceGpsViewportRecords($request)
    {
        $location = explode(";", $request["context"]);
        $maxLocation = explode(",", $location[0]);
        $minLocation = explode(",", $location[1]);


        $this->db->exec("INSERT INTO tbl_service_gps ( userId, lat,lon) VALUES
            (:userId, :lat,:lon);", array(":userId" => $request["userId"], ":lat" => ($minLocation[0] + $maxLocation[0]) / 2, ":lon" => ($minLocation[1] + $maxLocation[1]) / 2));


        return $this->db->exec('SELECT tbl_records.*,tbl_locations.*,(tbl_records.id not in ((select recordId from tbl_users_votes WHERE userId = :userId))) as canVote
                                FROM tbl_records INNER JOIN tbl_locations ON locationId = tbl_locations.id LEFT JOIN tbl_users ON userId = tbl_users.id
                                WHERE lat>:minlat and lat<:maxlat and lon>:minlon and lon<:maxlon
                                AND (SELECT COUNT(*) FROM tbl_service_gps WHERE userid=:userId and lat>:minlat and lat<:maxlat and lon>:minlon and lon<:maxlon) <2
                                 LIMIT ' . $request["limit"],
            array(":userId" => $request["userId"], ":minlat" => $minLocation[0], ":maxlat" => $maxLocation[0], ":minlon" => $minLocation[1], ":maxlon" => $maxLocation[1]));
    }

    public function setRecords($request)
    {
        $this->db->begin();
        $this->db->exec("INSERT INTO tbl_locations ( name, lat, lon, type) VALUES
    (:name, :lat, :lon, :type);", array(":name" => $request["locationName"], ":lat" => $request["lat"], ":lon" => $request["lon"], ":type" => $request["type"]));
        $id = $this->db->lastInsertId();
        $this->db->exec("INSERT INTO tbl_records ( locationId, lang, title, description, imageUrl, likes, unLikes, recordUrl,userId) VALUES
	( :locationId, :lang, :title, :description, :imageUrl, :likes, :unLikes, :recordUrl, :userId);", array(":locationId" => $id, ":lang" => "en", ":title" => $request["title"]
        , ":description" => $request["description"], ":imageUrl" => str_replace(' ', '',  $this->get("IMAGE_LIBRARY") . $request["title"] . $id . $this->get("IMAGE_TYPE")), ":likes" => 0, ":unLikes" => 0
        , ":recordUrl" => str_replace(' ', '',  $this->get("RECORD_LIBRARY") . $request["title"] . $id . $this->get("RECORD_TYPE")), ":userId" => $request["userId"]));
        $this->db->commit();
        return $id;
    }

    public function updateRecords($request)
    {
        $this->db->begin();

        $this->db->exec("INSERT INTO tbl_users_votes ( userId, recordId,voted) VALUES
            (:userId, :recordId,:voted);", array(":userId" => $request["userId"], ":recordId" => $request["id"], ":voted" => $request["status"]));

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

        $this->db->exec("INSERT INTO tbl_users_logins ( userId) VALUES
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