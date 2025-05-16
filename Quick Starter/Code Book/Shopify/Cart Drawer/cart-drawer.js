var drawer = function () {
  if (!Element.prototype.closest) {
    if (!Element.prototype.matches) {
      Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
    }
    Element.prototype.closest = function (s) {
      var el = this;
      var ancestor = this;
      if (!document.documentElement.contains(el)) return null;
      do {
        if (ancestor.matches(s)) return ancestor;
        ancestor = ancestor.parentElement;
      } while (ancestor !== null);
      return null;
    };
  }
  var settings = {
    speedOpen: 50,
    speedClose: 350,
    activeClass: 'is-active',
    visibleClass: 'is-visible',
    selectorTarget: '[data-drawer-target]',
    selectorTrigger: '[data-drawer-trigger]',
    selectorClose: '[data-drawer-close]',
  };
  var toggleccessibility = function (event) {
    if (event.getAttribute('aria-expanded') === 'true') {
      event.setAttribute('aria-expanded', false);
    } else {
      event.setAttribute('aria-expanded', true);
    }
  };
  var openDrawer = function (trigger) {
    var target = document.getElementById(trigger.getAttribute('aria-controls'));
    target.classList.add(settings.activeClass);
    document.documentElement.style.overflow = 'hidden';
    toggleccessibility(trigger);
    setTimeout(function () {
      target.classList.add(settings.visibleClass);
    }, settings.speedOpen);
  };
  var closeDrawer = function (event) {
    var closestParent = event.closest(settings.selectorTarget),
      childrenTrigger = document.querySelector('[aria-controls="' + closestParent.id + '"');
    closestParent.classList.remove(settings.visibleClass);
    document.documentElement.style.overflow = '';
    toggleccessibility(childrenTrigger);
    setTimeout(function () {
      closestParent.classList.remove(settings.activeClass);
    }, settings.speedClose);
  };
  var clickHandler = function (event) {
    var toggle = event.target,
      open = toggle.closest(settings.selectorTrigger),
      close = toggle.closest(settings.selectorClose);
    if (open) { openDrawer(open); }
    if (close) { closeDrawer(close); }
    if (open || close) { event.preventDefault(); }
  };
  var keydownHandler = function (event) {
    if (event.key === 'Escape' || event.keyCode === 27) {
      var drawers = document.querySelectorAll(settings.selectorTarget),
        i;
      for (i = 0; i < drawers.length; ++i) {
        if (drawers[i].classList.contains(settings.activeClass)) {
          closeDrawer(drawers[i]);
        }
      }
    }
  };
  document.addEventListener('click', clickHandler, false);
  document.addEventListener('keydown', keydownHandler, false);
};
drawer();

function openDrawer(){
let cartToggle = document.querySelector("a.cart-toggle");
if(cartToggle.getAttribute("aria-expanded") != "true"){
  cartToggle.click();
}
}

function drawerQuantityBox(){
function updateItemQuantity(lineKey, value) {
    if(lineKey && value){
      console.log(lineKey, value);
      fetch(window.Shopify.routes.root + 'cart/change.js', {
          method: 'POST',
          headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({
              'id': lineKey,
              'quantity': parseInt(value)
          })
      })
      .then(response => response.json())
      .then(data => {
          refreshCart(data);
      });
    }
}

let quantityFields = document.querySelectorAll(".cart-item");
quantityFields.forEach(function(quantityBox){
    let cartRemoveButton = quantityBox.querySelector("cart-remove-button");
  
    let quantiyfield = quantityBox.querySelector("input[type='number']");
    let quantiyPlus  = quantityBox.querySelector('button.quantity__button[name="plus"]');
    let quantiyMinus = quantityBox.querySelector('button.quantity__button[name="minus"]');

    quantiyPlus.addEventListener("click", function(){
        // Increase Item By 1
        quantiyfield.setAttribute("value", Number(quantiyfield.value) + 1);
        let itemKey = quantiyfield.closest('.cart-item').getAttribute("key");
        updateItemQuantity(itemKey, quantiyfield.value);
    })
    quantiyMinus.addEventListener("click", function(){
        // Decrease Item By 1
        quantiyfield.setAttribute("value", Number(quantiyfield.value) - 1);  
        let itemKey = quantiyfield.closest('.cart-item').getAttribute("key");
        updateItemQuantity(itemKey, quantiyfield.value);
    })  

    cartRemoveButton.addEventListener("click", function(){
        // Remove Item
        let itemKey = cartRemoveButton.closest('.cart-item').getAttribute("key");
        updateItemQuantity(itemKey, "0");
    })  

    quantiyfield.addEventListener("change", function(){
        // Update Item on change
        let itemKey = quantiyfield.closest('.cart-item').getAttribute("key");
        updateItemQuantity(itemKey, quantiyfield.value);
    })
})  
}

