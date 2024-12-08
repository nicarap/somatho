module.exports = {
    root: true,
    env: {
        node: true,
    },
    extends: [
        'plugin:vue/vue3-recommended',
        '@vue/eslint-config-prettier'
    ],
    rules: {
        'vue/multi-word-component-names': 'off',
    },
};
