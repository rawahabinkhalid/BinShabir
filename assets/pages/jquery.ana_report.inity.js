$("#datatable").DataTable();var optionsCircle={chart:{type:"radialBar",height:280,offsetY:-30,offsetX:20,dropShadow:{enabled:!0,top:10,left:0,bottom:0,right:0,blur:2,color:"#b6c2e4",opacity:.1}},plotOptions:{radialBar:{inverseOrder:!0,hollow:{margin:5,size:"55%",background:"transparent"},track:{show:!0,background:"#ddd",strokeWidth:"10%",opacity:1,margin:5},dataLabels:{name:{fontSize:"18px"},value:{fontSize:"16px",color:"#50649c"}}}},series:[71,63],labels:["Domestic","International"],legend:{show:!0,position:"bottom",offsetX:-40,offsetY:-10,formatter:function(e,t){return e+" - "+t.w.globals.series[t.seriesIndex]+"%"}},fill:{type:"gradient",gradient:{shade:"dark",type:"horizontal",shadeIntensity:.5,inverseColors:!0,opacityFrom:1,opacityTo:1,stops:[0,100],gradientToColors:["#40e0d0","#ff8c00","#ff0080"]}},stroke:{lineCap:"round"}},chartCircle=new ApexCharts(document.querySelector("#circlechart"),optionsCircle);chartCircle.render();var iteration=11;function getRandom(){var e=iteration;return(Math.sin(e/trigoStrength)*(e/trigoStrength)+e/trigoStrength+1)*(2*trigoStrength)}function getRangeRandom(e){return Math.floor(Math.random()*(e.max-e.min+1))+e.min}window.setInterval(function(){iteration++,chartCircle.updateSeries([getRangeRandom({min:10,max:100}),getRangeRandom({min:10,max:100})])},3e3),$("#world-map-markers").vectorMap({map:"world_mill_en",scaleColors:["#eff0f1","#eff0f1"],normalizeFunction:"polynomial",hoverOpacity:.7,hoverColor:!1,regionStyle:{initial:{fill:"#3f7dff"}},markerStyle:{initial:{stroke:"transparent"},hover:{stroke:"rgba(112, 112, 112, 0.30)"}},backgroundColor:"transparent",markers:[{latLng:[37.09024,-95.712891],name:"USA",style:{fill:"#e0e7fd"}},{latLng:[71.70694,-42.604301],name:"Greenland",style:{fill:"#e0e7fd"}},{latLng:[-21.943369,123.102198],name:"Australia",style:{fill:"#e0e7fd"}}],series:{regions:[{values:{AU:"#0dc8de",US:"#ff5560",GL:"#ffb822"},attribute:"fill"}]}});