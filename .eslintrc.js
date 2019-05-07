module.exports = {
    root: true,
    env: {
        node: true,
    },
    extends: ["plugin:vue/essential", "@vue/airbnb", "@vue/typescript"],
    rules: {
        indent: ["error", 4],
        "no-console": process.env.NODE_ENV === "production" ? "error" : "off",
        "no-debugger": process.env.NODE_ENV === "production" ? "error" : "off",
        "import/extensions": "warning",
        "import/no-unresolved": "warning",
        "no-shadow": "off",
        "no-param-reassign": ["error", { props: false }],
        "import/prefer-default-export": "off",
        quotes: ["warn", "double"],
        "import/named": ["warn"],
        "max-len": ["warn"],
        "no-restricted-globals": ["off"],
        "no-alert": ["off"],
    },
    parserOptions: {
        parser: "typescript-eslint-parser",
    },
};
