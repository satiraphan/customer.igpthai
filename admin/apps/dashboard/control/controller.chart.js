
new Chart('chart-activty-users', {
	type: 'line',
	data: {
		labels: $("#chart-activty-users").data("label"),
		datasets: [{			
			label: 'Log in Activities',
			backgroundColor: Chart.helpers.color(cyan).alpha(0.5).rgbString(),
			borderColor: cyan,
			data: $("#chart-activty-users").data("data")
		}]
	},
	options: {
		maintainAspectRatio: false,
		scales: {
			x: {
				title: {
					display: true,
					text: 'date'
				}
			}
		}
	}
});
