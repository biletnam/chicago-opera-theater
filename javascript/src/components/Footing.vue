<template>
<footer id="footer" class="footer" role="contentinfo">
  <div class="container is-fluid">
    <div class="columns">
      <div class="column is-5">
        <img :src="image" alt="Chicago Opera Theater Logo" />
      </div>
      <div class="column is-4">
        <h4>Follow Us</h4>
        <a href="https://www.facebook.com/ChicagoOperaTheater" target="_blank" title="Facebook Link">
          <b-icon pack="fa" icon="facebook-square" type="is-white is-medium">
          </b-icon>
        </a>
        <a href="https://twitter.com/chicagoopera" target="_blank" title="Twitter Link">
          <b-icon pack="fa" icon="twitter-square" type="is-white is-medium">
          </b-icon>
        </a>
        <a href="https://www.youtube.com/user/CHICAGOOPERATHEATER" target="_blank" title="Youtube Link">
          <b-icon pack="fa" icon="youtube-square" type="is-white is-medium">
          </b-icon>
        </a>
        <a href="https://www.instagram.com/chicagooperatheater/" target="_blank" title="Instagram Link">
          <b-icon pack="fa" icon="instagram" type="is-white is-medium">
          </b-icon>
        </a>
      </div>
      <div class="column" id="footer-links">
        <h4>Important Links</h4>
        <ul>
          <template v-for="link in links">
            <li>
              <a :href="link.url">{{link.title}}</a>
            </li>
</template>
        </ul>
      </div>
    </div>
  </div>
  <div class="container is-fluid">
    <p class="add-margin-top-lg">
      70 E. Lake Street Suite 415 • Chicago, IL 60601
    </p>
    <p class="add-margin-top-sm">
      Box Office: 312.704.8414 • Administrative: 312.704.8420 • E-Mail: info@cot.org
    </p>
  </div>
</footer>
</template>

<script>
export default {
  name: 'Footing',
  props: {
    links: {
      type: Array,
      required: true
    },
    image: {
      type: String,
      required: true
    }
  },
  data() {
    return {

    }
  }
}
</script>

<style lang="scss" scoped>@import '~variables';

#footer {
    background: $footer-background;
    border-top: 4px solid $primary-color;
    color: white;

    #footer-links {
        li {
            padding: 4px 0;
        }
        a:hover {
            color: lighten($primary-color, 10);
        }
    }
}
</style>
