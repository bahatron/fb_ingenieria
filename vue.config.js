const path = require("path");

module.exports = {
    chainWebpack: (config) => {
        config.module
            .rule("css-loader")
            .test(/\.s[a|c]ss$/)
            .use("style!css!sass")
            .loader("style!css!sass")
            .options({ modules: true });
    },

    baseUrl: "./",

    configureWebpack: {
        entry: "./js/spa/main.js",
        entry: "./src/spa/main.ts",
        resolve: {
            alias: {
                "@@": path.resolve(__dirname, "src/domain/"),
            },
        },
    },

    assetsDir: "./src/spa/assets",
};
