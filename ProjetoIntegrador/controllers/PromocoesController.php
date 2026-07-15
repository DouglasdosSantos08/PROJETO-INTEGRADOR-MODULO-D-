<?php

class PromocoesController {
    private $db;

    public function __construct() {
        // Altere para a forma exata como você faz a conexão nos outros controllers (ex: usando uma classe Database)
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=sistema_login;charset=utf8", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " || $e->getMessage());
        }
    }

    public function index() {
        // Busca os jogos exclusivamente na nova tabela de promoções
        $query = "SELECT * FROM jogos_promocoes";
        $stmt = $this->db->query($query);
        $jogosPromo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Renderiza a view de promoções
        require __DIR__ . '/../view/promocoes.php';
    }
}