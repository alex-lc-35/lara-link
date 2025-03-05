import 'bootstrap/dist/css/bootstrap.min.css';
import * as bootstrap from 'bootstrap';
import $ from 'jquery';

window.bootstrap = bootstrap;

window.$ = $;
window.jQuery = $;

// Configuration AJAX avec CSRF Token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});
