// Dashboard 1 Morris-chart
$(function () {
    "use strict";

    // Morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: docsBySector,
        xkey: 'sectorName',
        ykeys: [ 'revised', 'expired' ],
        labels: ['Revisados', 'Pendentes'],
        barColors:['#26c6da', '#ffbc34'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });
    
 });