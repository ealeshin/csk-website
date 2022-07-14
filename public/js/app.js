

const swiper = new Swiper('.swiper', {
  direction: 'horizontal',
  loop: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  autoplay: {
      delay: 5000,
  }
});

const formatPrice = (value) => {
  let result = Number(value).toFixed(2);
  return result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ").replace('.', ','); 
};

const calculateCartResult = () => {
  let result = 0;
  const resultHolder = document.querySelector('.result');
  const sumHolders = document.querySelectorAll('.sum');
  const cartResultBlock = document.querySelector('.cart-result');
  const emptyCartMessage = document.querySelector('.empty-cart-message');

  sumHolders.forEach(sumHolder => {
    result += ~~(sumHolder.innerHTML.trim().replace(' ', '').replace(',', '.'));
  });
  if (result == 0) {
    cartResultBlock.style.display = 'none';
    emptyCartMessage.style.display = 'block';
  } else {
    resultHolder.innerHTML = formatPrice(result);
  }
};

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

let count = 0;
let limit = 10;

search.addEventListener('input', () => {
  if (search.value.trim() !== '' && search.value.length > 1) {
    results.forEach(result => {
      let position = result.innerHTML.toLowerCase().indexOf(search.value.toLowerCase());
      if (position !== -1) {
        count++;
        if (count <= limit) {
          resultsContainer.style.display = 'block';
          result.style.display = 'block';
        }
      } else {
        result.style.display = 'none';
      }
    });
  } else {
    count = 0;
    resultsContainer.style.display = 'none';
  }
});

search.addEventListener('keyup', (event) => {
  let query = search.value.trim();
  if (query.length > 1 && event.key == 'Enter') {
    window.location.replace('/search/' + query);
  }
});

const cartButton = document.querySelector('.cart-button');
const cartCount = document.querySelector('.input-number');

if (cartButton) {
  let countOldValue, countCursor;

  const countKeydownHandler = (event) => {
    let el = event.target;
    countOldValue = el.value;
    countCursor = el.selectionEnd;
  };

  const countInputHandler = (event) => {
    let el = event.target;
        newValue = el.value;

    el.value = newValue.match(/^\d+$/) || newValue === "" ? newValue : countOldValue;
  };

  cartCount.addEventListener('keydown', countKeydownHandler);
  cartCount.addEventListener('input', countInputHandler);

  cartButton.addEventListener('click', () => {
    let id = cartButton.getAttribute('data-id');
    let count = parseInt(cartCount.value);
    if (!cartButton.classList.contains('added-to-cart') && count > 0) {
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
        calculateCartResult();
      })
      .catch((error) => {
        console.log(error);
      });
    });
  });
}

const orderButton = document.querySelector('.order-button');
const modal = document.querySelector('.shield');
const orderForm = document.querySelector('.modal-form');
const questionForm = document.querySelector('.modal-question');
const orderFormSuccess = document.querySelector('.modal-success');
const sendButton = document.querySelector('.send-order');
const reload = document.querySelector('.reload');
const questionLink = document.querySelector('.question-link');

questionLink.addEventListener('click', () => {
  questionForm.style.display = 'flex';
  modal.style.display = 'flex';
});

if (reload) {
  reload.addEventListener('click', () => {
    window.location.reload();
  });
}

if (orderButton) {
  orderButton.addEventListener('click', () => {
    modal.style.display = 'flex';
    orderForm.style.display = 'flex';
  });
}

if (sendButton) {
  sendButton.addEventListener('click', () => {
    let name = document.querySelector('#order_name');
    let phone = document.querySelector('#order_phone');
    let email = document.querySelector('#order_email');
    if (phone.value.trim() == '' && email.value.trim() == '') {
      alert('Введите телефон или E-mail, чтобы мы могли связаться с вами');
    } else {
      fetch('/api/order', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          name: name.value.trim(),
          phone: phone.value.trim(),
          email: email.value.trim()
        })
      })
      .then(response => {
        orderForm.style.display = 'none';
        orderFormSuccess.style.display = 'flex';
      })
      .catch((error) => {
        console.log(error);
      });
    }
  });
}

if (modal) {
  modal.addEventListener('click', (event) => {
    event.stopPropagation();
    let cl = event.target.classList;
    if (cl.contains('shield') || cl.contains('modal-close')) {
      modal.style.display = 'none';
      orderForm.style.display = 'none';
      questionForm.style.display = 'none';
    }
  });
}
