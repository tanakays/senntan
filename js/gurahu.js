
var myChart1 = {
                type: 'bar',
                data: {
                    labels: [],
                    
                    datasets: [{
                        label: '直営店舗数',
                        data: [],
                        yAxisID:"tenpo",
                        backgroundColor: [
                            'rgba(0, 250, 127, 0.5)',
                            'rgba(0, 250, 127, 0.5)',
                            'rgba(0, 250, 127, 0.5)',
                            'rgba(0, 250, 127, 0.5)',
                            'rgba(0, 250, 127, 0.5)'
                        ],
                        borderColor: [
                            'rgba(0, 250, 130, 1)',
                            'rgba(0, 250, 130, 1)',
                            'rgba(0, 250, 130, 1)',
                            'rgba(0, 250, 130, 1)',
                            'rgba(0, 250, 130, 1)'
                        ],
                        borderWidth: 2,
                    },
                    {
                        label: '総売り上げ',
                        data: [],
                        yAxisID:"uriage",
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 2,
                    }

                ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            id:"tenpo",
                            position: "left",
                            scaleLabel: {              //軸ラベル設定
                               display: true,          //表示設
                               labelString: '直営店舗数',  //ラベル
                               fontSize: 18               //フォントサイズ
                            }
                            ,ticks: {
                                beginAtZero: true,
                                min: 0,
                                max: 20
                            }
                        },
                        {
                            id:"uriage",
                            position: "right",
                            scaleLabel: {              //軸ラベル設定
                               display: true,          //表示設定
                               labelString: '総売り上げ額',  //ラベル
                               fontSize: 18               //フォントサイズ
                            }
                            ,ticks: {
                                beginAtZero: true,
                                min: 0,
                                max: 4000000
                              }
                        }
                        ],
                        xAxes: [{
                            scaleLabel: {              //軸ラベル設定
                               display: true,          //表示設定
                               position: "right",
                               labelString: '県名',  //ラベル
                               fontSize: 18               //フォントサイズ
                            }
                        }]
                    },
                    responsive: false,
                }
            }

function show_chart(ctx){
    console.log("グラフ表示");
    window.myBar = new Chart(ctx, myChart1);
}
function update_chart(kansei){
    console.log("グラフ更新");
    myChart1.data.datasets[0].data = [];
    myChart1.data.datasets[1].data = [];
    myChart1.data.labels = [];
    window.myBar.update();
    for(var i = 0; i < 5 ;i++){
        console.log(kansei[i][0]);
        console.log(kansei[i][1]);
        console.log(kansei[i][2]);

        myChart1.data.labels.push(kansei[i][0]);
        myChart1.data.datasets[0].data.push(kansei[i][1]);
        myChart1.data.datasets[1].data.push(kansei[i][2]);
    }
    window.myBar.update();
}
