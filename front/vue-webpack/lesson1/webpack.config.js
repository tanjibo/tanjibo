var path=require('path');

module.exports={
  entry:{
  	'bundle':path.resolve(__dirname,'main.js'),


  },
  output:{
  	filename:'[name].js'
  },
  module:{
  	loaders:[
  	{
  		test:/\.js?$/,
  		exclude:/node_modules/,
  		loader:'babel',
  		query:{
  			presets:['es2015','react','stage-0']
  		},
  		//loader:'babel-loader?presets[]=es2015&presets[]=react'
  	},
    {
      test:/\.css$/,loader:'style!css'
    }
  	]
  }

}