{% extends "layouts/layouts.volt" %}

{% block link %}
<!-- Bootstrap core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/css/dashboard.css" rel="stylesheet">
<script src="http://s1.bdstatic.com/r/www/cache/ecom/esl/2-0-6/esl.js"></script>
<script src="/js/echarts.js"></script>
{% endblock %}

{% block script %}
<script src="/js/jquery.min.js"></script>
<script src="/js/holder.js"></script>
<script src="/js/bootstrap.min.js"></script>

{% endblock %}

{% block content %}
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li><a href="/index/list">Overview</a></li>
        <li><a href="/admin/add">Add Resource</a></li>
        <li><a href="/admin/delres">Delete Resource</a></li>
        <li class="active"><a href="/admin/report">Reports<span class="sr-only">(current)</span></a></li>
        <li><a href="/admin/analyze">Analytics</a></li>
        
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="sub-header">Income Report</h2>
      <div class="table-responsive" id="charts" style="height:400px">
        
      </div>
      <script type="text/javascript">
        // 路径配置
        require.config({
            paths: {
                echarts: '/js'
            }
        });

        // 使用
        require(
            [
                'echarts',
                'echarts/chart/bar' // 使用柱状图就加载bar模块，按需加载
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart = ec.init(document.getElementById('charts')); 
                
                option = {
                title: {
                    text: 'History income report（rmb）',
                    subtext: 'proud to power by echarts',
                    sublink: 'http://echarts.baidu.com'
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    },
                    formatter: function (params) {
                        var tar = params[0];
                        return tar.name + '<br/>' + tar.seriesName + ' : ' + tar.value;
                    }
                },
                toolbox: {
                    show : true,
                    feature : {
                        mark : {show: true},
                        dataView : {show: true, readOnly: false},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                xAxis : [
                    {
                        type : 'category',
                        splitLine: {show:false},
                        data : ['total','user 1','user 2','user 3','user 4','user 5']
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'辅助',
                        type:'bar',
                        stack: '总量',
                        itemStyle:{
                            normal:{
                                barBorderColor:'rgba(0,0,0,0)',
                                color:'rgba(0,0,0,0)'
                            },
                            emphasis:{
                                barBorderColor:'rgba(0,0,0,0)',
                                color:'rgba(0,0,0,0)'
                            }
                        },
                        data:[0, {{to_money/10*9}}, {{to_money/10*6}}, {{to_money/10*5}}, {{to_money/10*3}}, 0]
                    },
                    {
                        name:'income',
                        type:'bar',
                        stack: '总量',
                        itemStyle : { normal: {label : {show: true, position: 'inside'}}},
                        data:[{{to_money}}, {{to_money/10*1}}, {{to_money/10*3}}, {{to_money/10*1}}, {{to_money/10*2}}, {{to_money/10*3}}]
                    }
                  ]
                };
                // 为echarts对象加载数据 
                myChart.setOption(option); 
            }
        );
      </script>
    </div>
  </div>
</div>
{% endblock %}
