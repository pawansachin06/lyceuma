import './bootstrap';



// import Swiper from '../../node_modules/swiper/swiper-bundle';

import {Swiper} from 'swiper';
import { Navigation } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', function() {
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        slidesPerView: 1,
        modules: [Navigation],
        
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});


