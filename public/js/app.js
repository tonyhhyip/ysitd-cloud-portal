webpackJsonp([0],[
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	var _reactDom = __webpack_require__(1);

	var _Form = __webpack_require__(2);

	var _Form2 = _interopRequireDefault(_Form);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	Array.prototype.slice.call(document.querySelectorAll('[data-form-element]')).forEach(function (ele) {
	  (0, _reactDom.render)(React.createElement(_Form2.default, { json: ele.getAttribute('data-form') }), ele);
	});

/***/ },
/* 1 */
/***/ function(module, exports) {

	module.exports = ReactDOM;

/***/ },
/* 2 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	var _react = __webpack_require__(3);

	var _classnames = __webpack_require__(4);

	var _classnames2 = _interopRequireDefault(_classnames);

	var _FormField = __webpack_require__(5);

	var _FormField2 = _interopRequireDefault(_FormField);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

	function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

	var Form = function (_Component) {
	  _inherits(Form, _Component);

	  function Form(props, context) {
	    _classCallCheck(this, Form);

	    var _this = _possibleConstructorReturn(this, (Form.__proto__ || Object.getPrototypeOf(Form)).call(this, props, context));

	    _this.state = {
	      load: false,
	      form: {}
	    };
	    return _this;
	  }

	  _createClass(Form, [{
	    key: 'render',
	    value: function render() {
	      if (!('json' in this.props)) {
	        return null;
	      }

	      var classes = (0, _classnames2.default)(this.props.className, 'loader', {
	        'loading-done': this.state.load
	      });

	      var element = [];
	      if (this.state.load) {
	        this.state.form.forEach(function (field) {
	          var ele = React.createElement(_FormField2.default, {
	            label: field.label,
	            value: field.value,
	            type: field.type
	          });
	          element.push(ele);
	        });
	      }

	      var props = Object.assign({}, this.props);
	      delete props.json;

	      return React.createElement(
	        'div',
	        _extends({ className: classes }, props),
	        React.createElement(
	          'div',
	          { className: 'loading' },
	          React.createElement(
	            'div',
	            { className: 'progress' },
	            React.createElement('div', { className: 'indeterminate' })
	          )
	        ),
	        React.createElement(
	          'div',
	          null,
	          element
	        )
	      );
	    }
	  }, {
	    key: 'componentDidMount',
	    value: function componentDidMount() {
	      var self = this;
	      $.getJSON('/json/' + this.props.json.replace('.', '/') + '.json').done(function (data) {
	        self.setState({
	          form: data,
	          load: true
	        });
	      });
	    }
	  }]);

	  return Form;
	}(_react.Component);

	exports.default = Form;

/***/ },
/* 3 */
/***/ function(module, exports) {

	module.exports = React;

/***/ },
/* 4 */
/***/ function(module, exports) {

	module.exports = classNames;

/***/ },
/* 5 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	  value: true
	});

	var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	var _react = __webpack_require__(3);

	var _classnames = __webpack_require__(4);

	var _classnames2 = _interopRequireDefault(_classnames);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

	function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

	var InputTypeMap = {
	  N: 'number',
	  integer: 'number'
	};

	var FormField = function (_Component) {
	  _inherits(FormField, _Component);

	  function FormField(props, context) {
	    _classCallCheck(this, FormField);

	    var _this = _possibleConstructorReturn(this, (FormField.__proto__ || Object.getPrototypeOf(FormField)).call(this, props, context));

	    _this.state = {
	      value: !!_this.props.value
	    };
	    return _this;
	  }

	  _createClass(FormField, [{
	    key: 'render',
	    value: function render() {
	      var id = this.props.label.replace(/\s+/, '_').toLowerCase();
	      var type = this.props.type in InputTypeMap ? InputTypeMap[this.props.type] : this.props.type;
	      var checkbox = type === 'boolean';
	      var classes = (0, _classnames2.default)(this.props.className, 'input-field col s12', {
	        'form-group-label': !checkbox,
	        'control-highlight': !!this.props.value
	      });

	      var method = void 0;
	      switch (type) {
	        case 'boolean':
	          method = 'Boolean';
	          break;
	        case 'enum':
	          method = 'Selection';
	          break;
	        case 'block':
	          method = 'Block';
	          break;
	        default:
	          method = 'Input';
	      }
	      method = 'render' + method;

	      return React.createElement(
	        'div',
	        _extends({ className: classes }, this.props),
	        this[method]({ id: id, type: type }, this.props)
	      );
	    }
	  }, {
	    key: 'renderBoolean',
	    value: function renderBoolean(_ref) {
	      var id = _ref.id;

	      return React.createElement(
	        'div',
	        { className: 'switch' },
	        React.createElement(
	          'label',
	          { htmlFor: id },
	          React.createElement('input', {
	            id: id,
	            name: id,
	            type: 'checkbox'
	          }),
	          React.createElement('span', { className: 'lever' }),
	          this.props.label
	        )
	      );
	    }
	  }, {
	    key: 'renderBlock',
	    value: function renderBlock(_ref2) {
	      var id = _ref2.id;

	      return React.createElement(
	        'div',
	        null,
	        React.createElement(
	          'label',
	          { htmlFor: id },
	          this.props.label
	        ),
	        React.createElement('textarea', { className: 'materialize-textarea', id: id, name: id, rows: '1' })
	      );
	    }
	  }, {
	    key: 'renderInput',
	    value: function renderInput(_ref3) {
	      var id = _ref3.id;
	      var type = _ref3.type;

	      return React.createElement(
	        'div',
	        null,
	        React.createElement('input', {
	          className: 'validate',
	          id: id,
	          type: type,
	          name: id,
	          required: this.props.required !== false
	        }),
	        React.createElement(
	          'label',
	          { htmlFor: id },
	          this.props.label
	        )
	      );
	    }
	  }, {
	    key: 'shouldComponentUpdate',
	    value: function shouldComponentUpdate() {
	      return false;
	    }
	  }]);

	  return FormField;
	}(_react.Component);

	exports.default = FormField;


	FormField.propTypes = {
	  label: _react.PropTypes.string
	};

	FormField.defaultProps = {
	  color: 'brand'
	};

/***/ }
]);