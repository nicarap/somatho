import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', () => {
    const name = ref("")

  return { count, name, doubleCount, increment }
})