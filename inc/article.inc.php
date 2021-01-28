<?php
class Article{
    public function fetchAll(){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM articles");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetchData($idArticle){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM articles WHERE idArticle = ?");
        $query->bindValue(1, $idArticle);
        $query->execute();

        return $query->fetch();
    }
}