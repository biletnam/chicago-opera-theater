<template>
<div class="gallery">
  <div class="swiper-container swiper-gallery">
    <div class="swiper-wrapper">
      <div v-for="image in images" class="swiper-slide">
        <img :data-src="image.url" :alt="image.alt" class="swiper-lazy" />
        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
      </div>
    </div>
    <div class="swiper-pagination swiper-pagination-white"></div>
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
  </div>
  <div class="swiper-container gallery-thumbs">
    <div class="swiper-wrapper">
      <div v-for="image in images" class="swiper-slide" :style="backgroundImage(image)"></div>
    </div>
  </div>
</div>
</template>

<script>
const Swiper = require('swiper/dist/js/swiper');
export default {
  name: 'Gallery',
  props: {
    images: Array,
    id: String
  },
  methods: {
    backgroundImage(image) {
      return {
        'background-image': `url(${image.thumb})`
      }
    }
  },
  mounted() {
    const galleryTop = new Swiper('.swiper-gallery', {
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
      pagination: '.swiper-pagination',
      paginationClickable: true,
      preloadImages: false,
      lazyLoading: true
    });

    const galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
      centeredSlides: true,
      slidesPerView: 'auto',
      touchRatio: 0.2,
      slideToClickedSlide: true
    });

    galleryTop.params.control = galleryThumbs;
    galleryThumbs.params.control = galleryTop;
  }
}
</script>

<style lang="scss" scoped>@import '~variables';
.gallery {
    height: 750px;
    @include mobile {
        height: 500px;
    }

    .swiper-gallery {
        &.swiper-container {
            width: 100%;
            height: 80%;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #000;
            @include mobile {
                min-height: 400px;
            }
        }
        .swiper-slide img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 100%;
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            position: absolute;
            left: 50%;
            top: 50%;
        }
    }

    .gallery-thumbs {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;

        .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
            background-size: cover;
            background-position: center;
            @include mobile {
                min-height: 100px;
            }

            &.swiper-slide-active {
                opacity: 1;
            }
        }
    }
}
</style>
