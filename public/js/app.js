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
