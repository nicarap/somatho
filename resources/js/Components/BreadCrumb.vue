<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <div class="flex w-full justify-between items-start">
    <div class="text-primary flex gap-2 items-center">
      <template v-for="(item, index) in items">
        <h1 class="text-2xl uppercase font-semibold">
            <template v-if="item.url">
                <Link class="hover:underline" :href="item.url">
                    {{ item.label }}
                </Link>
            </template>
            <template v-else>
                {{ item.label }}
            </template>
        </h1>
        <template v-if="index !== items.length - 1"> / </template>
      </template>
    </div>
    <slot />
  </div>
</template>
