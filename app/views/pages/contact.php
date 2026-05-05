<?php require APP_ROOT . '/app/views/partials/header.php'; ?>

<section class="section">
  <div class="container">
    <div class="section-title">
      <h2>Contato</h2>
    </div>
    <div class="hero">
      <div>
        <p>Quer falar com a equipe QUERO MOO? Envie sua mensagem ou fale com a gente pelo WhatsApp.</p>
        <p><strong>WhatsApp:</strong> <?php echo e(config('whatsapp_phone')); ?></p>
        <p><strong>Email:</strong> contato@queromoo.com</p>
      </div>
      <div class="hero-card">
        <form class="form-grid">
          <input type="text" placeholder="Nome">
          <input type="email" placeholder="Email">
          <textarea rows="4" placeholder="Mensagem"></textarea>
          <button class="btn btn-primary" type="button">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
