<template>
  <button
    class="mt-10 px-4 py-2 border rounded"
    :class="isActive ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'"
    @click="select"
  >
    {{ name }}
  </button>
</template>

<script>
export default {
  props: {
    name: String, // 都市名
    isActive: Boolean, // アクティブ状態かどうか
  },
  methods: {
    select() {
      this.$emit("select", this.name); // 親コンポーネントに選択を通知
    },
  },
};
</script>