import Swiper from 'swiper';

export default class VerticalSlider {
  init = () => {
    const element = document.querySelector('.steps');

    if (element !== null) {
      const mySwiper = new Swiper(element, {
        direction: 'vertical',
        slidesPerView: 1,
        loop: false,
        mousewheel: true,
      });
    }
  }
}
