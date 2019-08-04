/**
 * Function to get the value of a field object.
 *
 * @param {Object} obj - The field object.
 *
 * @returns {string} - The field object's value.
 */
export function getValue(obj) {
  return obj.value;
}

/**
 * Function to get an object's length.
 *
 * @param {Object} obj - The object.
 *
 * @returns {*} - The object's length.
 */
export function getLength(obj) {
  return obj.length;
}

/**
 * Function to get an object's models.
 *
 * @param {Object} obj - The object.
 *
 * @returns {*|[]} - The object's models.
 */
export function getModels(obj) {
  return obj.models;
}

/**
 * Function to set the value of a field object.
 *
 * @param {Object} obj - The field object.
 * @param {string} val - The value to set.
 *
 * @returns {string} - The field object's new value.
 */
export function setValue(obj, val) {

  obj.value = val;

  return obj.value;
}
