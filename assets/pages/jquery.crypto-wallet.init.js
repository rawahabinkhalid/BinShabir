for(var ts2=14844186e5,dates=[],spikes=[5,-5,3,-3,8,-8],i=0;i<120;i++){var innerArr=[ts2+=864e5,dataSeries[1][i].value];dates.push(innerArr)}var options={chart:{type:"area",stacked:!1,height:370,zoom:{enabled:!0},toolbar:{show:!1},dropShadow:{enabled:!0,top:10,left:0,bottom:0,right:0,blur:2,color:"#b6c2e4",opacity:.35}},plotOptions:{line:{curve:"smooth"}},dataLabels:{enabled:!1},stroke:{width:[3]},series:[{name:"Bitcoin",data:dates}],markers:{size:0,style:"full"},colors:["#fa5c7c"],grid:{row:{colors:["transparent","transparent"],opacity:.2},borderColor:"#f1f3fa"},fill:{gradient:{enabled:!0,shadeIntensity:1,inverseColors:!1,opacityFrom:.5,opacityTo:.1,stops:[0,70,80,100]}},yaxis:{min:2e7,max:25e7,labels:{formatter:function(e){return"$"+(e/1e6).toFixed(0)}},title:{text:"Rate"}},xaxis:{type:"datetime",axisBorder:{show:!0,color:"#bec7e0"},axisTicks:{show:!0,color:"#bec7e0"}},tooltip:{shared:!1,y:{formatter:function(e){return"$"+(e/1e6).toFixed(0)}}},responsive:[{breakpoint:600,options:{chart:{toolbar:{show:!1}},legend:{show:!1}}}]},chart=new ApexCharts(document.querySelector("#wallet_map"),options);chart.render(),$("#datatable").DataTable();