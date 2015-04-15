<?php

require_once 'DbConnection.php';
require_once 'dao/CategoryDao.php';

class CategoryService {

    function getCategory($id) {
        try {
            $db = DbConnection::getConnection();
            $dao = new CategoryDao($db);
            $category = $dao->getCategory($id);
            $db = null;
            return $category;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    function getCategories() {
        try {
            $db = DbConnection::getConnection();
            $dao = new CategoryDao($db);
            $db->beginTransaction();
            $categories = $dao->getCategories();
            $db->commit();
            $db = null;
            return $categories;
        } catch (Exception $ex) {
            $db->rollBack();
            return $ex->getMessage();
        }
    }

}
