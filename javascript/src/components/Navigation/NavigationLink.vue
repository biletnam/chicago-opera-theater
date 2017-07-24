<template>
<b-dropdown :position="position" :class="{'nav-item': true, 'is-active': active}">
  <a class="link-title" slot="trigger">{{link.title}}</a>
  <template v-for="child in link.children">
  <b-dropdown-option :key="child.id" has-link>
    <a :href="child.url">{{child.title}}</a>
  </b-dropdown-option>
  <b-dropdown-option separator />

</template>
</b-dropdown>
</template>

<script>
export default {
  name: 'NavigationLink',
  props: {
    link: {
      type: Object,
      required: true,
    },
    index: {}
  },
  data() {
    let position = 'is-bottom-right';
    if (this.index > 2) {
      position = 'is-bottom-left';
    }
    return {
      active: false,
      position
    }
  },
  methods: {
    childActive() {
      this.link.children.forEach(child => {
        if (window.location.href === child.url) {
          this.active = true;
        }
      });
    }
  },
  mounted() {
    this.childActive();
  }
}

</script>
