<?php require APP_ROOT . '/app/views/partials/header.php'; ?>

<section class="section">
  <div class="container" style="max-width: 760px;">
    <div class="admin-header">
      <h2>Novo produto</h2>
      <a class="btn btn-outline" href="<?php echo base_path_url('/admin/produtos'); ?>">Voltar</a>
    </div>

    <form class="form-grid" method="post" action="<?php echo base_path_url('/admin/produtos'); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <input type="text" name="nome" placeholder="Nome do produto" required>
      <input type="text" name="categoria" placeholder="Categoria" required>
      <textarea name="descricao" rows="4" placeholder="Descricao" required></textarea>
      <input type="number" name="preco" step="0.01" placeholder="Preco" required>
      <input type="number" name="estoque" placeholder="Estoque" required>
      <input type="file" name="imagem" accept="image/*">
      <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
