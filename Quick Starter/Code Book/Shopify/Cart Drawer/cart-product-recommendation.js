<div class="related-products-section">
  <h3>You may also like</h3>
  <div class="related-products-container">
    <!-- Related products will be dynamically inserted here -->
  </div>
</div>

<style>
  .related-products-section {
    margin-top: 20px;
    padding-bottom: 20px;
  }

  .related-products-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  .related-product-item {
    width: calc(50% - 5px);
    position: relative;
  }

  .related-product-item img {
    width: 100%;
    height: auto;
  }
  .related-product-item .cart-product-tag {
      position: absolute;
      top: 0;
      font-size: 10px;
      left: 0;
      padding: 4px 2px;
      background: #000;
      color: #edc480;
      line-height: 1;
      letter-spacing: 0;
  }
  .related-product-item p.cart__item-name { margin-top: 5px; }
  .related-product-item p {
    margin-bottom: 0px;
    text-align: left;
    font-size: 12px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    letter-spacing: 0;
    color: #222;
  }

  .related-products-section h3 {
    font-size: 14px;
  }
</style>

<script>
// Track the last viewed product and store it in localStorage
function trackViewedProduct(productId) {
  localStorage.setItem('lastViewedProduct', productId);
}

// Fetch related products based on a product ID
function fetchRelatedProducts(productId) {
  fetch(`/recommendations/products.json?product_id=${productId}&limit=8`)
    .then(response => response.json())
    .then(data => {
      displayRelatedProducts(data.products);
    });
}

// Function to display related products in the cart drawer
function formatPrice(price) {
  return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(price / 100);
}

function displayRelatedProducts(products) {
  var relatedProductsContainer = document.querySelector('.related-products-container');
  relatedProductsContainer.innerHTML = ''; // Clear previous products

  products.forEach(function(product) {
    // console.log({product})
    var priceHtml = `<span class="product-price">${formatPrice(product.price)}</span>`;

    if (product.compare_at_price && product.compare_at_price > product.price) {
      priceHtml = `
      <span class="compare-price"><del>${formatPrice(product.compare_at_price)}</del></span>
        <span class="product-price discounted">${formatPrice(product.price)}</span>
        
      `;
    }

    if (product.compare_at_price && product.compare_at_price > product.price) {
      saleTag = `
        <div class="cart-product-tag">-${Number(Number(product.compare_at_price - product.price) / product.compare_at_price * 100).toFixed(0)}%</div>
      `;
    }

    var productHtml = `
      <div class="related-product-item">
        <a href="${product.url}">
          ${saleTag}
          <img src="${product.featured_image}" alt="${product.title}">
          <p class="cart__item-name">${product.title}</p>
          <p class="cart__item-price">${priceHtml}</p>
        </a>
      </div>
    `;
    relatedProductsContainer.insertAdjacentHTML('beforeend', productHtml);
  });
}

// Fetch cart data and get related products for the first item in the cart
function fetchCartAndShowRelatedProducts() {
  fetch('/cart.js')
    .then(response => response.json())
    .then(cart => {
      if (cart.items.length > 0) {
        var firstProductId = cart.items[0].product_id;
        fetchRelatedProducts(firstProductId); // Fetch related products for the first product in the cart
      } else {
        // Cart is empty, fetch related products for the last viewed product
        var lastViewedProduct = localStorage.getItem('lastViewedProduct');
        if (lastViewedProduct) {
          fetchRelatedProducts(lastViewedProduct); // Fetch related products for the last viewed product
        }
      }
    });
  console.log("1")
}

{% if template.name contains "product" %}
// Track viewed product (for product pages, place this code inside your product page template)
document.addEventListener('DOMContentLoaded', function() {
  if (window.location.pathname.includes('/products/')) { // Only track if it's a product page
    const productId = {{ product.id }}; // Shopify liquid variable for product ID
    trackViewedProduct(productId);
  }
});
{% endif %}
// Call this function after the cart drawer updates (after adding/removing a product)
document.addEventListener('cart:updated', function() {
  fetchCartAndShowRelatedProducts();
});

// Initial call on page load to show related products
fetchCartAndShowRelatedProducts();
</script>