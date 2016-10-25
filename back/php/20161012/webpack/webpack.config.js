var path=require('path');  //引入nodejs path 模块
var webpack=require('webpack');
 var ExtractTextPlugin = require("extract-text-webpack-plugin");
 var cssExtractor=new ExtractTextPlugin('./[name].css');
module.exports = {
  entry: './entry.js',
  output: {
  	path:path.resolve(__dirname,'build'),
    filename: '[name].js'
  },
  module:{
  	loaders:[
  	  {test:/\.css$/, loader: ExtractTextPlugin.extract("style-loader", "css-loader")},
  	  {test:/\.(png|jpg)$/,loader:'url-loader?limit=8192'},
       {test: /\.scss$/, loader: "style!css!sass"},
      {test: /\.less$/, loader: "style!css!less"},
  	  {test:/\.jsx?$/,loader:'babel',exclude:'./node_modules',query:{presets:['es2015']}},
  	]
  },
  resolve:{
    extensions:['','.js','.json'],
  },

  devServer:{
    historyApiFallback:true,
    hot:true,
    inline:true,
    progress:true
  },
  plugins:[
   cssExtractor,
  ]
};