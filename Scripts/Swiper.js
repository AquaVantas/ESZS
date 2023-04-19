console.log("samo povem");

var swiper = new Swiper('.highlight-news-swiper', {
    observer: true,
    observeParents: true,
    loop: true,
    autoplay: {
        delay: 10000,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});