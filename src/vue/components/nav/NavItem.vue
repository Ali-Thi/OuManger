<script>
export default {
  emits: ['event'],
  methods: {
    created(){
      this.$emit('event', this.text)
    }
  },
  props: {
    text: String,
  },
};
</script>

<template>
    <button @click="created" class="
    text-sm uppercase font-semibold w-full inline-block px-6 py-2.5
    font-medium text-xs leading-tight rounded shadow-sm
    hover:shadow-lg hover:text-rose-600
    focus:shadow-lg focus:outline-none focus:ring-0
    active:shadow-2xl transition duration-150 ease-in-out">
      {{ text }}
    </button>
</template>
