var  path =require('path');
var pageDir=path.resolve(__dirname,'src/pages');
module.exports={
	//打包入口文件,entry 可以是字符串，也可以是数组
	//entry:path.resolve(__dirname,'src/index.js'),
  entry:require('./webpack-config/entry-config.js'),
	output:{
		//定义输出文件路径
		path:path.resolve(__dirname,'build'),
		//指定打包文件名称
		filename:'[name]/bundle.js'
	},
	   module: {
        loaders: [// 定义了一系列的加载器   Array
            {
                test: /\.js$/, //正则，匹配到的文件后缀名
               // loader/loaders：string|array，处理匹配到的文件
                loader: 'babel-loader'
                // include：String|Array  包含的文件夹
                 // exclude：String|Array  排除的文件夹

            }
        ]
   },
      devServer: {
        stats: { colors: true }, //显示颜色
        port: 8080,//端口
        contentBase: 'build',//指定静态文件的根目录
    },

}