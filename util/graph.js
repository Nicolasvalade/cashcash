var nbr_intervention = document.getElementById("nb_intervention");
const graph = document.getElementById("graph_interv_gerant").getContext('2d');

let myChart = new myChart(graph,{
type: "bar",
data:{
    labels:["01/23"
    ],
    datasets:[{
        label: "intervention par mois",
        data: [ nbr_intervention.innerHTML

        ]
    }],
}
})