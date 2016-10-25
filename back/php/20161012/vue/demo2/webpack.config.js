var webpack = require('webpack');
var commonsPlugin = new webpack.optimize.CommonsChunkPlugin('./build/common.js');
var ExtractTextPlugin = require("extract-text-webpack-plugin");


module.exports = {
    entry: {
        p1: './src/main1.js',
        p2: './src/main2.js'
    },
    output: {
        filename: './build/[name].js',
    },
    module: {
        //加载器配置
        loaders: [
            //.css 文件使用 style-loader 和 css-loader 来处理
             {test: /\.css$/, loader: ExtractTextPlugin.extract("style", "css")},
            //.js 文件使用 jsx-loader 来编译处理
            //{ test: /\.js$/, loader: 'jsx-loader?harmony' },
            //.scss 文件使用 style-loader、css-loader 和 sass-loader 来编译处理
           { test: /\.scss$/, loader: 'style!css!sass'},
           { test: /\.less$/i,loader: ExtractTextPlugin.extract("style-loader", "css-loader!less-loader")},
            //图片文件使用 url-loader 来处理，小于8kb的直接转为base64
            { test: /\.(png|jpg)$/, loader: 'url-loader?limit=8192'}
        ]
    },
    plugins: [
        commonsPlugin,
        new ExtractTextPlugin("./build/[name].css",{allChunks:true}),
       
    ]
}
