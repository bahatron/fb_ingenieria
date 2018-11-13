module.exports = {
    chainWebpack: (config) => {
        // css-loader
        // config.module
        //     .rule('graphql')
        //     .test(/\.graphql$/)
        //     .use('graphql-tag/loader')
        //     .loader('graphql-tag/loader')
        //     .end();

        config.module
            .rule('css-loader')
            .test(/\.s[a|c]ss$/)
            .use('style!css!sass')
            .loader('style!css!sass')
            .options({ modules: true });
    },
};
