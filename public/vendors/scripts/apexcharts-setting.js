
var options6 = {
	series: [
		{
			name: 'Work',
			data: data_cutis
		},
	],

	chart: {
		height: 150,
		type: 'rangeBar',
		toolbar: {
			show: false,
		}
	},
	grid: {
		show: false,
		padding: {
			left: 0,
			right: 0
		}
	},
	plotOptions: {
		bar: {
			horizontal: true,
			barHeight: '80%'
		}
	},
	xaxis: {
		type: 'datetime'
	},
	stroke: {
		width: 1
	},
	fill: {

		type: 'solid',
		opacity: 0.6
	},
	legend: {
		position: 'top',
		horizontalAlign: 'left'
	}
};
var chart = new ApexCharts(document.querySelector("#chart6"), options6);
chart.render();
