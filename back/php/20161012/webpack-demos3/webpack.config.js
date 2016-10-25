var path = require('path');
var HtmlWebpackPlugin = require('html-webpack-plugin');
//自动打开浏览器
var openBrowserWebpackPlugin = require('open-browser-webpack-plugin');

//重写url
function rewriteUrl(replacePath) {
    return function(req, opt) {
        //取得?所在的索引
        var queryIndex = req.url.indexOf('?');
        //取得查询字符串的内容
        var query = queryIndex >= 0 ? req.url.substr(queryIndex) : "";
        //$1取自path匹配到的真实路径中的第一个分组
        //把proxy的path替换为 '/$1\.json',
        req.url = req.path.replace(opt.path, replacePath) + query;
    };
}
module.exports = {
    //打包的入口文件  String|Object
    entry: path.resolve(__dirname, 'src/index.js'),
    output: { //配置打包结果     Object
        //定义输出文件路径
        path: path.resolve(__dirname, 'build'),
        //指定打包文件名称
        filename: 'bundle.js'
    },
    //定义了对模块的处理逻辑     Object
    module: {
        loaders: [ //定义了一系列的加载器   Array
            {
                test: /\.js$/, //正则，匹配到的文件后缀名
                // loader/loaders：string|array，处理匹配到的文件
                loader: 'babel-loader'
                    // include：String|Array  包含的文件夹
                    // exclude：String|Array  排除的文件夹

            }, {
                test: /\.less/,
                loader: 'style!css!less'
            }, {
                test: /\.css/,
                loader: 'style!css'
            }, {
                test: /\.(woff|woff2|ttf|svg|eot)$/,
                loader: "url?limit=8192"
            }, {
                test: /\.(jpg|png)$/,
                loader: "url?limit=8192"
            },
           {
                test: /jquery.js$/,
                loader: "expose?jQuery"
            }
        ],
        //如果你 确定一个模块中没有其它新的依赖 就可以配置这项，webpack 将不再扫描这个文件中的依赖
        noParse: [path.join(__dirname, "./node_modules/jquery/dist/jquery.js")]
    },
    //指定extension之后可以不用在require或是import的时候加文件扩展名,会依次尝试添加扩展名进行匹配
    resolve: {
        //自动补全后缀，注意第一个必须是空字符串,后缀一定以点开头
        extensions: ["", ".js", ".css", ".json"],
        alias: { 'jquery': path.join(__dirname, "./node_modules/jquery/dist/jquery.js") }
    },
    devServer: {
        stats: { colors: true }, //显示颜色
        port: 8080, //端口
        contentBase: 'build', //指定静态文件的根目录
        inline:true, //设置自动刷新
        //         proxy: [
        //    {
        //          //替换符合此正则的接口路径
        //         path: /^\/api\/(.*)/,
        //          //目标域名端口
        //         target: "http://localhost:8080/",
        //          //重新定向到新的地址
        //          //$1取自path正则匹配到的真实路径的第一个分组
        //        rewrite: rewriteUrl('/$1\.json'),
        //           //修改来源地址
        //         changeOrigin: true
        //    }
        // ]
    },
    plugins: [
        new HtmlWebpackPlugin({
          title: 'zhufeng-react',//标题
          template: './src/index.html', //模板文件
          filename:'./index.html' //产出后的文件名称
       }),
       new openBrowserWebpackPlugin({ url: 'http://localhost:8080' })

  ]

}
