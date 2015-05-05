{% extends "layouts/layouts.volt" %}

{% block link %}
<!-- Bootstrap core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/css/dashboard.css" rel="stylesheet">
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
        <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
        <li><a href="/index/buynormal">Buy</a></li>
        <li><a href="/index/historynormal">History</a></li>
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1 class="page-header">Dashboard</h1>

      <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
          <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
          <h4>Label</h4>
          <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
          <h4>Label</h4>
          <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
          <h4>Label</h4>
          <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
          <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
          <h4>Label</h4>
          <span class="text-muted">Something else</span>
        </div>
      </div>

      <h2 class="sub-header">My Resource List</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>resource id</th>
              <th>host name</th>
              <th>detail</th>
              <th>price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>m1.tiny</td>
              <td>CPU:1 RAM:512MB disk:1GB</td>
              <td>67.5</td>
            </tr>
            <tr>
              <td>2</td>
              <td>standard</td>
              <td>CPU:2 RAM:2GB disk:20GB</td>
              <td>80</td>
            </tr>
            <tr>
              <td>3</td>
              <td>m1.small</td>
              <td>CPU:1 RAM:2GB disk:20GB</td>
              <td>87</td>
            </tr>
            <tr>
              <td>4</td>
              <td>m1.medium</td>
              <td>CPU:2 RAM:4GB disk:40GB</td>
              <td>200</td>
            </tr>
            <tr>
              <td>5</td>
              <td>m1.large</td>
              <td>CPU:4 RAM:8GB disk:80GB</td>
              <td>400</td>
            </tr>
            <tr>
              <td>6</td>
              <td>m1.xlarge</td>
              <td>CPU:8 RAM:16GB disk:160GB</td>
              <td>800</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
{% endblock %}