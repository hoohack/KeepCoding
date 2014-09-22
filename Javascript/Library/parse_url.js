function parse_url (url) {
    var regx = /^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/,
        result_arr = regx.exec(url),
        names = ['url', 'scheme', 'slash', 'host', 'port', 'path', 'query', 'hash'],
        i = 0,
        len = names.length,
        url_object = {};
    for (i = 0; i < len; ++i) {
        url_object[names[i]] = result_arr[i];
    }

    return url_object;
}

//var url = "http://www.ora.com:80/goodparts?q#fragment";

//var result = parse_url(url);
//console.log(result);
