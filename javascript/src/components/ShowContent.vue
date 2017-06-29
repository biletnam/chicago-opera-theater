<template>
<article id="show-content" class="column is-8">
  <b-tabs v-model="activeTab">
    <b-tab-item v-for="tab in tabs" :label="tab.title" :key="tab.title">
      <div class="content" v-html="tab.content"></div>
    </b-tab-item>
  </b-tabs>
</article>
</template>

<script>
export default {
  name: 'ShowContent',
  props: {
    tabs: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      activeTab: 0
    }
  },
  components: {

  }
}
</script>
