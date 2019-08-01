(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

var _MediaUploader = _interopRequireDefault(require("./components/admin/MediaUploader"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mu = new _MediaUploader.default();
mu.init();

},{"./components/admin/MediaUploader":2}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var MediaUploader =
/*#__PURE__*/
function () {
  /**
   * The MediaUploader constructor.
   */
  function MediaUploader() {
    _classCallCheck(this, MediaUploader);

    this.uploadField = document.getElementById('wpsm-upload-id');
    this.uploadThumb = document.getElementById('wpsm-upload-wrapper');
    this.uploads = [];
    this.insertObject = this.insertObject.bind(this);
    this.deleteObject = this.deleteObject.bind(this);
    this.openModal = this.openModal.bind(this);
    this.handleEvents = this.handleEvents.bind(this);
  }
  /**
   * Method to get the value of a field object.
   *
   * @param {Object} obj - The field object.
   *
   * @returns {string} - The field object's value.
   */


  _createClass(MediaUploader, [{
    key: "getValue",
    value: function getValue(obj) {
      return obj.value;
    }
    /**
     * Method to get an object's length.
     *
     * @param {Object} obj - The object.
     *
     * @returns {*} - The object's length.
     */

  }, {
    key: "getLength",
    value: function getLength(obj) {
      return obj.length;
    }
    /**
     * Method to get an object's models.
     *
     * @param {Object} obj - The object.
     *
     * @returns {*|[]} - The object's models.
     */

  }, {
    key: "getModels",
    value: function getModels(obj) {
      return obj.models;
    }
    /**
     * Method to set the value of a field object.
     *
     * @param {Object} obj - The field object.
     * @param {string} val - The value to set.
     *
     * @returns {string} - The field object's new value.
     */

  }, {
    key: "setValue",
    value: function setValue(obj, val) {
      obj.value = val;
      return obj.value;
    }
    /**
     * Method to set the metadata of an object.
     *
     * @param {Object} obj - The object.
     *
     * @returns {Array} - An array of object metadata.
     */

  }, {
    key: "setMetaData",
    value: function setMetaData(obj) {
      var metaData;
      metaData = {
        edit: obj.changed.editLink,
        id: obj.id,
        name: obj.changed.title,
        src: obj.changed.sizes.thumbnail.url
      };
      return metaData;
    }
    /**
     * Method to insert an object into the DOM from the WP Media Uploader.
     *
     * @param {Object} frame - The WP Media Uploader object.
     *
     * @returns {void}
     */

  }, {
    key: "insertObject",
    value: function insertObject(frame) {
      var selection = frame.state().get('selection'),
          length = this.getLength(selection),
          objects = this.getModels(selection),
          imgEl = document.createElement('img');
      var object,
          objectData = {};

      for (var i = 0; i < length; i++) {
        object = objects[i];
        objectData = this.setMetaData(object);
        this.uploads.push(objectData);
        this.uploadField.value = objectData.id;
        imgEl.src = objectData.src;
        this.uploadThumb.appendChild(imgEl);
      }
    }
    /**
     * Method to delete an object.
     *
     * @param {Object} e - The event object.
     *
     * @returns {void}
     */

  }, {
    key: "deleteObject",
    value: function deleteObject(e) {
      var objectId = this.getFieldValue(this.uploadField);
      e.preventDefault();
      this.uploads.splice(this.uploads.indexOf(objectId), 1);
      this.uploadField.value = '';
      this.uploadThumb.remove();
    }
    /**
     * Methos to trigger the WP Media Upload modal.
     *
     * @param {Object} e - The event object.
     *
     * @returns {void}
     */

  }, {
    key: "openModal",
    value: function openModal(e) {
      var _this = this;

      var frame;
      frame = wp.media({
        frame: 'post',
        title: 'Choose an Image',
        library: {
          type: 'image'
        },
        multiple: false,
        button: {
          text: 'Select Image'
        }
      });
      frame.open();
      frame.on('insert', function () {
        _this.insertObject(frame);
      });
      e.preventDefault();
    }
    /**
     * Method to handle event propagation.
     *
     * @returns {void}
     */

  }, {
    key: "handleEvents",
    value: function handleEvents() {
      var addButton = document.getElementById('wpsm-add-button');
      var deleteButton = document.getElementById('wpsm-delete-button');
      addButton.onclick = this.openModal;
      deleteButton.onclick = this.deleteObject;
    }
    /**
     * Method to initialize the Media Uploader.
     *
     * @returns {void}
     */

  }, {
    key: "init",
    value: function init() {
      this.handleEvents();
    }
  }]);

  return MediaUploader;
}();

var _default = MediaUploader;
exports.default = _default;

},{}]},{},[1]);

//# sourceMappingURL=build.admin.js.map
