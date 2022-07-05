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