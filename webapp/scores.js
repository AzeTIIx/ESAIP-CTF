$(document).ready(function() {
    $.ajax({
        url: "http://localhost:80/ProjetMajeure/getData.php",

        type: "GET",
        success: function(data) {
            //console.log(data);

            var temps = [];

            const users = {};
            for (let i = 0; i < data.length; i++) {
                temps.push(data[i].temps);
                let entry = data[i];
                let username = entry.username;
                if (!users[username]) {
                    users[username] = [];
                }
                users[username].push({
                    x: entry.temps,
                    y: entry.points
                });
            }

            console.log(users);


            var chartdata = {
              labels: temps,
              datasets: [],

            };
            

          for (var player in users) {
              chartdata.datasets.push({
                  label: player,
                  fill: false,
                  lineTension: 0.1,
                  borderWidth: 1.5,
                  backgroundColor: "rgba(0, 0, 0, 0.75)",
                  borderColor: getRandomColor(),
                  pointHoverBackgroundColor: "rgba(100, 100, 100, 1)",
                  pointHoverBorderColor: "rgba(255, 255, 255, 1)",
                  data: users[player],
                  pointRadius: 0,
                  spanGaps: false
              });

              var lastIndex = users[player].length - 1;
              var lastValue = users[player][lastIndex].y;
              chartdata.datasets[chartdata.datasets.length - 1].pointRadius = 3;
              chartdata.datasets[chartdata.datasets.length - 1].pointBackgroundColor = chartdata.datasets[chartdata.datasets.length - 1].borderColor;
              chartdata.datasets[chartdata.datasets.length - 1].pointBorderColor = '#fff';
              chartdata.datasets[chartdata.datasets.length - 1].pointBorderWidth = 1;
              chartdata.datasets[chartdata.datasets.length - 1].data.push({
                  x: temps[temps.length - 1],
                  y: lastValue,
                  r: 2
              });
          }

            var ctx = $("#Graph");

            var LineGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    scales: {
                      xAxes: [
                        {
                          scaleLabel: {
                            display: true,
                            labelString: 'Date',
                          }
                        }
                      ],
                      yAxes: [
                        {
                          scaleLabel: {
                            display: true,
                            labelString: 'Points',
                          }
                        }
                      ]
                    }
                  }
            });
        },
        error: function(data) {

        }
    });
});


LineGraph.config.options.onClick = function(e) {
  var activePoint = LineGraph.getElementAtEvent(e);
  if (activePoint.length < 0) {
      var datasetIndex = activePoint[0]._datasetIndex;
      //var label = LineGraph.data.datasets[datasetIndex].label;
      for (var i = 0; i < LineGraph.data.datasets.length; i++) {
          LineGraph.data.datasets[i].borderWidth = 1.5;
          LineGraph.data.datasets[i].backgroundColor = "rgba(0, 0, 0, 0.75)";
          if (i === datasetIndex) {
              LineGraph.data.datasets[i].borderWidth = 3;
              LineGraph.data.datasets[i].backgroundColor = "rgba(0, 0, 0, 1)";
          }
      }
      LineGraph.update();
  }
};


function getRandomColor() {
    let r = Math.floor(Math.random() * 256);
    let g = Math.floor(Math.random() * 256);
    let b = Math.floor(Math.random() * 256);
    return "rgb(" + r + "," + g + "," + b + ")";
}