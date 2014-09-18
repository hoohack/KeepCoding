function List() {
  this.init();
}

List.prototype.init = function() {
  this.array = new Array();
}

List.prototype.length = function() {
  return this.array.length;
}

List.prototype.add = function(element) {
  this.array.push(element);
}
