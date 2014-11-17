function bind(f, o) {
  if (!Function.prototype.bind) {
    Function.prototype.bind = function(o, /*, args */) {
      var self = this, boungArgs = arguments;

      return function() {
        var args = [], i;
        for (i = 1; i < boungArgs.length; i++) {
          args.push(boungArgs[i]);
        }

        for (i = 0; i < arguments.length; i++) {
          args.push(arguments[i]);
        }

        return self.apply(o, args);
      };
    };
  }
}