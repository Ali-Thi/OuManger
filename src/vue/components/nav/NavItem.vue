<script>
export default {
  props: {
    text: String,
    modal: Object,
    // lien: String,
  },
};
</script>

<template>
  <a href="{{lien}}">
    <button
      class="
        text-sm
        uppercase
        font-semibold
        w-full
        hover:text-rose-600
        inline-block
        px-6
        py-2.5
        font-medium
        text-xs
        leading-tight
        rounded
        shadow-md
        hover:shadow-lg
        focus:shadow-lg focus:outline-none focus:ring-0
        active:shadow-lg
        transition
        duration-150
        ease-in-out
      "
    >
      {{ text }}
    </button>
  </a>
</template>
