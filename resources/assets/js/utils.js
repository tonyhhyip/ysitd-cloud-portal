/**
 * @private
 * @param {string}method
 * @returns {Function}
 */
function rounding(method) {
  return function (value, dp) {
    dp = dp || 0;
    const pow = Math.pow(10, dp);
    return Math[method](value * pow) / pow;
  }
}

const roundUp = rounding('ceil');
const roundOff = rounding('round');
const roundDown = rounding('floor');

export {roundUp, roundOff, roundDown};