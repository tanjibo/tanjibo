var webpack=require('webpack');
var path = require('path');
var HtmlwebpackPlugin= require('html-webpack-plugin');
var commonsPlugin = new webpack.optimize.CommonsChunkPlugin('common.js');
var uglifyJsPlugin=webpack.optimize.UglifyJsPlugin;
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var ROOT_PATH = path.resolve(__dirname);
var APP_PATH =path.resolve(ROOT_PATH,'app');
var BUILD_PATH = path.resolve(ROOT_PATH,'build');
module.exports = {
	entry:APP_PATH,
	output:{
		path:BUILD_PATH,
		filename:'bundle.js',
	},
	module:{
	loaders:[
      {
        test: /\.js[x]?$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
        query: {
          presets: ['es2015', 'react']
        }
      },
    ]
},
	devServer:{
		historyApiFallback:true,
		hot:true,
		inline:true,
		progress:true
	},

	plugins:[
	  new HtmlwebpackPlugin({
	  	title:'hello world app'
	  })
	]
}
// module.exports = {
// 	entry: "./entry.js",
// 	output:{
// 		path:__dirname+'/build/',
// 		filename:'[name].js'
// 	},
// 	module:{
// 		loaders:[
// 		{"test":/\.css$/,loader:'style-loader!css-loader'},
// 		{"test":/\.less$/,loader:'style!css!less'},
// 		{'test':/\.(png|jpg)$/,loader:"url-loader?limit=400000"},
// 		{test: /\.js$/, loader: 'babel', exclude: '/node_modules/'}  //es6
// 		]
// 	},
// 	resolve:{
// 		extensions:['','.js','.jsx'],
// 	},

// 	plugins:[
// 		//给文件添加注释信息
// 	new webpack.BannerPlugin('this file is create by tanjibo'),
// 	commonsPlugin,
// 	new ExtractTextPlugin("[name].css"),
// 	//合并js
// 	new uglifyJsPlugin({
// 		compress:{
// 			warnings:false
// 		},
// 		output:{
// 			comments:false,
// 		}
// 	})
// 	]
// }