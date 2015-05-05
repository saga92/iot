{% extends "layouts/layouts.volt" %}

{% block navbar %}
<div id="navbar" class="navbar-collapse collapse">
  <ul class="nav navbar-nav navbar-right">
    <li><a href="/index/show">Register</a></li>
  </ul>
</div>
{% endblock %}

{% block link %}
<!-- Bootstrap core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/css/dashboard.css" rel="stylesheet">
<link href="/css/my.css" rel="stylesheet">
{% endblock %}

{% block content %}
<div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="/img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="/index/login" method='POST'>
                <span id="reauth-email" class="reauth-email"></span>
                <input name="username" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
{% endblock %}
