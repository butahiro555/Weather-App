<template>
  <NavBar />
  <div class="min-h-screen bg-neutral-800">
    <!-- タブコンテナを表示 -->
    <TabContainer />
  </div>
</template>

<script>
import NavBar from './components/NavBar.vue';
import TabContainer from './components/TabContainer.vue';

export default {
  name: 'App',
  components: {
    NavBar,
    TabContainer,
  },
};
</script>