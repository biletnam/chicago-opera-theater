import Vue from 'vue';
import Gallery from '~Vue/Gallery';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementsByClassName('gallery')) {
      const nodes = document.getElementsByClassName('gallery');

      Array.from(nodes).forEach((node) => {
        const images = [];

        Array.from(node.children).forEach((child) => {
          if (child.className && child.className.includes('gallery-item')) {
            let thumb = child.getElementsByTagName('img')[0],
              image = child.getElementsByTagName('a')[0];

            const imageObj = {
              thumb: thumb.src,
              url: image.href,
              alt: thumb.alt,
            };

            images.push(imageObj);
          }
        });

        new Vue({
          render: h => h(Gallery, {
            props: {
              id: node.id,
              images,
            },
          }),
        }).$mount(node);
      });
    }
  });
}());