function refreshCart(response){
function renderCart(data){
  if(data.items.length > 0) {
      let cartContents = "";
      let cartFooter = '<div style="margin-top: 50px"><strong class="h5">Total: <span id="cart__total_price"></span></strong><div class="" style="margin-top: 20px"><a id="cart__checkout_btn" href="/checkout" class="btn btn--has-icon-after cart__continue-btn" style="width:100%;">Proceed Checkout</a></div></div>';
      data.items.forEach(function(product, index) {
        // console.log({product});
        let qunatityField = '<div class="cart-item__quantity-wrapper"><quantity-input class="quantity"><button class="quantity__button no-js-hidden" name="minus" type="button"><span class="visually-hidden">Reduce item quantity by one</span>&#45;</button><input class="quantity__input" type="number" name="updates[]" value="' + product.quantity + '" min="0" aria-label="Increase item quantity by one" id="Quantity-'+index+'" data-index="'+index+'"><button class="quantity__button no-js-hidden" name="plus" type="button"><span class="visually-hidden">Add item quantity by one</span>&#43;</button></quantity-input><cart-remove-button id="Remove-'+index+'" data-index="'+index+'"><svg fill="red" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 16 16" width="18" height="18"><path d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.324219 3.675781 14 4.5 14 L 10.5 14 C 11.324219 14 12 13.324219 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 4 4 L 11 4 L 11 12.5 C 11 12.78125 10.78125 13 10.5 13 L 4.5 13 C 4.21875 13 4 12.78125 4 12.5 Z M 5 5 L 5 12 L 6 12 L 6 5 Z M 7 5 L 7 12 L 8 12 L 8 5 Z M 9 5 L 9 12 L 10 12 L 10 5 Z"/></svg></cart-remove-button></div>';
        cartContents += '<div class="cart-item" key="'+product.key+'" line-index="'+index+'" id="'+product.id+'"><img width="50" height="50" src="' + product.featured_image.url + '" alt="' + product.featured_image.alt + '"><div class="cart-item-info"><div class="cart-item-summary-wrapper"><strong>' + product.title + '</strong><div class="cart-item-summary">' + qunatityField +'</div></div><div class="cart-item-total"><strong>'+ Shopify.formatMoney(product.final_price, theme.moneyFormat) +'</strong></div></div></div>';
        document.getElementById('cart__drawer_items').innerHTML = cartContents;
        document.getElementById('cart__drawer_footer').innerHTML = cartFooter;
        let cartToggle = document.querySelector("a.cart-toggle");
        cartToggle.querySelector("span[data-cart-count-bubble] span[data-cart-count]").innerText = data.item_count;
      });
  } else {
    document.getElementById('cart__drawer_items').innerHTML = '<div class="empty-cart text-center"><h3><strong>Cart is Empty</strong></h3><a href="/collections/all" class="btn btn-small">Continue Shopping</a></div>';
    document.getElementById('cart__drawer_footer').innerHTML = '';

    document.getElementById('cart__checkout_btn').setAttribute('disabled', 'disabled');
    document.getElementById('cart__checkout_btn').style.pointerEvents = 'none';
  }
  document.getElementById('cart__total_price').innerHTML = Shopify.formatMoney(data.total_price, theme.moneyFormat) ;
}

if(response){
  data = response;
  renderCart(data);
  drawerQuantityBox();
}
if(!response){
  fetch('/cart.js')
  .then((resp) => resp.json())
  .then((data) => {
    renderCart(data);
    // console.log(data);
    drawerQuantityBox();
  });  
}
}

function addToCart(trigger, productVariantID, productQuantity){
var addData = {
  'id': productVariantID, /* for testing, change this to a variant ID on your store */
  'quantity': productQuantity
};

trigger.value = "Adding..";
trigger.setAttribute("disabled", "disabled");


fetch('/cart/add.js', {
  body: JSON.stringify(addData),
  credentials: 'same-origin',
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With':'xmlhttprequest' /* XMLHttpRequest is ok too, it's case insensitive */
  },
  method: 'POST'
}).then(function(response) {
  trigger.value = "Added to Cart";

  setTimeout(function(){
    trigger.value = "Add to Cart";
     trigger.removeAttribute("disabled");
  }, 2000);
 
  refreshCart();
  openDrawer()
  return response.json();
}).then(function(json) {
  /* we have JSON */
  console.log(json)
}).catch(function(err) {
  /* uh oh, we have error. */
  console.error(err)
});
};

document.addEventListener("DOMContentLoaded", function(){
let AddToCartForm = document.querySelector("form#AddToCartForm");
if(AddToCartForm){
  AddToCartForm.addEventListener("submit", function(e){
      let ctaBtn = AddToCartForm.querySelector("input[type='submit']");
      let variantId = AddToCartForm.querySelector("select[name='id']").value;
      let quantity = AddToCartForm.querySelector("input[name='quantity']").value;
      e.preventDefault();
      addToCart(ctaBtn, variantId, quantity);
  })
}
  
let allProductGridForm = document.querySelectorAll(".product-grid form.product-grid-form");
allProductGridForm.forEach(function(productGridForm){
    let productGridFormBtn = productGridForm.querySelector("input[type='submit']");    
    productGridForm.addEventListener("submit", function(e){
      e.preventDefault();
        let ctaBtn = productGridForm.querySelector("input[type='submit']");
        let productVariantID = productGridForm.querySelector('input[name="id"]').value;
        let productQuantity = productGridForm.querySelector('input[name="quantity"]').value;
        console.log({productQuantity, productVariantID});
        addToCart(ctaBtn, productVariantID, productQuantity);
    })
})
})
refreshCart();