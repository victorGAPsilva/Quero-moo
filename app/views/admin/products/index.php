<?php require APP_ROOT . '/app/views/partials/header.php'; ?>
<?php if (!isset($products) || !is_array($products)): ?>
  <section class="section">
    <div class="container">
      <div class="alert">Lista de produtos indisponivel.</div>
      <a class="btn btn-outline" href="<?php echo base_path_url('/admin'); ?>">Voltar ao dashboard</a>
    </div>
  </section>
  <?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
  <?php return; ?>
<?php endif; ?>

<section class="section">
  <div class="container">
    <div class="admin-header">
      <div>
        <h2>Produtos</h2>
        <p>Gerencie o catalogo da loja.</p>
      </div>
      <div class="cta-group">
        <a class="btn btn-primary" href="<?php echo base_path_url('/admin/produtos/novo'); ?>">Novo produto</a>
        <a class="btn btn-outline" href="<?php echo base_path_url('/admin'); ?>">Dashboard</a>
      </div>
    </div>

    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert"><?php echo e($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
    <?php endif; ?>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Produto</th>
          <th>Categoria</th>
          <th>Preco</th>
          <th>Estoque</th>
          <th>Acoes</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $product): ?>
          <tr>
            <td><?php echo e($product['id']); ?></td>
            <td><?php echo e($product['nome']); ?></td>
            <td><?php echo e($product['categoria']); ?></td>
            <td>R$ <?php echo number_format((float)$product['preco'], 2, ',', '.'); ?></td>
            <td><?php echo e($product['estoque']); ?></td>
            <td>
              <a class="btn btn-outline" href="<?php echo base_path_url('/admin/produtos/' . $product['id'] . '/editar'); ?>">Editar</a>
              <form method="post" action="<?php echo base_path_url('/admin/produtos/' . $product['id'] . '/deletar'); ?>" style="display:inline-block;">
                <?php echo csrf_field(); ?>
                <button class="btn btn-primary" type="submit">Excluir</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (empty($products)): ?>
          <tr>
            <td colspan="6">Nenhum produto cadastrado.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
