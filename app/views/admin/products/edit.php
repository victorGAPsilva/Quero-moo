<?php require APP_ROOT . '/app/views/partials/header.php'; ?>
<?php if (empty($product)): ?>
  <section class="section">
    <div class="container">
      <div class="alert">Produto nao encontrado ou link invalido.</div>
      <a class="btn btn-outline" href="<?php echo base_path_url('/admin/produtos'); ?>">Voltar</a>
    </div>
  </section>
  <?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
  <?php return; ?>
<?php endif; ?>

<section class="section">
  <div class="container" style="max-width: 760px;">
    <div class="admin-header">
      <h2>Editar produto</h2>
      <a class="btn btn-outline" href="<?php echo base_path_url('/admin/produtos'); ?>">Voltar</a>
    </div>

    <form class="form-grid" method="post" action="<?php echo base_path_url('/admin/produtos/' . $product['id']); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <input type="text" name="nome" value="<?php echo e($product['nome']); ?>" required>
      <input type="text" name="categoria" value="<?php echo e($product['categoria']); ?>" required>
      <textarea name="descricao" rows="4" required><?php echo e($product['descricao']); ?></textarea>
      <input type="number" name="preco" step="0.01" value="<?php echo e($product['preco']); ?>" required>
      <input type="number" name="estoque" value="<?php echo e($product['estoque']); ?>" required>
      <input type="file" name="imagem" accept="image/*">
      <button class="btn btn-primary" type="submit">Atualizar</button>
    </form>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
