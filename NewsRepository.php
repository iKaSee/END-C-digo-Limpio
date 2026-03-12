<?php
class NewsRepository {
    private $db;
    private $table = 'noticiasFTInnodb';

    public function __construct(PDO $db) {
        $this->db = $db;
    }


    public function searchByTerm(string $term): array {
        if (empty($term)) return [];

        $sql = "SELECT titulo, cuerpo, data FROM {$this->table} 
                WHERE titulo ILIKE :term OR cuerpo ILIKE :term";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['term' => '%' . $term . '%']);
        
        return $stmt->fetchAll();
    }
}