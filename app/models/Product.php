<?php

class Product extends Model
{
    public function all()
    {
        $stmt = $this->db->query('SELECT * FROM produtos ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function latest($limit = 6)
    {
        $stmt = $this->db->prepare('SELECT * FROM produtos ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM produtos WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare(
            'INSERT INTO produtos (nome, descricao, preco, imagem, categoria, estoque) VALUES (:nome, :descricao, :preco, :imagem, :categoria, :estoque)'
        );

        return $stmt->execute([
            ':nome' => $data['nome'],
            ':descricao' => $data['descricao'],
            ':preco' => $data['preco'],
            ':imagem' => $data['imagem'],
            ':categoria' => $data['categoria'],
            ':estoque' => $data['estoque'],
        ]);
    }

    public function update($id, array $data)
    {
        $stmt = $this->db->prepare(
            'UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem, categoria = :categoria, estoque = :estoque WHERE id = :id'
        );

        return $stmt->execute([
            ':nome' => $data['nome'],
            ':descricao' => $data['descricao'],
            ':preco' => $data['preco'],
            ':imagem' => $data['imagem'],
            ':categoria' => $data['categoria'],
            ':estoque' => $data['estoque'],
            ':id' => $id,
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM produtos WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
