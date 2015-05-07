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
        <li><a href="/index/list">Overview</a></li>
        <li><a href="/admin/add">Add Resource</a></li>
        <li class="active"><a href="/admin/delres">Delete Resource<span class="sr-only">(current)</span></a></li>
        <li><a href="/admin/report">Reports</a></li>
        <!-- <li><a href="/admin/analyze">Analytics</a></li> -->
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h2 class="sub-header">All Resource List</h2>
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
        <form class="form-horizontal" action="/admin/delresaf" method="POST">
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
                <td></td>
                <td>
                  <div class="control-group">
                    <!-- Button -->
                    <div class="controls">
                      <button class="btn btn-success">DELETE</button>
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
