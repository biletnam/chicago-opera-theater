const insertAt = function (baseString, stringToBeInserted, index) {
  let insertionPoint = index;
  if ((typeof baseString !== 'string') || (typeof stringToBeInserted !== 'string')) {
    console.warn('insertAt() must be passed strings!');
    return '';
  }

  if (typeof index !== 'number') {
    console.warn('insertAt() must be passed a number for the index!');
    return '';
  }

  if (index > baseString.length) {
    console.warn('insertAt() was passed an index past the end of the base string, index\
     was changed to be the end of the string');

    insertionPoint = baseString.length;
  }

  const firstPart = baseString.slice(0, insertionPoint);
  const lastPart = baseString.slice(insertionPoint, baseString.length);
  const finalString = firstPart.concat(stringToBeInserted, lastPart);

  return finalString;
};

const reverseString = function (string) {
  if (typeof string !== 'string') {
    return '';
  }

  return string.split('').reverse().join('');
};

const roundString = function (string) {
  return String(Math.round(Number(string)));
};

const addDecimalPoint = function (string) {
  return insertAt(string, '.', string.length - 2);
};

const addCommasAndDecimalPoint = function (string) {
  const reversed = reverseString(string.slice(0, string.length - 2));
  const reversedArray = reversed.match(/.{1,3}/g);
  return `${reverseString(reversedArray.join(','))}.${string.slice(string.length - 2, string.length)}`;
};

const formatMoney = function (number) {
  if (isNaN(number)) {
    return '';
  }

  if (number == 0) {
    return '$0.00';
  }

  const numberAsCents = number * 100;

  let editableNumber = String(numberAsCents);

  // Removes all
  if (editableNumber.includes('.')) {
    editableNumber = roundString(editableNumber);
  }

  if (editableNumber.length >= 6) {
    editableNumber = addCommasAndDecimalPoint(editableNumber);
  } else {
    editableNumber = addDecimalPoint(editableNumber);
  }

  if (editableNumber.length === 3) {
    editableNumber = `0${editableNumber}`;
  }

  editableNumber = `$${editableNumber}`;

  return editableNumber;
};

export default formatMoney;
