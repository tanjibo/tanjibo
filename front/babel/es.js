'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

require('babel-polyfill');

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

require("babel-register");

var double = function double(n) {
	return n * n;
};

function addAll() {
	return Array.from(arguments).reduce(function (a, b) {
		return a + b;
	});
}

var Animal = function () {
	function Animal(name) {
		_classCallCheck(this, Animal);

		this.name = name;
	}

	_createClass(Animal, [{
		key: 'speak',
		value: function speak() {
			console.log(this.name);
		}
	}]);

	return Animal;
}();

var animal = new Animal('animal');
animal.speak();
