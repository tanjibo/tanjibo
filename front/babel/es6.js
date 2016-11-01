require("babel-register");
import 'babel-polyfill';
const double = n =>n*n;

function addAll() {
  return Array.from(arguments).reduce((a, b) => a + b);
}
/**
 * 数组合并
 * @type {Array}
 */
const array1=[1,2,3];
const array2=[2,3,4];
const array3=[4,5,6];
console.log([...array1,...array2,array3])


/**
 * 获取多个参数
 * @param  {[type]}    bb     [description]
 * @param  {...[type]} params [description]
 * @return {[type]}           [description]
 */
function aa(bb,...params){
	console.log(bb)
	console.log(params)
}

aa('dddd','333','dfsfsd')


/**
 * 函数传递参数默认值
 * @param  {Number} x [description]
 * @param  {Number} y [description]
 * @param  {Number} b [description]
 * @return {[type]}   [description]
 */
function aa(x=1,y=2,b=3){
	 console.log(x,y,b);
}
aa();
aa(3,4)
/**
 * 深度匹配
 */
function setttings(){
	return {display:{color:'red'},keyboard:{layout:'dddd'}};
}
const {display:{color:red}}=setttings();
console.log(red)


const array=[1,2,3,4];
var [firt,aa,bb]=array;
console.log(firt,aa,bb);

//es5 
// var是函数作用域。它在整个函数中是可用的，甚至在被声明之前。
// 声明被提升。因此，您可以在一个变量被声明之前使用它。
// 初始化 不 提升。如果你使用var ，请总是在顶部声明你的变量。
// 应用提升规则后我们可以更好地了解发生了什么：
// if 代码块没有被执行，第5行中的表达式var x也是被提升的
var x='outer';
function test(inner){
	if(inner){
		var x='inner';
		return x;
	}
	return x;
}
console.log(test(false),test(true))  //undefine inner
//es6 拯救
let x='outer';
function test(inner){
	if(inner){
		let x='inner';
		return x;
	}
	return x;
}


//模板字面量(Template Literals)
const first='a';
const se='b';
console.log(`${first},dfsdfsddfsd,${se}`)


//多行字符串
const tmpl=` <div class="showForm showBaseInfoForm">
                <button class="btn_blue" onclick="showEditForm(this)">修改</button>
            </div>`;
console.log(tmpl);

class Animal{
	constructor(name){
      this.name=name;
	}
	speak(){
		console.log(this.name);
	}
}
var animal=new Animal('animal');
animal.speak();