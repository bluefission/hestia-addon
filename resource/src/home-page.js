// hestia-home.js
import { Model, Reactor } from "../../../../resource/src/js/modules/scripts/reactive_template.js";

var HomePage = function() {
    // Define models for Hestia's KPIs
    const kpi_01_name = new Reactor("Homes Managed");
    const kpi_01_value = new Reactor(0);
    const kpi_02_name = new Reactor("Services Completed");
    const kpi_02_value = new Reactor(0);
    const kpi_03_name = new Reactor("Lodgings Available");
    const kpi_03_value = new Reactor(0);
    const kpi_04_name = new Reactor("Seekers Matched");
    const kpi_04_value = new Reactor(0);

    // Assign KPIs to the app
    app.assign('kpi_01_name', kpi_01_name);
    app.assign('kpi_01_value', kpi_01_value);
    app.assign('kpi_02_name', kpi_02_name);
    app.assign('kpi_02_value', kpi_02_value);
    app.assign('kpi_03_name', kpi_03_name);
    app.assign('kpi_03_value', kpi_03_value);
    app.assign('kpi_04_name', kpi_04_name);
    app.assign('kpi_04_value', kpi_04_value);

    // Function to load KPI data
    var loadKPIs = function() {
        app.api.homes.count(function(response) {
            kpi_01_value.set(response.data.count || 0);
        });

        app.api.services.count(function(response) {
            kpi_02_value.set(response.data.count || 0);
        });

        app.api.lodgings.count(function(response) {
            kpi_03_value.set(response.data.count || 0);
        });

        app.api.seekers.count(function(response) {
            kpi_04_value.set(response.data.count || 0);
        });
    };

    return {
        init: function () {
            loadKPIs();
        }
    };
}();

export default HomePage;
