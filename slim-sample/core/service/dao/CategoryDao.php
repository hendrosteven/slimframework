<?php

require_once 'domain/Category.php';

class CategoryDao {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    function getCategory($id) {
        $sql = "SELECT * FROM categories WHERE id=:id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $row = $stmt->fetchObject();
            $category = new Category();
            $category->id = $row->id;
            $category->name = $row->name;
            if ($row->parrent_id) {
                $category->parent = $this->getCategory($row->parrent_id);
            } else {
                $category->parent = NULL;
            }
            return $category;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function getCategories() {
        $sql = "select id,name,parrent_id from categories order by name";
        $categories = array();
        try {
            $stmt = $this->db->query($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while ($row = $stmt->fetch()) {
                $category = new Category();
                $category->id = $row->id;
                $category->name = $row->name;
                if ($row->parrent_id) {
                    $category->parent = $this->getCategory($row->parrent_id);
                } else {
                    $category->parent = NULL;
                }
                array_push($categories, $category);
            }
            return $categories;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
