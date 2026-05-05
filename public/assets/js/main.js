document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".card");
  cards.forEach((card, index) => {
    card.style.animationDelay = `${index * 0.08}s`;
    card.classList.add("fade-in");
  });

  const cartKey = "qm_cart";
  const cartToggle = document.querySelector(".cart-toggle");
  const cartSidebar = document.querySelector(".cart-sidebar");
  const cartOverlay = document.querySelector(".cart-overlay");
  const cartItemsEl = document.querySelector("[data-cart-items]");
  const cartTotalEl = document.querySelector("[data-cart-total]");
  const cartCountEl = document.querySelector(".cart-count");
  const cartWhatsapp = document.querySelector("[data-cart-whatsapp]");
  const toastEl = document.querySelector(".cart-toast");

  const getCart = () => {
    try {
      const raw = localStorage.getItem(cartKey);
      return raw ? JSON.parse(raw) : [];
    } catch (err) {
      return [];
    }
  };

  const saveCart = (items) => {
    localStorage.setItem(cartKey, JSON.stringify(items));
  };

  const formatCurrency = (value) =>
    value.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });

  const updateCount = (items) => {
    const count = items.reduce((sum, item) => sum + item.qty, 0);
    if (cartCountEl) {
      cartCountEl.textContent = String(count);
    }
  };

  const buildWhatsAppLink = (items, total) => {
    if (!cartSidebar || !cartWhatsapp) {
      return;
    }

    const phone = cartSidebar.dataset.whatsappPhone || "";
    if (!phone) {
      cartWhatsapp.href = "#";
      return;
    }

    const lines = items.map(
      (item) => `- ${item.name} (x${item.qty}) - ${formatCurrency(item.price * item.qty)}`
    );
    const message = [`Ola! Quero pedir:`, ...lines, `Total: ${formatCurrency(total)}`].join("\n");
    cartWhatsapp.href = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
  };

  const renderCart = () => {
    if (!cartItemsEl || !cartTotalEl) {
      return;
    }

    const items = getCart();
    cartItemsEl.innerHTML = "";

    if (items.length === 0) {
      cartItemsEl.innerHTML = '<p class="cart-empty">Seu carrinho esta vazio.</p>';
      cartTotalEl.textContent = "R$ 0,00";
      buildWhatsAppLink([], 0);
      updateCount(items);
      return;
    }

    let total = 0;
    items.forEach((item) => {
      total += item.price * item.qty;
      const itemEl = document.createElement("div");
      itemEl.className = "cart-item";
      itemEl.innerHTML = `
        <img src="${item.image}" alt="${item.name}">
        <div>
          <strong>${item.name}</strong>
          <span>${formatCurrency(item.price)} x ${item.qty}</span>
        </div>
        <button type="button" data-cart-remove="${item.id}">Remover</button>
      `;
      cartItemsEl.appendChild(itemEl);
    });

    cartTotalEl.textContent = formatCurrency(total);
    updateCount(items);
    buildWhatsAppLink(items, total);
  };

  const openCart = () => {
    if (!cartSidebar || !cartOverlay) {
      return;
    }
    cartSidebar.classList.add("open");
    cartOverlay.classList.add("show");
    cartSidebar.setAttribute("aria-hidden", "false");
    document.body.classList.add("cart-open");
  };

  const closeCart = () => {
    if (!cartSidebar || !cartOverlay) {
      return;
    }
    cartSidebar.classList.remove("open");
    cartOverlay.classList.remove("show");
    cartSidebar.setAttribute("aria-hidden", "true");
    document.body.classList.remove("cart-open");
  };

  const showToast = (message) => {
    if (!toastEl) {
      return;
    }
    toastEl.textContent = message;
    toastEl.classList.add("show");
    const existingTimeout = Number(toastEl.dataset.timeoutId || 0);
    if (existingTimeout) {
      window.clearTimeout(existingTimeout);
    }
    const timeoutId = window.setTimeout(() => {
      toastEl.classList.remove("show");
    }, 2400);
    toastEl.dataset.timeoutId = String(timeoutId);
  };

  document.addEventListener("click", (event) => {
    const target = event.target;
    if (!(target instanceof HTMLElement)) {
      return;
    }

    if (target.closest("[data-cart-close]")) {
      closeCart();
      return;
    }

    const addButton = target.closest("[data-cart-add]");
    if (addButton instanceof HTMLElement) {
      const id = addButton.dataset.cartId || "";
      const name = addButton.dataset.cartName || "";
      const priceValue = Number(addButton.dataset.cartPrice || 0);
      const image = addButton.dataset.cartImage || "";
      if (!id || !name || !Number.isFinite(priceValue)) {
        return;
      }

      const items = getCart();
      const existing = items.find((item) => item.id === id);
      if (existing) {
        existing.qty += 1;
      } else {
        items.push({ id, name, price: priceValue, image, qty: 1 });
      }
      saveCart(items);
      renderCart();
      showToast(`${name} foi adicionado no carrinho.`);
    }

    if (target.matches("[data-cart-remove]")) {
      const id = target.getAttribute("data-cart-remove");
      if (!id) {
        return;
      }
      const items = getCart().filter((item) => item.id !== id);
      saveCart(items);
      renderCart();
      return;
    }
  });

  if (cartToggle) {
    cartToggle.addEventListener("click", () => {
      renderCart();
      openCart();
    });
  }

  renderCart();
});
