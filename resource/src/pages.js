// Import required modules and utilities
import "../../../../resource/src/js/modules/datatables";
import { Model, Reactor, ReactiveTemplate } from "../../../../resource/src/js/modules/scripts/reactive_template.js";
import Template from "../../../../resource/src/js/modules/scripts/template.js";
import PresentationModal from "../../../../resource/src/js/modules/scripts/presentation-modal.js";
import BlueFissionCrud from "../../../../resource/src/js/modules/app/bluefission-crud.js";

// Import page-specific scripts
import HomePage from "./home-page.js";
import AboutPage from "./about-page.js";
import FaqPage from "./faq-page.js";

// Define API endpoints
app.api.homes = new BlueFissionCrud('homes');
app.api.services = new BlueFissionCrud('services');
app.api.lodgings = new BlueFissionCrud('lodgings');
app.api.seekers = new BlueFissionCrud('seekers');

// Dashboard class definition
var HestiaPages = function() {
    const inputOptions = {
        rejectOn: isNaN,
        mutator: Number
    };

    // Function to determine which page is currently being viewed
    var getCurrentPage = function() {
        return window.location.pathname.split('/').pop().replace('.html', '');
    };

    // Function to handle page-specific logic by importing relevant modules
    var handlePageSpecificLogic = function(page) {
        switch(page) {
            case 'home':
                HomePage.init();
                break;
            case 'about':
                AboutPage.init();
                break;
            case 'faq':
                FaqPage.init();
                break;
            // Add more cases for other pages
            default:
                console.log('Page not recognized.');
        }
    };

    // Main function to initialize the dashboard
    return {
        init: function () {
            var currentPage = getCurrentPage();
            handlePageSpecificLogic(currentPage);

            // Common UI initializations (if any)
            $(document).ajaxStart(function() {
                $('#loadingOverlay').show();
            });

            $(document).ajaxStop(function() {
                $('#loadingOverlay').hide();
            });
        }
    };
}();

$(document).ready(function() {
    HestiaPages.init();
});

export default HestiaPages;
