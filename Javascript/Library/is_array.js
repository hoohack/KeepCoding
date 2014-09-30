var is_array = function(value) {
  return value &&
      typeof value === 'object' &&
      typeof value.length === 'number' &&
      typeof value.slice === 'function' &&
      !(value.propertyIsEnumerable('length'));
};
