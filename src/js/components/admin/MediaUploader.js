import { utils } from '../../utils';

class MediaUploader {

  /**
   * The MediaUploader constructor.
   */
  constructor() {
    this.uploadField = document.getElementById(wpsmImgUploader.key);
    this.uploadThumb = document.getElementById('wpsm-image-wrapper');
    this.uploads = [];

    this.insertObject = this.insertObject.bind(this);
    this.deleteObject = this.deleteObject.bind(this);
    this.openModal = this.openModal.bind(this);
    this.handleEvents = this.handleEvents.bind(this);
  }

  /**
   * Method to set the metadata of an object.
   *
   * @param {Object} obj - The object.
   *
   * @returns {Array} - An array of object metadata.
   */
  setMetaData(obj) {
    let metaData;

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
  insertObject(frame) {
    const selection = frame.state().get('selection'),
      length = selection.length,
      objects = selection.models,
      imgEl = document.createElement('img');
    let object,
      objectData = {};

    for (let i = 0; i < length; i++) {
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
  deleteObject(e) {
    let objectId = this.uploadField.value;

    this.uploads.splice(this.uploads.indexOf(objectId), 1);
    this.uploadField.value = '';
    this.uploadThumb.remove();
    e.preventDefault();
  }

  /**
   * Methos to trigger the WP Media Upload modal.
   *
   * @param {Object} e - The event object.
   *
   * @returns {void}
   */
  openModal(e) {
    let frame;

    frame = wp.media({
      frame: 'post',
      title: 'Choose an Image',
      library: {type: 'image'},
      multiple: false,
      button: {text: 'Select Image'}
    });
    frame.open();
    frame.on('insert', () => {
      this.insertObject(frame);
    });
    e.preventDefault();
  }

  /**
   * Method to handle event propagation.
   *
   * @returns {void}
   */
  handleEvents() {
    const addButton = document.getElementById('wpsm-add-button');
    const deleteButton = document.getElementById('wpsm-delete-button');

    addButton.onclick = this.openModal;
    deleteButton.onclick = this.deleteObject;
  }

  /**
   * Method to initilize the event listeners.
   *
   * @returns {void}
   */
  init() {
    this.handleEvents();
  }
}

export default MediaUploader;
