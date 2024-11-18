<?php


class Anime_model {
    private $table = 'md_animewishlist';
    private $db;

    public function __construct()
    {
      $this->db = new Database;   
    }


    //Mengambil semua data tabel
    public function getAnime()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    //Mengambil User berdasrkan id
    public function getAnimeById($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addDataAnime($data){
      $query = "INSERT INTO {$this->table} (animeName, publishedDate, animeGenre, animeRating, animeStudio, animeSinopsis, animeWatched ) VALUES (:name, :date, :genre, :rating, :studio, :sinopsis, :watched)";
      $this->db->query($query);
      $this->db->bind('name', $data['animeName']);
      $this->db->bind('date', $data['publishedDate']);
      $this->db->bind('genre', $data['animeGenre']);
      $this->db->bind('rating', $data['animeRating']);
      $this->db->bind('studio', $data['animeStudio']);
      $this->db->bind('sinopsis', $data['animeSinopsis']);
      $this->db->bind('watched', $data['animeWatched']);
      $this->db->execute();
      return $this->db->rowCount();
    }

    public function deleteDataAnime($id){
    $id = intval($id);
    $query = "DELETE FROM {$this->table} WHERE id = :id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
    }

    public function updateDataAnime($data){
      $query = "UPDATE {$this->table} SET 
                  animeName = :name, 
                  publishedDate = :date, 
                  animeGenre = :genre, 
                  animeRating = :rating, 
                  animeStudio = :studio, 
                  animeSinopsis = :sinopsis, 
                  animeWatched = :watched
                WHERE id = :id";
      
      $this->db->query($query);
      $this->db->bind('name', $data['animeName']);
      $this->db->bind('date', $data['publishedDate']);
      $this->db->bind('genre', $data['animeGenre']);
      $this->db->bind('rating', $data['animeRating']);
      $this->db->bind('studio', $data['animeStudio']);
      $this->db->bind('sinopsis', $data['animeSinopsis']);
      $this->db->bind('watched', $data['animeWatched']);
      $this->db->bind('id', $data['id']); // Ensure the ID is passed
      $this->db->execute();
      return $this->db->rowCount();
    }
}