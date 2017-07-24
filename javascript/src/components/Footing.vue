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
          <b-icon icon="facebook-square" type="is-white is-medium">
          </b-icon>
        </a>
        <a href="https://twitter.com/chicagoopera" target="_blank" title="Twitter Link">
          <b-icon icon="twitter-square" type="is-white is-medium">
          </b-icon>
        </a>
        <a href="https://www.youtube.com/user/CHICAGOOPERATHEATER" target="_blank" title="Youtube Link">
          <b-icon icon="youtube-square" type="is-white is-medium">
          </b-icon>
        </a>
        <a href="https://www.instagram.com/chicagooperatheater/" target="_blank" title="Instagram Link">
          <b-icon icon="instagram" type="is-white is-medium">
          </b-icon>
        </a>
      </div>
      <div class="column" id="footer-links">
        <h4>Important Links</h4>
        <ul>
          <li v-for="link in links">
            <a :href="link.url">{{link.title}}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container is-fluid">
    <div class="columns">
      <div class="column is-5">
        <p class="has-margin-top-lg">
          Administrative Offices<br /> 70 E Lake St<br /> Ste 415<br /> Chicago IL 60601<br />
        </p>
      </div>
      <div class="column is-4">
        <p class="has-margin-top-lg">
          The Studebaker Theater<br /> Located in The Fine Arts Building<br /> 410 S Michigan Ave<br /> Chicago IL 60605
        </p>
      </div>
      <div class="column">
        <p class="has-margin-top-lg">
          info@cot.org<br /> (312) 704-8414
        </p>
      </div>
    </div>
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
