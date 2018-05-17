(function () {
'use strict';

function ajax(a) {
    console.log(a);
}

var query = 'Rollup';
// call the ajax function
ajax( 'https://api.example.com?search=' + query ).then( handleResponse );

}());

//# sourceMappingURL=main.js.map
