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

{% block brand %}
<a class="navbar-brand" href="/index/listnormal">IOT --- cloud os platform</a>
{% endblock%}

{% block content %}
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li><a href="/index/listnormal">Overview</a></li>
        <li class="active"><a href="/index/buynormal">Buy <span class="sr-only">(current)</span></a></li>
        <li><a href="/index/historynormal">History</a></li>
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="sub-header">Idle Resource List</h2>
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
            {%for r in res%}
            <tr>
              <td>{{r.id}}</td>
              <td>{{r.host_name}}</td>
              <td>{{r.detail}}</td>
              <td>{{r.price}}</td>
            </tr>
            {%endfor%}
          </tbody>
        </table>
      </div>
      <h2 class="sub-header">Choice</h2>
      <div>
        <form class="form-horizontal" action="/index/buy" method="POST">
          <fieldset>
            <table id="buytable" style="width:50%;">
              <tr>
                <td class="col-md-1"><label class="control-label">resource id</label></td>
                <td class="col-md-1">
                  <div class="control-group">
                    <!-- Select Basic -->
                    <div class="controls">
                      <select class="input-xlarge" name="resource_id">
                        {%for r in res%}
                          <option>{{r.id}}</option>
                        {%endfor%}
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="col-md-1"><label class="control-label">time (month)</label></td>
                <td class="col-md-1">
                  <div class="control-group">
                    <!-- Select Basic -->
                    <div class="controls">
                      <select class="input-xlarge" name="month_num">
                        <option>1</option>
                        <option>2</option>
                        <option>5</option>
                        <option>12</option>
                        <option>24</option>
                      </select>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><div id="stat" style="color: rgb(231, 12, 12);">{{buyStatus}}</div></td>
                <td>
                  <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                      <button class="btn btn-success">Buy</button>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
{% endblock %}
