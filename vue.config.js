module.exports = {
    chainWebpack: (config) => {
        config.module
            .rule("css-loader")
            .test(/\.s[a|c]ss$/)
            .use("style!css!sass")
            .loader("style!css!sass")
            .options({ modules: true });
    },

    configureWebpack: {
        entry: "./src/spa/main.ts",
    },

    assetsDir: "./src/spa/assets",
};
