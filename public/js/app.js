const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    autoplay: {
        delay: 5000,
    }
});

const notification = document.querySelector('.notification');

let cartTotalCount = ~~(notification.innerHTML);
if (cartTotalCount !== 0) {
  notification.style.display = 'block';
}

const cards = document.querySelectorAll('.card');

cards.forEach(el => {
  el.addEventListener('click', () => {
    let link = el.querySelector('a');
    let path = link.getAttribute('href');
    window.location.replace(path);
  });
});

const search = document.querySelector('#search');
const resultsContainer = document.querySelector('.search-results');
const results = document.querySelectorAll('.search-results-line');

results.forEach(el => {
  el.addEventListener('click', () => {
    window.location.replace('/product/' + el.getAttribute('data-id'));
  });
});

search.addEventListener('input', () => {
  if (search.value.trim() !== '' && search.value.length > 1) {
    results.forEach(result => {
      let position = result.innerHTML.toLowerCase().indexOf(search.value.toLowerCase());
      if (position !== -1) {
        resultsContainer.style.display = 'block';
        result.style.display = 'block';
      } else {
        result.style.display = 'none';
      }
    });
  } else {
    resultsContainer.style.display = 'none';
  }
});

const cartButton = document.querySelector('.cart-button');
const cartCount = document.querySelector('.input-number');

if (cartButton) {
  cartButton.addEventListener('click', () => {
    if (!cartButton.classList.contains('added-to-cart')) {
      let id = cartButton.getAttribute('data-id');
      let count = cartCount.value;
      fetch('/api/cart/add', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          id: id,
          count: count
        })
      }).then((res) => {
        console.log(res);
        cartButton.classList.add('added-to-cart');
        cartCount.setAttribute('disabled', 'disabled');
        cartButton.innerHTML = 'Добавлено в корзину';
        cartTotalCount++;
        notification.innerHTML = cartTotalCount;
        if (cartTotalCount === 1) {
          notification.style.display = 'block';
        }
      }).catch((res) => {
        console.log(res);
      });
    } else {
      return false;
    }
  });
}

const deleteFromCartButtons = document.querySelectorAll('.delete-from-cart');
if (deleteFromCartButtons.length > 0) {
  deleteFromCartButtons.forEach(button => {
    button.addEventListener('click', () => {
      let id = button.getAttribute('data-id');
      fetch('/api/cart/delete', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({id: id})
      })
      .then(response => {
        let block = document.querySelector('[data-cart-id="' + id + '"]');
        block.remove();
        cartTotalCount--;
        notification.innerHTML = cartTotalCount;
        if (cartTotalCount === 0) {
          notification.style.display = 'none';
        }
      })
      .catch((error) => {
        console.log(error);
      });
    });
  });
}
